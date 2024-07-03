<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Attendance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /*
        Function that generates general attendance reports in PDF
    */
    public function reportGeneral(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $dateStart = $request->input('start');
        $dateEnd = $request->input('end');

        $dateStartParsed = Carbon::parse($dateStart, 'GMT-6');
        $dateEndParsed = Carbon::parse($dateEnd, 'GMT-6');

        if ($dateEndParsed->isBefore($dateStartParsed)) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'La fecha final debe ser posterior o igual a la fecha inicial.'
            ]);
            return redirect()->back();
        }

        // # 1
        $totalVisits = Attendance::whereBetween('date', [$dateStartParsed, $dateEndParsed])->count();

        // # 2
        $totalHours = Attendance::whereBetween('date', [$dateStartParsed, $dateEndParsed])->sum('total_hours');

        // 3
        $totalGenders = DB::table('attendances')
            ->join('assistants', 'attendances.assistant_id', '=', 'assistants.id')
            ->selectRaw('
        SUM(CASE WHEN assistants.gender = "Masculino" THEN 1 ELSE 0 END) AS totalMales,
        SUM(CASE WHEN assistants.gender = "Femenino" THEN 1 ELSE 0 END) AS totalFemales
            ')
            ->whereBetween('attendances.date', [$dateStartParsed, $dateEndParsed])
            ->first();

        // # 4
        $studentAttendances = DB::table('attendances')
            ->join('assistants', 'attendances.assistant_id', '=', 'assistants.id')
            ->selectRaw('
        COUNT(*) AS totalStudentsVisits, 
        SUM(attendances.total_hours) AS totalStudentsHours,
        SUM(CASE WHEN assistants.gender = "Masculino" THEN 1 ELSE 0 END) AS totalStudentsMales,
        SUM(CASE WHEN assistants.gender = "Femenino" THEN 1 ELSE 0 END) AS totalStudentsFemales
            ')
            ->whereBetween('attendances.date', [$dateStartParsed, $dateEndParsed])
            ->where('assistants.user_type', 'Estudiante')
            ->first();

        // # 5
        $studentCareers = DB::table('attendances')
            ->join('assistants', 'attendances.assistant_id', '=', 'assistants.id')
            ->selectRaw('
             assistants.career AS careerName,
             COUNT(*) AS totalCareerVisits, 
             SUM(attendances.total_hours) AS totalCareerHours,
             SUM(CASE WHEN assistants.gender = "Masculino" THEN 1 ELSE 0 END) AS totalCareerMales,
             SUM(CASE WHEN assistants.gender = "Femenino" THEN 1 ELSE 0 END) AS totalCareerFemales
         ')
            ->whereBetween('date', [$dateStartParsed, $dateEndParsed])
            ->where('assistants.user_type', 'Estudiante')
            ->groupBy('assistants.career')
            ->get();

        // # 6
        $teacherAttendances = DB::table('attendances')
            ->join('assistants', 'attendances.assistant_id', '=', 'assistants.id')
            ->selectRaw('
        COUNT(*) AS totalTeachersVisits, 
        SUM(attendances.total_hours) AS totalTeachersHours,
        SUM(CASE WHEN assistants.gender = "Masculino" THEN 1 ELSE 0 END) AS totalTeachersMales,
        SUM(CASE WHEN assistants.gender = "Femenino" THEN 1 ELSE 0 END) AS totalTeachersFemales
            ')
            ->whereBetween('attendances.date', [$dateStartParsed, $dateEndParsed])
            ->where('assistants.user_type', 'Docente')
            ->first();

        // # 7
        $teacherCareers = DB::table('attendances')
            ->join('assistants', 'attendances.assistant_id', '=', 'assistants.id')
            ->selectRaw('
             assistants.career AS careerDirectionName,
             COUNT(*) AS totalCareerDirectionVisits, 
             SUM(attendances.total_hours) AS totalCareerDirectionHours,
             SUM(CASE WHEN assistants.gender = "Masculino" THEN 1 ELSE 0 END) AS totalCareerDirectionMales,
             SUM(CASE WHEN assistants.gender = "Femenino" THEN 1 ELSE 0 END) AS totalCareerDirectionFemales
         ')
            ->whereBetween('date', [$dateStartParsed, $dateEndParsed])
            ->where('assistants.user_type', 'Docente')
            ->groupBy('assistants.career')
            ->get();

        // # 8
        $externalAttendances = DB::table('attendances')
            ->join('assistants', 'attendances.assistant_id', '=', 'assistants.id')
            ->selectRaw('
        COUNT(*) AS totalExternalsVisits, 
        SUM(attendances.total_hours) AS totalExternalsHours,
        SUM(CASE WHEN assistants.gender = "Masculino" THEN 1 ELSE 0 END) AS totalExternalsMales,
        SUM(CASE WHEN assistants.gender = "Femenino" THEN 1 ELSE 0 END) AS totalExternalsFemales
            ')
            ->whereBetween('attendances.date', [$dateStartParsed, $dateEndParsed])
            ->where('assistants.user_type', 'Externo')
            ->first();

        $pdf = PDF::loadView('PDF.general', compact('dateStart', 'dateEnd', 'totalVisits', 'totalHours', 'totalGenders', 'studentAttendances', 'studentCareers', 'teacherAttendances', 'teacherCareers', 'externalAttendances'));

        $pdfName = "Reporte General del Periodo " . $dateStart . " al " . $dateEnd . ".pdf";

        return $pdf->download($pdfName);
    }

    /*
        Function that generates individual attendance reports in PDF
    */
    public function reportIndividual(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $key = $request->key;

        $assistant = Assistant::where('number_id', $key)->first();

        if (!$assistant) {
            $searchWords = explode(' ', $key);

            $query = Assistant::query();

            foreach ($searchWords as $word) {
                $query->where(function ($q) use ($word) {
                    $q->where('first_name', 'LIKE', "%$word%")
                        ->orWhere('paternal_surname', 'LIKE', "%$word%")
                        ->orWhere('maternal_surname', 'LIKE', "%$word%");
                });
            }

            $assistants = $query->orderBy('first_name')
                ->orderBy('paternal_surname')
                ->orderBy('maternal_surname')
                ->get();

            $assistants = $assistants->filter(function ($assistant) use ($searchWords) {
                $fullName = strtolower($assistant->first_name . ' ' . $assistant->paternal_surname . ' ' . $assistant->maternal_surname);
                foreach ($searchWords as $word) {
                    if (strpos($fullName, strtolower($word)) === false) {
                        return false;
                    }
                }
                return true;
            });

            if ($assistants->count() >= 1) {
                $assistant = $assistants->first();
            } else {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Error!',
                    'text' => 'No se encontró ningún usuario con la información que proporcionaste.'
                ]);
                return redirect()->route('attendances.index');
            }
        }

        $dateStart = $request->input('start');
        $dateEnd = $request->input('end');

        $dateStartParsed = Carbon::parse($dateStart, 'GMT-6');
        $dateEndParsed = Carbon::parse($dateEnd, 'GMT-6');

        if ($dateEndParsed->isBefore($dateStartParsed)) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'La fecha final debe ser posterior o igual a la fecha inicial.'
            ]);
            return redirect()->back();
        }

        // # 1
        $userAttendance = DB::table('attendances')
            ->selectRaw('COUNT(*) as totalVisits, SUM(total_hours) as totalHours')
            ->where('assistant_id', $assistant->id)
            ->whereBetween('date', [$dateStartParsed, $dateEndParsed])
            ->get();

        // # 2
        $attendances = DB::table('attendances')
            ->select('date', 'entrance', 'exit', 'total_hours', 'locker_number')
            ->where('assistant_id', $assistant->id)
            ->whereBetween('date', [$dateStartParsed, $dateEndParsed])
            ->get();

        $pdf = PDF::loadView('PDF.individual', compact('dateStart', 'dateEnd', 'assistant', 'userAttendance', 'attendances'));

        $pdfName = "Reporte Individual de " . $assistant->first_name . " " . $assistant->paternal_surname . " " . $assistant->maternal_surname . ".pdf";

        return $pdf->download($pdfName);
    }
}
