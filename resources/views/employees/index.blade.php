@extends('layouts.app')
@section('content')

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-brght-bg-dark  o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Add-Window"></i>
                    <div class="content">
                        <a href="{{ route('employees.create') }}"><h4 class=" mt-2 mb-0">{{ __('layout.buttons.add_new') }}</h4></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        @foreach($employees as $employee)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 ">
                <div class="card object-card bg-dark overlay-dark text-white o-hidden mb-4">
                    <div class="card-img-overlay">
                        <div class="text-center pt-4">
                            <a href="{{ route('employees.show', $employee) }}">
                                <h5 class="card-title mb-2 text-white">
                                    {{ $employee->name }}
                                </h5>
                            </a>
                            <p class="card-subtitle">{{ $employee->bio }}</p>
                            <div class="separator border-top mb-2"></div>
                        </div>
                        <div class="p-1 card-footer font-weight-light d-flex text-center">
                            @can('update', $employee)
                            <a class="btn btn-primary text-white btn-rounded"
                               href="{{ route('employees.edit', $employee) }}">{{ __('layout.buttons.edit') }}</a>
                            @endcan
                            @can('delete', $employee)
                            <a href="{{ route('employees.destroy', $employee) }}"
                               class="btn btn-danger text-white btn-rounded" data-confirm="{{ __('layout.texts.confirmation') }}"
                               data-method="delete" rel="nofollow">
                                {{ __('layout.buttons.remove') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $employees->links() }}
@endsection
