<?php

// app/Http/Controllers/EntityController.php
namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityController extends Controller
{
    public function index()
    {
        $entities = Entity::all();
        return view('entities.index', compact('entities'));
    }

    public function create()
    {
        return view('entities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $entity = new Entity();
        $entity->name = $request->name;
        $entity->description = $request->description;
        $entity->user_id = Auth::id();
        $entity->save();

        return redirect()->route('users.index')->with('success', 'Entity created successfully');
    }

    public function show(Entity $entity)
    {
        return view('entities.show', compact('entity'));
    }

    public function edit(Entity $entity)
    {
        return view('entities.edit', compact('entity'));
    }

    public function update(Request $request, Entity $entity)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $entity->update($data);

        return redirect()->route('users.index')->with('success', 'Entity updated successfully.');
    }

    public function destroy(Entity $entity)
    {
        $entity->delete();
        return redirect()->route('users.index')->with('success', 'Entity deleted successfully.');
    }
}

