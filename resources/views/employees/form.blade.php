<div class=" form-group mb-3">
    {{ BsForm::text('name', $employee->name)->label(__('layout.headers.name')) }}
</div>
<div class=" form-group mb-3">
    {{ BsForm::textarea('description', $employee->description)->label(__('layout.headers.bio')) }}
</div>
