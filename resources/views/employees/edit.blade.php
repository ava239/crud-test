@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('employees.edit_title') }}</h1>
        <div class="row">
            <div class="col-lg-6">
                {{ BsForm::patch(route('employees.update', $employee)) }}
                @include('employees.form')
                <div>
                    {{ BsForm::submit(__('layout.buttons.update'))->primary() }}
                </div>
                {{ BsForm::close() }}
            </div>
        </div>
    </div>
@endsection
