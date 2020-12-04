@extends('admin.layouts.template')

@section('main')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        {{-- @can('role-create') --}}
            <a class="btn btn-success" href="{{ route('admin_roles.create') }}"> Create New Role</a>
        {{-- @endcan --}}
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('admin_roles.show',$role->id) }}">Show</a>
            {{-- @can('role-edit') --}}
                <a class="btn btn-primary" href="{{ route('admin_roles.edit',$role->id) }}">Edit</a>
            {{-- @endcan --}}

            {{-- @can('role-delete') --}}
                <form action="{{route('admin_roles.destroy', $role->id )}}" method="post" enctype="multipart/form-data" style="display:inline">
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            {{-- @endcan --}}
            @hasrole('Dispensary')
            <form action="{{route('admin_roles.destroy',$role->id )}}" method="post" enctype="multipart/form-data" style="display:inline">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endhasrole
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
