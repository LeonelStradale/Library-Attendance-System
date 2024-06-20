<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assistants = Assistant::orderBy('id', 'asc')->paginate(10);

        return view('assistants.index', compact('assistants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assistants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number_id' => 'required|string|unique:assistants',
            'first_name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'career' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'gender' => 'required|string',
        ]);

        $firstName = strtoupper($request->first_name);
        $paternalSurname = strtoupper($request->paternal_surname);
        $maternalSurname = strtoupper($request->maternal_surname);

        $assistant = new Assistant();
        $assistant->number_id = $request->number_id;
        $assistant->first_name = $firstName;
        $assistant->paternal_surname = $paternalSurname;
        $assistant->maternal_surname = $maternalSurname;
        $assistant->career = $request->career;
        $assistant->grade = $request->grade;
        $assistant->area = $request->area;
        $assistant->gender = $request->gender;
        $assistant->user_type = 'Estudiante';

        $assistant->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El nuevo estudiante se registró correctamente.'
        ]);

        return redirect()->route('assistants.show', $assistant->id);
    }

    /* 
        Shows the view to register a new teacher
    */
    public function createTeacher()
    {
        return view('assistants.createTeacher');
    }

    /*
        Teacher registration function
    */
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'number_id' => 'required|string|unique:assistants',
            'first_name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'career' => 'required|string|max:255',
            'gender' => 'required|string',
        ]);

        $firstName = strtoupper($request->first_name);
        $paternalSurname = strtoupper($request->paternal_surname);
        $maternalSurname = strtoupper($request->maternal_surname);

        $assistant = new Assistant();
        $assistant->number_id = $request->number_id;
        $assistant->first_name = $firstName;
        $assistant->paternal_surname = $paternalSurname;
        $assistant->maternal_surname = $maternalSurname;
        $assistant->career = $request->career;
        $assistant->gender = $request->gender;
        $assistant->user_type = 'Docente';

        $assistant->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El nuevo docente se registró correctamente.'
        ]);

        return redirect()->route('assistants.show', $assistant->id);
    }

    /* 
        Shows the view to register a new external
    */
    public function createExternal()
    {
        return view('assistants.createExternal');
    }

    /*
        External registration function
    */
    public function storeExternal(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'gender' => 'required|string',
        ]);

        $firstName = strtoupper($request->first_name);
        $paternalSurname = strtoupper($request->paternal_surname);
        $maternalSurname = strtoupper($request->maternal_surname);

        $assistant = new Assistant();
        $assistant->first_name = $firstName;
        $assistant->paternal_surname = $paternalSurname;
        $assistant->maternal_surname = $maternalSurname;
        $assistant->gender = $request->gender;
        $assistant->user_type = 'Externo';

        $assistant->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El nuevo usuario externo se registró correctamente.'
        ]);

        return redirect()->route('assistants.show', $assistant->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Assistant $assistant)
    {
        return view('assistants.show', compact('assistant'));
    }

    /*
        User search function
    */
    public function searchUser(Request $request)
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
                return redirect()->route('assistants.index');
            }
        }
        return view('assistants.show', compact('assistant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assistant $assistant)
    {
        return view('assistants.edit', compact('assistant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assistant $assistant)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'gender' => 'required|string',
        ];

        if ($assistant->user_type === 'Estudiante') {
            $rules['number_id'] = 'required|string|unique:assistants,number_id,' . $assistant->id;
            $rules['career'] = 'required|string|max:255';
            $rules['grade'] = 'required|string|max:255';
            $rules['area'] = 'required|string|max:255';
        } elseif ($assistant->user_type === 'Docente') {
            $rules['number_id'] = 'required|string|unique:assistants,number_id,' . $assistant->id;
            $rules['career'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);

        $validatedData['first_name'] = strtoupper($validatedData['first_name']);
        $validatedData['paternal_surname'] = strtoupper($validatedData['paternal_surname']);
        if (isset($validatedData['maternal_surname'])) {
            $validatedData['maternal_surname'] = strtoupper($validatedData['maternal_surname']);
        }

        $assistant->update($validatedData);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El usuario se actualizó correctamente.'
        ]);

        return redirect()->route('assistants.show', $assistant->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assistant $assistant)
    {
        $assistant->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Éxito!',
            'text' => 'El usuario se eliminó correctamente.'
        ]);

        return redirect()->route('assistants.index');
    }
}
