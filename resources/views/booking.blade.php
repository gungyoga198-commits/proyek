@extends('layouts.app')

@section('title', 'Booking')

@section('content')

    <x-booking
        :rooms="$rooms"
        :selected="$selected"
        :checkin="$checkin"
        :checkout="$checkout"
        :guests="$guests"
    />

@endsection