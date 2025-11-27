<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display the game interface
     */
    public function play()
    {
        $topScores = Game::orderBy('score', 'desc')
            ->take(10)
            ->get();

        return view('games.play', compact('topScores'));
    }

    /**
     * Display scores listing
     */
    public function index()
    {
        $scores = Game::orderBy('score', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('games.scores', compact('scores'));
    }

    /**
     * Display top scores (podium view)
     */
    public function topScores()
    {
        $topScores = Game::orderBy('score', 'desc')
            ->take(10)
            ->get();

        return view('games.top-scores', compact('topScores'));
    }

    /**
     * Store a new score
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'score' => 'required|integer|min:0',
            'targets_hit' => 'required|integer|min:0',
            'difficulty' => 'required|string|in:easy,medium,hard',
            'time_left' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Game::create($request->all());

        return redirect()->route('games.scores')
            ->with('success', 'Score enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'score' => 'required|integer|min:0',
            'targets_hit' => 'required|integer|min:0',
            'difficulty' => 'required|string|in:easy,medium,hard',
            'time_left' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $game->update($request->all());

        return redirect()->route('games.scores')
            ->with('success', 'Score mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')
            ->with('success', 'Score supprimé avec succès !');
    }
}
