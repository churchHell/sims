@extends('layouts.app')

@section('content')

    <div class="container">

        <livewire:groups.groups />

        <br>

        <span class="mt-20 py-1 px-4 space-x-2 text-gray-600 border border-gray-600 placeholder-gray-600 rounded shadow-md">
            <i class="fas fa-trash"></i>
            <input type="text" class="bg-transparent outline-none" placeholder="Имя">
            <i class="fas fa-check"></i>
        </span>
        {{--  <span class="p-1 bg-gray-600 text-white">
            <i class="fas fa-check"></i>
        </span>  --}}

    </div>

@endsection
