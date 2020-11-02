<div class=" form-group mb-3">
    {{ BsForm::text('name', $employee->name)->label(__('layout.headers.name')) }}
</div>
<div class=" form-group mb-3">
    {{ BsForm::select('role_id', $roles, $employee->role_id)->label(__('layout.headers.role'))->placeholder(__('employees.placeholder.choose_role')) }}
</div>
<div class=" form-group mb-3">
    {{ BsForm::number('salary', $employee->salary)->label(__('layout.headers.salary')) }}
</div>
<div class=" form-group mb-3">
    {{ BsForm::textarea('bio', $employee->bio)->label(__('layout.headers.bio')) }}
</div>
