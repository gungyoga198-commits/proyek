@extends('layouts.app')

@section('title', 'Gallery - OGAG Hotel')

@section('content')

    <x-gallery :galleries="$galleries" :kategoris="$kategoris" :kategori="$kategori" />

@endsection