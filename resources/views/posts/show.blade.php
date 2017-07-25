@extends('layouts.layout')
@section('content')
    <div class="col-sm-8 blog-main">
        <h1>{{$post->title}}</h1>
        @if (count($post->tags))
            <ul>
                @foreach($post->tags as $tag)
                    {{$tag->name}}
                @endforeach
            </ul>
        @endif
        <p>{{$post->body}}</p>
        <hr>
        @if(count($post->comments))
            <div class="comments">
                <ul class="list-group">
                    @foreach ($post->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{$comment->created_at->diffForHumans()}} : &nbsp;</strong>
                            {{ $comment->body }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr>
        <div class="card">
            <div class="card-block">
                <form method="POST" action="/posts/{{$post->id}}/comments">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea class="form-control" name="body" placeholder="Your comment here." id="" cols="30"
                                  rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </form>
                @include('layouts.errors')
            </div>

        </div>
    </div>
@endsection