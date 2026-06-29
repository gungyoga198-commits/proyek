@extends('layouts.app')

@section('title', 'Rooms - OGAG Hotel')

@section('content')

    {{-- Teruskan $rooms dari route ke dalam component --}}
    <x-rooms :rooms="$rooms" />

@endsection
