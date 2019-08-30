{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.default.master')

@section('titlePage', 'Create Permission')

@section('content')
<div class="container">
    {{ Breadcrumbs::render('sitetronic-user-admin-permissions') }}
    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> Add Permission</h1>
        <br>

        {{ Form::open(array('url' => 'admin/permissions')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', array('class' => 'form-control')) }}
        </div><br>
        {{-- If no roles exist yet --}}
        @if(!$roles->isEmpty())
            <h4>Assign Permission to Roles</h4>

            @foreach ($roles as $role)

                {{ Form::checkbox('roles[]',  $role->id ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

            @endforeach
        @endif
        <br>
        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
</div>
@endsection
