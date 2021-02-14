<x-admin-master>


@section('content')
<h2 class="text-center">  Permissions </h2>

<div class="row pt-4">

    @if(session()->has('permission-deleted'))
        <div class="alert alert-danger">
            {{session('permission-deleted')}}
        </div>
    @elseif(session()->has('permission-updated'))
        <div class="alert alert-primary">
            {{session('permission-updated')}}
        </div>
    @endif

    <div class="col-sm-3">
        <form method="post" action="{{route('permissions.store')}}">
            @csrf
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
            </div>

            <button type="submit" id="name"  class="form-control btn btn-primary">Add Pemission</button>
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
                    @foreach($permissions as $permission)
                    <tr>
                    <td>{{$permission->id}}</td>
                    <td><a href="{{route('permissions.edit', $permission)}}">{{$permission->name}}</a></td>
                    <td>{{$permission->slug}}</td>
                    <td>
                            <form method="post" action="{{route('permissions.destroy', $permission)}}">
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