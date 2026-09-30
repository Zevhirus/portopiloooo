<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Inertia\Inertia;

class CertificateController extends Controller
{
    public function index()
    {
        return Inertia::render('Certificates/Index', [
            'certificates' => Certificate::orderByDesc('year')->orderByDesc('is_featured')->get(),
        ]);
    }
}
