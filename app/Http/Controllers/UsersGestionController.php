<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;



class UsersGestionController extends Controller
{
    public function index() {
        if(auth()->user()->id != 1) {
            return redirect('shop');
        }

        $users = User::paginate(5);

        return view('admin.gestion_users', compact('users'));
    }

    public function edit($id)
    {
        $edit = User::findOrFail($id);
        return view('admin.add-user', compact('edit'));
    }

    public function editRequest(Request $request, $id)
    {
    	$request->validate([
            'name' => 'required|max:30|min:4',
            'username' => 'required|min:4|max:20',
            'age' => 'required|numeric|min:18',
            'email' => 'required|email|max:60',
            'password' => 'required|min:5',
        ]);
    
    	$user = User::find($id);
    
    	$user->update([
        	"name" => $request->name,
        	"username" => $request->username,
        	"email" => $request->email,
            'age' => $request->age,
        	"password" => $request->password
    	]);
    
    	return redirect()->route('admin.users')->with('update', 'El usuario ha sido actualizado');
    }

    public function create() {
        return view('admin.add-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|min:4',
            'username' => 'required|min:4|max:20',
            'age' => 'required|numeric|min:18',
            'email' => 'required|email|max:60',
            'password' => 'required|min:5',
        ]);

        $insert = new User();
        $insert->name = $request->name;
        $insert->username = $request->username;
        $insert->age = $request->age;
        $insert->password = Hash::make($request->password);
        $insert->email = $request->email;
        $insert->email_verified_at = Carbon::now(); // Esto asigna la fecha y hora actuales

        $result = $insert->save();
        return redirect()->route('admin.users');
    }
}