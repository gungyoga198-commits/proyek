@extends('layouts.app')

@section('title', 'Formulir Reservasi')

@section('content')

    <x-reservation
        :room="$room"
        :checkin="$checkin"
        :checkout="$checkout"
        :guests="$guests"
        :nights="$nights"
        :total-harga="$totalHarga"
    />

@endsection