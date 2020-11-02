@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('employees.title') }}</h1>
        <div class="d-flex">
            <div>
                {{ BsForm::get(route('employees.index'), ['class' => 'form-inline']) }}
                {{ BsForm::text('filter[name]', optional($filter)['name'])->attribute('class', 'form-control mr-2')->placeholder(__('employees.placeholder.filter_name')) }}
                {{ BsForm::select('filter[role_id]', $roles, optional($filter)['role_id'])->attribute('class', 'form-control mr-2')->placeholder(__('employees.placeholder.choose_role')) }}
                {{ BsForm::submit(__('layout.buttons.apply'))->primary()->attribute('class', 'btn btn-outline-primary mr-2') }}
                @if($filter)
                    <a href="{{ route('employees.index') }}"
                       class="btn btn-outline-danger">{{ __('layout.buttons.reset') }}</a>
                @endif
                {{ BsForm::close() }}
            </div>
            @auth
                <a href="{{ route('employees.create') }}"
                   class="btn btn-primary ml-auto">{{ __('layout.buttons.add_new') }}</a>
            @endauth
        </div>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>{{ __('layout.headers.name') }}</th>
                <th>{{ __('layout.headers.bio') }}</th>
                <th>{{ __('layout.headers.role') }}</th>
                <th>{{ __('layout.headers.salary') }}</th>
                @auth
                    <th>{{ __('layout.headers.actions') }}</th>
                @endauth
            </tr>
            </thead>
            @foreach($employees as $employee)
                <tr>
                    <td><a href="{{ route('employees.show', $employee) }}">{{ $employee->name }}</a></td>
                    <td class="text-nowrap">{{ $employee->bio }}</td>
                    <td>{{ optional($employee->role)->name }}</td>
                    <td>{{ $employee->salary }}</td>
                    @auth
                        <td>
                            @can('update', $employee)
                                <a href="{{ route('employees.edit', $employee) }}">
                                    {{ __('layout.buttons.edit') }}
                                </a>
                            @endcan
                            @can('delete', $employee)
                                <a href="{{ route('employees.destroy', $employee) }}"
                                   data-confirm="{{ __('layout.texts.confirmation') }}"
                                   data-method="delete" rel="nofollow" class="text-danger">
                                    {{ __('layout.buttons.remove') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </table>

        {{ $employees->links() }}
    </div>
@endsection
