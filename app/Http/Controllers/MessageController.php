<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Mail\ResponseMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

        return back()->with('success', 'Tu mensaje ha sido enviado.');
    }

    public function index()
    {
        $messages = Message::paginate(4);
        return view('admin.messages.index', compact('messages'));
    }

    public function markAsRead($id)
    {
        $message = Message::find($id);
        $message->is_read = true;
        $message->save();

        return back()->with('read', 'Mensaje leído.');;
    }

    public function destroy($id)
    {
        Message::find($id)->delete();
        return back();
    }



    public function respond(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $response = $request->input('response');

        // Enviar respuesta por email
        Mail::to($message->email)->send(new ResponseMail($response));

       
        $message->save();

        return back()->with('success', 'Respuesta enviada correctamente.');
    }

}
