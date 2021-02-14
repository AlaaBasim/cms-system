<x-admin-master>
    @section('content')
        <h1>User Profile for {{$user->name}} </h1> 

        <div class="row">
            <div class="col-sm-6">
            
            <form method="POST" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                @csrf

                @method('PUT')
                <div class="form-group mb-4">
                  <img class="img-profile rounded-circle" width='80px' src="{{$user->avatar}}">
                </div>

                <div class="form-group">
                 
                    <input type="file" name="avatar"> 
                </div>


                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" value="{{$user->name}}"> 
                     @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control   {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" value="{{$user->email}}"> 
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control  {{$errors->has('password') ? 'is-invalid' : ''}}" id="password"> 
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Confirm Password </label>
                    <input type="password" name="password-confirmation" class="form-control" id="password-confirmation"> 
                </div>

                <div class="form-group">
                    
                    <input type="submit" class="btn btn-primary">
                </div>    
            
            
            </form>

            </div> 
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h6 class="m-0 font-weight-bold text-primary"> Roles</h6>
                <table class="table table-border" id="users-table" width="100%">
                    <thead>
                    <tr>
                    <th>Options</th> 
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Attach</th>
                    <th>Detach</th>
                    </tr>
                    </thead>



                    <tfoot>
                    <tr> 
                    <th>Options</th> 
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Attach</th>
                    <th>Detach</th>
                    </tr>
                    </tfoot>

                    
                    <tbody>
                    @foreach($roles as $role)
                    <tr>
                    <td><input type="checkbox"
                    @foreach($user->roles as $user_role)
                        @if($user_role->slug == $role->slug)
                            checked
                        @endif
                    @endforeach
                    ></td>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->slug}}</td>
                    <td>
                        <form method="post" action="{{route('user.role.attach', $user)}}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="role" value="{{$role->id}}">
                            <button class="btn btn-primary"
                            @if($user->roles->contains($role))
                            disabled
                            @endif>Attach</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('user.role.detach', $user)}}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="role" value="{{$role->id}}">
                            <button class="btn btn-danger" 
                            @if(!$user->roles->contains($role))
                            disabled
                            @endif>Detach</button>
                        </form>
                    </td>
                    
                    </tr>

                    @endforeach
                    </tbody>     
                </table>
            </div>
        </div>
     
    @endsection
</x-admin-master>