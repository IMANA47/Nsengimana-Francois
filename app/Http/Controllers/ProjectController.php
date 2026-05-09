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
            'image' => ['nullable', 'file', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
        ]);
        
        // Validate image extension manually
        if ($request->hasFile('image')) {
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());
            if (!in_array($imageExtension, $allowedImageExtensions)) {
                return back()->withErrors(['image' => "L'image doit être un fichier jpg, jpeg, png, gif ou webp."])->withInput();
            }
        }

        $data['slug'] = Str::slug($data['title']) . '-' . now()->timestamp;
        $data['is_featured'] = $request->boolean('is_featured');
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/projects'), $fileName);
            $data['image_path'] = 'projects/' . $fileName;
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
            'image' => ['nullable', 'file', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
        ]);
        
        // Validate image extension manually
        if ($request->hasFile('image')) {
            $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());
            if (!in_array($imageExtension, $allowedImageExtensions)) {
                return back()->withErrors(['image' => "L'image doit être un fichier jpg, jpeg, png, gif ou webp."])->withInput();
            }
        }

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/projects'), $fileName);
            $data['image_path'] = 'projects/' . $fileName;
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
