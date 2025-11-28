<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();

        return view('todos.index', compact('todos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Todo::create([
            'text' => $request->text,
            'completed' => false,
        ]);

        return redirect()->route('todos.index')
            ->with('success', 'Tâche ajoutée avec succès !');
    }

    public function edit(string $id)
    {
        $todo = Todo::findOrFail($id);

        return view('todos.edit', compact('todo'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = Todo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'text' => 'sometimes|string|max:500',
            'completed' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $todo->update($request->only(['text', 'completed']));

        return redirect()->route('todos.index')
            ->with('success', 'Tâche mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Tâche supprimée avec succès !');
    }

    /**
     * Toggle completion status
     */
    public function toggle(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update(['completed' => ! $todo->completed]);

        return redirect()->route('todos.index')
            ->with('success', 'Statut de la tâche modifié !');
    }
}
