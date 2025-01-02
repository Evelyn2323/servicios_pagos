<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Verificamos si el pago realmente existe
        if ($payment) {
            // Eliminar el pago
            $payment->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->route('payments.index')->with('success', 'Pago eliminado correctamente');
        }

        // Si no se encuentra el pago
        return redirect()->route('payments.index')->with('error', 'Pago no encontrado');
    }
    
    
    public function update($id, Request $request)
{
    if (Auth::user()->role->name !== 'admin') {
        return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción');
    }

    // Si es admin, continuar con la actualización
    $Payment = Payment::find($id);
    $Payment->update($request->all());
    return redirect()->route('Payment.index');
}


}
