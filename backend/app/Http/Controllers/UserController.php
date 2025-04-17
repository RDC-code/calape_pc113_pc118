<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
 //SHOW ALL
    public function users()
    {
        return response()->json(User::all());
    }


    public function search(Request $request)
    {
        $search = $request->input('search'); 
        $users = User::where('name', 'LIKE', "%$search%")->get();
        return response()->json($users);
    }

//SHOW BY ID ONLY
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

//CREATEE
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string',
            'role'     => 'required|string',
        ]);

    
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return response()->json($user, 201);
    }

//UPDATE
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name'     => 'string',
            'email'    => 'email|unique:users,email,' . $id,
            'password' => 'string',
            'role'     => 'string',
        ]);

        $data = $request->all();

   
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return response()->json($user);
    }

//DELETE
    public function delete(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
