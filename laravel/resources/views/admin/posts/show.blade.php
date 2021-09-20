@extends('layouts.app')

@section('title', "Mostra post")

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p>Categoria: 
                  @if ($post->category)
                  {{ $post->category->name }}
                  @endif
                </p>
            </div>
            <div class="card-body">
              <h5 class="card-title">{{$post->title}}</h5>
              <p class="card-text">{{$post->content}}</p>
              <div class="my-3">
                @if ($post->tags)
                   @foreach ($post->tags as $tag)
                       <div class="badge badge-danger p-1">{{ $tag->name }}</div>
                   @endforeach 
                @endif
              </div>
              <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna indietro</a>
            </div>
          </div>
    </div>
@endsection