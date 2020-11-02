@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">
            {{ __('employees.show_title') }}: {{ $employee->name }}
            @auth
                <a href="{{ route('employees.edit', $employee) }}">&#9881;</a>
            @endauth
        </h1>
        <div class="row">
            <div class="col-lg-6">
                <p><strong>{{ __('layout.headers.name') }}</strong>: {{ $employee->name }}</p>
                <p><strong>{{ __('layout.headers.salary') }}</strong>: {{ $employee->salary }}</p>
                @if($employee->bio)
                    <p><strong>{{ __('layout.headers.bio') }}</strong>: {{ $employee->bio }}</p>
                @endif
                @if($employee->role)
                    <p><strong>{{ __('layout.headers.role') }}</strong>: {{ $employee->role->name }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
