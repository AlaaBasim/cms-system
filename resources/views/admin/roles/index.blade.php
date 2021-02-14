<x-admin-master>


@section('content')
<h2 class="text-center"> Roles </h2>

<div class="row pt-4">

    @if(session()->has('role-deleted'))
        <div class="alert alert-danger">
            {{session('role-deleted')}}
        </div>
    @elseif(session()->has('role-updated'))
        <div class="alert alert-primary">
            {{session('role-updated')}}
        </div>
    @endif
    <div class="col-sm-3">
        <form method="post" action="{{route('roles.store')}}">
            @csrf
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
            </div>

            <button type="submit" id="name"  class="form-control btn btn-primary">Add Role</button>
        </form>
    </div>

    <div class="col-sm-9">

        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th> Name </th>
                    <th>Slug</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    
                    <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                    <td>{{$role->id}}</td>
                    <td><a href="{{route('roles.edit', $role)}}">{{$role->name}}</a></td>
                    <td>{{$role->slug}}</td>
                    <td>
                            <form method="post" action="{{route('roles.destroy', $role)}}">
                            @csrf
                            @method('DELETE')
                                <button type="submit"  class="form-control btn btn-danger">Delete</button>
                            </form>
                    </td>
                    </tr>
                    @endforeach
                
                </tbody>
                </table>
        </div>
    </div>
    
    
</div>
   


@endsection

</x-admin-master>