<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('CSS/styless.css') }}">
    <title>Pagos</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenido al panel de servicios</h1>

        <!-- Panel de Pagos -->
        <div class="panel">
            <h2>Realizar un Pago</h2>
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <div>
                    <label for="service">Servicio</label>
                    <input type="text" id="service" name="service" required>
                </div>
                <div>
                    <label for="amount">Monto</label>
                    <input type="number" id="amount" name="amount" required>
                </div>
                <button type="submit">Realizar Pago</button>
            </form>
        </div>

        <!-- Mostrar los pagos realizados -->
        <div class="panel">
            <h2>Pagos Realizados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->service }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->created_at }}</td>
                            <td>
                                <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botones de acciones (Editar perfil y Cerrar sesión) -->
        <div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
            <a href="{{ route('profile.edit') }}" class="btn-edit-profile">Editar perfil</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>
