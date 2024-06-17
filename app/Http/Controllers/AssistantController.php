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
        //
    }

    /* 
        Shows the view to register a new teacher
    */
    public function createTeacher()
    {
        return view('assistants.createTeacher');
    }

    /* 
        Shows the view to register a new external
    */
    public function createExternal()
    {
        return view('assistants.createExternal');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assistant $assistant)
    {
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
