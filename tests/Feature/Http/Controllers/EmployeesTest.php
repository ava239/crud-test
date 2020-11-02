<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->user = User::inRandomOrder()->first();
    }

    public function testIndex()
    {
        $response = $this->get(route('employees.index'));

        $response->assertOk();
    }

    public function testCreate()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('employees.create'));

        $response->assertOk();
    }

    public function testStore()
    {
        $this->actingAs($this->user);

        $role = Role::inRandomOrder()->first();

        $employeeData = [
            'name' => $this->faker->name,
            'salary' => $this->faker->randomNumber(4),
            'bio' => implode(' ', $this->faker->sentences),
            'role_id' => $role->id,
        ];

        $response = $this->post(route('employees.store'), $employeeData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('employees', $employeeData);
    }

    public function testEdit()
    {
        $this->actingAs($this->user);

        $employee = Employee::inRandomOrder()->first();

        $response = $this->get(route('employees.edit', $employee));

        $response->assertOk()
            ->assertSee($employee->name);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user);

        $employee = Employee::inRandomOrder()->first();

        $role = Role::inRandomOrder()->first();
        $employeeData = [
            'name' => $this->faker->name,
            'salary' => $this->faker->randomNumber(4),
            'bio' => implode(' ', $this->faker->sentences),
            'role_id' => $role->id,
        ];

        $response = $this->patch(route('employees.update', $employee), $employeeData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $updatedEmployeeData = array_merge($employeeData, ['id' => $employee->id]);

        $this->assertDatabaseHas('employees', $updatedEmployeeData);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user);

        $employee = Employee::inRandomOrder()->first();

        $response = $this->delete(route('employees.destroy', $employee));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $employeeData = $employee->only('id');
        $this->assertDatabaseMissing('employees', $employeeData);
    }

    public function testShow()
    {
        $employee = Employee::inRandomOrder()->first();

        $response = $this->get(route('employees.show', $employee));

        $response->assertOk()
            ->assertSee($employee->name);
    }

    public function testUnathorizedDestroy()
    {
        $employee = Employee::inRandomOrder()->first();

        $response = $this->delete(route('employees.destroy', $employee));

        $response->assertForbidden();

        $employeeData = $employee->only('id');
        $this->assertDatabaseHas('employees', $employeeData);
    }
}
