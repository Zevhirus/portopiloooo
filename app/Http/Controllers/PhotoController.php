<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Inertia\Inertia;

class PhotoController extends Controller
{
    public function index()
    {
        return Inertia::render('Photos/Index', [
            'photos' => Photo::orderBy('sort')->get(),
        ]);
    }
}
