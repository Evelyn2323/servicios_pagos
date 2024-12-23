@extends('layouts.app')

@section('content')
<h1>{{ $service->name }}</h1>
<p>{{ $service->description }}</p>
<p>Precio: ${{ $service->price }}</p>

<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <button type="submit">Pagar</button>
</form>
@endsection
