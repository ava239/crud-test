@extends('layouts.app')
@section('content')
    {{ BsForm::open(route('employees.store')) }}
    @include('employees.form')
    <div>
        {{ BsForm::submit(__('layout.buttons.create'))->primary() }}
    </div>
    {{ Form::close() }}
@endsection
