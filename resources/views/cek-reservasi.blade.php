@extends('layouts.app')

@section('title', 'Cek Reservasi')

@section('content')
    <x-cek-reservasi :reservations="$reservations ?? null" />
@endsection