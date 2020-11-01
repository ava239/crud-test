@extends('layouts.app')
@section('content')
    {{ BsForm::patch(route('employees.update', $object)) }}
    @include('employees.form')
    <div>
        {{ BsForm::submit(__('layout.buttons.update'))->primary() }}
    </div>
    {{ BsForm::close() }}
@endsection
