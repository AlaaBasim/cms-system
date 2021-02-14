<x-admin-master>
    @section('content')
        <h1>Create</h1>

        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" area-describedby="" placeholder="Enter Title"> 
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image" area-describedby=""> 
            </div>

            <div class="form-group">
                <textarea class="form-control" name="body" id="id" cols="30" rows="10"></textarea>
                <input type="submit" class="btn btn-primary">
            </div>    
        
        
        </form>
    @endsection
</x-admin-master>