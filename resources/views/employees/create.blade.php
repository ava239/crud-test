@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('employees.create_title') }}</h1>
        <div class="row">
            <div class="col-lg-6">
                {{ BsForm::open(route('employees.store')) }}
                @include('employees.form')
                <div>
                    {{ BsForm::submit(__('layout.buttons.create'))->primary() }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
