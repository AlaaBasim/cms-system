<x-admin-master>
    @section('content')
        <h1>Edit A Post</h1>

        @if(Session::has('message'))

            <div class="alert alert-primary"> {{Session::get('message')}}</div>
        @endif

        <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" area-describedby="" placeholder="Enter Title" value="{{$post->title}}" > 
            </div>

            <div class="form-group">
            <div> <img height="100px" src= "{{$post->post_image}}"> </div>
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image" area-describedby=""> 
            </div>

            <div class="form-group">
                <textarea class="form-control" name="body" id="id" cols="30" rows="10" > {{$post->body}} </textarea>
                <input type="submit" class="btn btn-primary">
            </div>    
        
        
        </form>
    @endsection
</x-admin-master>