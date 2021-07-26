@extends('layouts.app')

@section('content')

    @include('index.group-info', compact('group'))

    <div class="container">

        <livewire:orders.search :groupId="$group->id" />

    </div>

@endsection
