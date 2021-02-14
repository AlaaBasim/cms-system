<x-home-master>

@section('content')


<h1>Page Heading
          <small>Secondary Text</small>
    </h1>

      @foreach($posts as $post)

        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <p class="card-text">{{Str::limit($post->body, '75', '..etc')}}</p>
            <a href="{{route('post.show', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            {{$post->created_at->diffForHumans()}}
            <a href="#">Start Bootstrap</a>
          </div>
        </div>  

      @endforeach
   
@endsection

</x-home-master>
