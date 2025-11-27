<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * Display portfolio homepage
     */
    public function home()
    {
        $portfolioItems = Portfolio::orderBy('created_at', 'desc')->get();

        return view('portfolio.home', compact('portfolioItems'));
    }

    /**
     * Display admin portfolio management
     */
    public function index()
    {
        $portfolioItems = Portfolio::orderBy('created_at', 'desc')->get();

        return view('portfolio.index', compact('portfolioItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:100',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'tags' => 'nullable|array',
            'project_link' => 'nullable|url',
            'source_link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Portfolio::create([
            'fullname' => $request->fullname,
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'tags' => $request->tags ? json_encode($request->tags) : null,
            'project_link' => $request->project_link,
            'source_link' => $request->source_link,
        ]);

        return redirect()->route('portfolio.index')
            ->with('success', 'Projet ajouté avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:100',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'tags' => 'nullable|array',
            'project_link' => 'nullable|url',
            'source_link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $portfolio->update([
            'fullname' => $request->fullname,
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'tags' => $request->tags ? json_encode($request->tags) : null,
            'project_link' => $request->project_link,
            'source_link' => $request->source_link,
        ]);

        return redirect()->route('portfolio.index')
            ->with('success', 'Projet mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();

        return redirect()->route('portfolio.index')
            ->with('success', 'Projet supprimé avec succès !');
    }
}
