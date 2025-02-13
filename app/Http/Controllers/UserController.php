<?php

namespace App\Http\Controllers;

use App\Livewire\Users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Usuarios.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('Usuarios.crear');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //Validacion de campos
        $inputs = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:rfc,dns',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $inputs["password"] = Hash::make($inputs["password"]); //encriptamos la contraseña
        User::create($inputs); //guardamos el usuario
        return redirect()->route('users.index')->with('message', 'Usaurio Creado'); //regresamos al listado de usuarios
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {
        return view('Usuarios.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
    }
}
