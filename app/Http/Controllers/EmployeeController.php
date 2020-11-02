<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index(Request $request)
    {
        $employees = QueryBuilder::for(Employee::class)
            ->allowedFilters([
                AllowedFilter::exact('role_id'),
                'name',
            ])
            ->with(['role'])
            ->latest()
            ->paginate(15);

        $filter = $request->get('filter');

        $roles = Role::pluck('name', 'id');

        return view('employees.index', compact('employees', 'filter', 'roles'));
    }

    public function create()
    {
        $employee = new Employee();

        $roles = Role::pluck('name', 'id');

        return view('employees.create', compact('employee', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:employees',
                'bio' => 'max:1000',
                'role_id' => 'nullable|exists:roles,id',
                'salary' => 'required|numeric'
            ]
        );

        $employee = new Employee();
        $data = $request->only(['name', 'bio', 'salary']);
        $employee->fill($data);

        $employee->role()->associate($request->input('role_id'));

        $employee->saveOrFail();

        flash(__('employees.flash.created'))->success();

        return redirect()
            ->route('employees.show', $employee);
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $roles = Role::pluck('name', 'id');

        return view('employees.edit', compact('employee', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $this->validate(
            $request,
            [
                'name' => Rule::unique('employees', 'name')->ignore($employee),
                'bio' => 'max:1000',
                'role_id' => 'nullable|exists:roles,id',
                'salary' => 'required|numeric'
            ]
        );

        $data = $request->only(['name', 'bio', 'salary']);

        $employee->fill($data);
        $employee->role()->associate($request->input('role_id'));

        $employee->saveOrFail();

        flash(__('employees.flash.updated'))->success();

        return redirect()
            ->route('employees.show', $employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        flash(__('employees.flash.deleted'))->success();

        return redirect()
            ->route('employees.index');
    }
}
