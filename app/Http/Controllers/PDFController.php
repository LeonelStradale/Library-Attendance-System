<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /*

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

        // # 3
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

        $pdf = PDF::loadView('PDF.general', compact('totalVisits', 'totalHours', 'dateStart', 'dateEnd', 'studentAttendances'));

        return $pdf->download('Reporte General.pdf');
    }
}
