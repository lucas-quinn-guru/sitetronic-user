{{-- \resources\views\roles\index.blade.php --}}
@extends('layouts.default.master')

@section('titleTitle', 'Roles')

@section('content')
<div class="container">
    {{ Breadcrumbs::render('sitetronic-user-admin-roles') }}
    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i> Roles

        <a href="{{ route('admin.users.index') }}" class="btn btn-default pull-right">Users</a>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Operation</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td style='width:160px'>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.roles.destroy', $role->id] ]) !!}
                            <a href="{{ URL::to('admin/roles/' . $role->id . '/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ URL::to('admin/roles/create') }}" class="btn btn-success">Add Role</a>
    </div>
</div>
@endsection
