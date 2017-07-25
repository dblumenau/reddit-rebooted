@extends ('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-6">
    <form method="POST" action="/change-status">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="status_text">Status Text</label>
            <input type="text" class="form-control" id="status_text" name="status_text">
        </div>
        <div class="form-group">
            <label for="status_emoji">Status Emoji</label>
            <input class="form-control" id="status_emoji" name="status_emoji">

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Change Status</button>
        </div>
    </form></div></div>
@endsection