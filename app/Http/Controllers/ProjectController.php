<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/Index', ['projects' => Project::latest()->get()]);
    }

    public function show(Project $project)
    {
        return Inertia::render('Projects/Show', ['project' => $project]);
    }
}
