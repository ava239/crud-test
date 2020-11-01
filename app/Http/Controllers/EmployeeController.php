<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index()
    {
        $employees = Employee::orderBy('name')->paginate(12);

        return view('employees.index', compact('employees'));
    }
}
