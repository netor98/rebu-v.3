<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\UserList;



class AdminController extends Controller
{
    public function index() {
    
    	if (!auth()->check()) {
        	return redirect('login');
        }
    
        if (auth()->user()->id !== 1) {
            return redirect('shop');
        }

        
        $products = Product::all();
       
        return view('admin.admin', compact('products'));
    }

    public function salesUser() {
    
    	if (!auth()->check()) {
        	return redirect('login');
        }
    
        if (auth()->user()->id !== 1) {
            return redirect('shop');
        }

        $users = User::paginate(5);

        return view('admin.sales_users', compact('users'));
    }


    public function create() {
        return view('admin.add-product');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:users',
                'cuantity' => 'required|numeric',
                'price' => 'required|numeric',
                'active' => 'required|numeric',
                'image' => 'mimes:png,jpeg,jpg|max:2048',
            ]
        );

        $file_path = public_path('uploads');
        $insert = new Product();
        $insert->name = $request->name;
        $insert->cuantity = $request->cuantity;
        $insert->price = $request->price;
        $insert->active = $request->active;
        $insert->description = 'En desarrollo';

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
 
            $file->storeAs('public/uploads', $file_name);
            $insert->image = $file_name;
        }

        $result = $insert->save();
        return redirect()->route('admin');
    }

    public function edit($id)
    {
        $edit = Product::findOrFail($id);
        return view('admin.add-product', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name,' . $id,
            'cuantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'active' => 'required|numeric',
            'image' => 'mimes:png,jpeg,jpg|max:2048',
        ]);
    
        $update = Product::findOrFail($id);
        $update->name = $request->name;
        $update->cuantity = $request->cuantity;
        $update->price = $request->price;
        $update->active = $request->active;
        $update->description = 'En desarrollo';
    
        if ($request->hasfile('image')) {
           	$file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
 
            $file->storeAs('public/uploads', $file_name);
        
    
            $update->image = $file_name;
        }
        $update->save();
        return redirect()->route('admin');
    }
    

	public function editUser(Request $request)
    {
       	$user = User::find(1);
    	return view('admin-edit', compact('userList', 'user')); 
    }

	public function editRequest(Request $request)
    {
    	$request->validate([
            'name' => 'required|max:30|min:5',
            'username' => 'required|min:5|max:20',
            'email' => 'required||email|max:60',
            'password' => 'required|min:5',
        ]);
    
    	$user = User::find(1);
    
    	$user->update([
        	"name" => $request->name,
        	"username" => $request->username,
        	"email" => $request->email,
        	"password" => $request->password
    	]);
    
    
    	return redirect()->route('admin')->with('update', 'El usuario ha sido actualizado');
    
    
    	dd($request->username);
    }



    public function delete(Request $request)
    {
        if($request->id) {
            $update = Product::findOrFail($request->id);
            $update->active = 0;
            $result = $update->save();
        }

    }
    
}