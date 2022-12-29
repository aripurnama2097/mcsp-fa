

@extends('layouts.main') 

@section('container')
<article>
    @foreach($posts as $post)
     <h2>
        <a href="/record/"> {{$post["title"]}}</a>
     </h2>
      <p> {{$post["body"]}}</p>   
    @endforeach
</article>

@endsection