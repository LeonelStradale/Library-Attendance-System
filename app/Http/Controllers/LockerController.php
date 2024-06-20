<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lockers = Locker::orderBy('id', 'asc')->paginate(10);

        return view('lockers.index', compact('lockers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lockers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer|unique:lockers,number',
            'availability' => 'required|string',
        ]);

        $locker = new Locker();
        $locker->number = $request->number;
        $locker->availability = $request->availability;

        $locker->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El nuevo locker se registró correctamente.'
        ]);

        return redirect()->route('lockers.show', $locker->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Locker $locker)
    {
        return view('lockers.show', compact('locker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locker $locker)
    {
        return view('lockers.edit', compact('locker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Locker $locker)
    {
        $rules = [
            'number' => 'required|integer',
            'availability' => 'required|string',
        ];

        if ($request->number != $locker->number) {
            $rules['number'] .= '|unique:lockers,number';
        }

        $request->validate($rules);

        $locker->number = $request->number;
        $locker->availability = $request->availability;

        $locker->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El locker se actualizó correctamente.'
        ]);

        return redirect()->route('lockers.show', $locker->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locker $locker)
    {
        $locker->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El locker se eliminó correctamente.'
        ]);

        return redirect()->route('lockers.index');
    }
}
