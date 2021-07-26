@extends('layouts.app')

@section('content')

    @if($group)

        @include('parts.group-info', compact('group'))

        <section class="orders py-12 space-y-2 ">

            <livewire:orders.orders :groupId="$group->id" />

        </section>

    @else

        <div class="text-center">
            <div class="base-primary p-lg rounded">
                <div class="text-4xl">@lang('no-groups')</div>
                <div class="">@lang('call-admin')</div>
            </div>
        </div>

    @endif

@endsection
