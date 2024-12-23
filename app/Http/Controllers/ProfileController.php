<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición del perfil del usuario.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualizar los datos del perfil del usuario.
     */
    public function update(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        
        // Actualizar el nombre y correo electrónico
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Si la contraseña es proporcionada, actualízala
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Eliminar la cuenta del usuario.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
