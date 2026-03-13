<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest('id')->paginate(10);

        return view('admin.user', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => ['required','string','max:120'],
            'email'            => ['required','email','max:254','unique:users,email'],
            'password'         => ['required','string','min:8'],
            'account_type'     => ['required', Rule::in(['customer','owner','admin'])],
            'preferred_budget' => ['nullable', Rule::in(['low','medium','high'])],
        ]);

        User::create($data); // cast 'password' => 'hashed' lo cifra

        return back()->with('success', 'Usuario creado correctamente.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'             => ['required','string','max:120'],
            'email'            => ['required','email','max:254', Rule::unique('users','email')->ignore($user->id)],
            'password'         => ['nullable','string','min:8'],
            'account_type'     => ['required', Rule::in(['customer','owner','admin'])],
            'preferred_budget' => ['nullable', Rule::in(['low','medium','high'])],
        ]);

        if (empty($data['password'])) {
            unset($data['password']); // No cambiar contraseña si no envías una
        }

        $user->update($data);

        return back()->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Usuario eliminado.');
    }
}