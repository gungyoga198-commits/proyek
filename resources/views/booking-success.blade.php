@extends('layouts.app')

@section('title', 'Reservasi Berhasil')

@section('content')

    <x-booking-success :reservation="$reservation" />

@endsection