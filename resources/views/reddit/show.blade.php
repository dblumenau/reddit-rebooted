@extends('layouts.layout')
@section('content')
    <div class="col-md-12">
        <div class="row">
            <hr>

            <div class="gal">
                @foreach($items as $item)
                    <img src="{{$item}}">
                @endforeach
            </div>
        </div>
    </div>
@endsection