<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Projects/Index', ['projects' => Project::latest()->get()]);
    }

    public function create()
    {
        return Inertia::render('Admin/Projects/Form', ['project' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        } else {
            unset($data['thumbnail']);
        }
        Project::create($data);
        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Admin/Projects/Form', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) Storage::disk('public')->delete($project->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        } else {
            unset($data['thumbnail']);
        }
        $project->update($data);
        return redirect()->route('admin.projects.index');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) Storage::disk('public')->delete($project->thumbnail);
        $project->delete();
        return back();
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'tech_stack'  => 'nullable|string',
            'demo_url'    => 'nullable|url',
            'repo_url'    => 'nullable|url',
            'is_featured' => 'boolean',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);
        $data['tech_stack'] = collect(explode(',', $data['tech_stack'] ?? ''))
            ->map(fn ($t) => trim($t))->filter()->values()->all();
        return $data;
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'project'; $slug = $base; $i = 2;
        while (Project::where('slug', $slug)->exists()) $slug = $base.'-'.$i++;
        return $slug;
    }
}
