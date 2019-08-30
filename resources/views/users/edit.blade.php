{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.default.master')

@section('titlePage', 'Edit User')

@section('content')
<div class="container">
    {{ Breadcrumbs::render('sitetronic-user-admin-index') }}
    <div class='col-lg-4 col-lg-offset-4'>
        <h1>
            <i class='fa fa-user-plus'></i> Edit {{$user->name}}
        </h1>
        <hr>

        {{-- Form model binding to automatically populate our fields with user data --}}
        {{ Form::model($user, array('route' => array('admin.users.update', $user->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Give Role</b></h5>

        <div class='form-group'>
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
            @endforeach
        </div>

        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}

    </div>
</div>

@endsection
