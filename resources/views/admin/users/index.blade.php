<x-admin-master>
    @section('content')
    <h1>Users</h1>

    @if(session('user-deleted'))
      <div class="alert alert-danger">{{session('user-deleted')}}</div>
    @endif
    

    <table class="table table-border" id="users-table" width="100%">
    <thead>
    <tr> 
    <th>ID</th>
    <th>Name</th>
    <th>Avatar</th>
    <th>Registered Date</th>
    <th>Updated Profile Date</th>
    </tr>
    </thead>



    <tfoot>
    <tr> 
    <th>ID</th>
    <th>Name</th>
    <th>Avatar</th>
    <th>Registered Date</th>
    <th>Updated Profile Date</th>
    </tr>
    </tfoot>

    
    <tbody>
    @foreach($users as $user)
    <tr>
    <td>{{$user->id}}</td>
    <td>{{$user->name}}</td>
    <td><img height="50px" src="{{$user->avatar}}"> </td>
    <td>{{$user->created_at->diffForHumans()}}</td>
    <td>{{$user->updated_at->diffForHumans()}}</td>
    <td>
        <form action="{{route('user.destroy', $user->id)}}" method="post">
        @csrf
        @method('DELETE')
          <button class="btn btn-danger"> Delete User </button>
        </form>     
    </td>
    </tr>

    @endforeach
    </tbody>
    
    
    </table>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    @endsection

</x-admin-master>