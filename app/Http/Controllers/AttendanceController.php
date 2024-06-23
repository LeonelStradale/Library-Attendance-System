<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Attendance;
use App\Models\Locker;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /*
        Show the main view
    */
    public function welcome()
    {
        return view('/welcome');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::now('GMT-6');

        // Chart
        $assistancePerMonth = DB::table('attendances')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $dataAssists = [];

        for ($month = 1; $month <= 12; $month++) {
            $months[] = DateTime::createFromFormat('!m', $month)->format('F');
            $data = $assistancePerMonth->firstWhere('month', $month);
            $dataAssists[] = $data ? $data->total : 0;
        }

        // # 1
        $numberUsersAttended = Attendance::whereDate('date', $currentDate->toDateString())->count();

        // # 2
        $numberUsersPresent = Attendance::whereDate('date', $currentDate->toDateString())
            ->whereNull('exit')
            ->count();

        // # 3
        $numberLockersAvailable = Locker::where('availability', 'Disponible')->count();

        // # 4
        $numberLockersInUse = Locker::where('availability', 'En Uso')->count();

        return view('attendances.index', compact('dataAssists', 'months', 'numberUsersAttended', 'numberUsersPresent', 'numberLockersAvailable', 'numberLockersInUse'));
    }

    /*
        Shows the entry view with attendance information
    */
    public function entrance(Assistant $assistant)
    {
        return view('entrance', compact('assistant'));
    }

    /*
        Check-in function
    */
    public function storeEntrance(Request $request)
    {
        // User search
        $request->validate([
            'key' => 'required|string',
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
                return redirect()->back();
            }
        }

        // Existing attendance
        $currentDate = Carbon::now('GMT-6')->format('Y-m-d');

        $existingAttendance = Attendance::where('assistant_id', $assistant->id)
            ->whereDate('date', $currentDate)
            ->whereNull('exit')
            ->first();

        if ($existingAttendance) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'No puedes registrar una nueva entrada sin haber registro tu salida.'
            ]);
            return redirect()->back();
        }

        // Attendance record creation transaction
        DB::beginTransaction();

        try {
            $currentTime = Carbon::now('GMT-6')->format('H:i:s');

            $newAttendance = new Attendance();
            $newAttendance->assistant_id = $assistant->id;
            $newAttendance->date = $currentDate;
            $newAttendance->entrance = $currentTime;

            if ($request->has('request_locker') && $request->request_locker == 'yes') {
                $locker = Locker::where('availability', 'Disponible')
                    ->orderBy('number', 'asc')
                    ->first();

                if (!$locker) {
                    DB::rollBack();
                    session()->flash('swal', [
                        'icon' => 'error',
                        'title' => '¡Error!',
                        'text' => 'No hay lockers disponibles.'
                    ]);
                    return redirect()->back();
                }

                $locker->availability = 'En Uso';
                $locker->save();

                $newAttendance->locker_number = $locker->number;
            }

            $newAttendance->save();

            DB::commit();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Éxito!',
                'text' => "Por favor, verifica tus datos personales. Si solicitaste un locker, pide la llave al encargado(a) de la biblioteca. Si los datos no son correctos, haz clic en 'No soy yo, volver al panel' para deshacer la acción."
            ]);

            return view('entrance', compact('assistant', 'newAttendance'));

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Ocurrió un error al registrar tu entrada. Por favor, intenta de nuevo.'
            ]);
            return redirect()->back();
        }
    }

    /*
        Undo check-in function
    */
    public function rollbackEntrance($attendanceId)
    {
        DB::beginTransaction();

        try {
            $attendance = Attendance::findOrFail($attendanceId);

            if ($attendance->locker_number) {
                $locker = Locker::where('number', $attendance->locker_number)->first();
                if ($locker) {
                    $locker->availability = 'Disponible';
                    $locker->save();
                }
            }

            $attendance->delete();

            DB::commit();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Registro de asistencia deshecho correctamente.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Ocurrió un error al deshacer el registro de asistencia. Por favor, intenta de nuevo.'
            ]);
        }

        return redirect()->route('welcome');
    }

    /*
        Shows the exit view with attendance information
    */
    public function exit()
    {
        $assistant = Assistant::find(58);

        return view('exit', compact('assistant'));
    }

    /*
        Check-out function
    */
    public function storeExit(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
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
                return redirect()->back();
            }
        }

        $currentDate = Carbon::now('GMT-6')->format('Y-m-d');

        $existingAttendance = Attendance::where('assistant_id', $assistant->id)
            ->whereDate('date', $currentDate)
            ->whereNull('exit')
            ->first();

        if (!$existingAttendance) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'No puedes registrar tu salida sin haber registrado primeramente una entrada.'
            ]);
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            $currentTime = Carbon::now('GMT-6')->format('H:i:s');

            $entranceTime = Carbon::parse($existingAttendance->entrance, 'GMT-6');
            $exitTime = Carbon::parse($existingAttendance->exit, 'GMT-6');

            $timeDifference = $entranceTime->diffInHours($exitTime);

            $timeDifferenceInteger = intval($timeDifference);

            $existingAttendance->exit = $currentTime;
            $existingAttendance->total_hours = $timeDifferenceInteger;
            $existingAttendance->save();

            if ($existingAttendance->locker_number) {
                $locker = Locker::where('number', $existingAttendance->locker_number)->first();
                if ($locker) {
                    $locker->availability = 'Disponible';
                    $locker->save();
                }
            }

            DB::commit();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Éxito!',
                'text' => "Por favor, verifica tus datos personales. Si solicitaste un locker, devuelve la llave al encargado(a) de la biblioteca. Si los datos no son correctos, haz clic en 'No soy yo, volver al panel' para deshacer la acción."
            ]);

            return view('exit', compact('assistant', 'existingAttendance'));

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Ocurrió un error al registrar tu salida. Por favor, intenta de nuevo.'
            ]);
        }

        return redirect()->back();
    }

    /*
        Undo check-out function
    */
    public function rollbackExit($attendanceId)
    {
        DB::beginTransaction();

        try {
            $attendance = Attendance::findOrFail($attendanceId);

            if ($attendance->locker_number) {
                $locker = Locker::where('number', $attendance->locker_number)->first();
                if ($locker) {
                    $locker->availability = 'En Uso';
                    $locker->save();
                }
            }

            $attendance->exit = null;
            $attendance->total_hours = null;
            $attendance->save();

            DB::commit();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Registro de salida deshecho correctamente.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Ocurrió un error al deshacer el registro de salida. Por favor, intenta de nuevo.'
            ]);
        }

        return redirect()->route('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
