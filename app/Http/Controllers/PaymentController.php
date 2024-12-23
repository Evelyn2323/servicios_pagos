<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Método para mostrar el formulario de creación (si no lo tienes)
    public function create()
    {
        return view('payments.create');
    }

    //  Método para guardar el pago
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'service' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);
    
        // Crear el nuevo pago, añadiendo 'user_id'
        $payment = Payment::create([
            'service' => $validated['service'],
            'amount' => $validated['amount'],
            'created_at' => now(),  // Fecha actual
            'user_id' => auth()->id(),  // Asumiendo que el usuario está autenticado
        ]);
    
        // Redirigir al dashboard u otra vista con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Pago realizado correctamente');
    }
    

    // Este método obtiene los pagos y los pasa a la vista
    public function index()
    {
        // Obtener todos los pagos
        $payments = Payment::all();

        // Pasar los pagos a la vista dashboard
        return view('dashboard', compact('payments'));
    }

    public function show(Payment $payment)
    {
        // Mostrar detalles de un pago específico
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('profile.edit', compact('payment'));
    }
    

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('dashboard')->with('success', 'Pago eliminado correctamente.');
    }

}
