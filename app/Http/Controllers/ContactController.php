<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function create() { return Inertia::render('Contact'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'body'  => 'required|string|min:10|max:2000',
        ]);
        Message::create($data);
        return back();
    }
}
