<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'stack' => ['required', 'string', 'max:255'],
            'github_url' => ['nullable', 'url'],
            'demo_url' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . now()->timestamp;
        $data['is_featured'] = $request->boolean('is_featured');
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('projects', 'public');
        }
        unset($data['image']);

        Project::create($data);
        return back()->with('success', 'Projet cree avec succes.');
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'stack' => ['required', 'string', 'max:255'],
            'github_url' => ['nullable', 'url'],
            'demo_url' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('projects', 'public');
        }
        $data['is_featured'] = $request->boolean('is_featured');
        unset($data['image']);
        $project->update($data);

        return back()->with('success', 'Projet mis a jour.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Projet supprime.');
    }
}
