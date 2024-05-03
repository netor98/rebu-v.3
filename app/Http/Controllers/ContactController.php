<?php

// ContactController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Asegúrate de tener el modelo Message

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

        return back()->with('message', 'Tu mensaje ha sido enviado correctamente.');
    }
}

