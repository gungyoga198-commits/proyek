@extends('layouts.app')

@section('title', 'Detail Rooms')

@section('content')

    <x-roomsdetail :room="$room" />
    
@endsection