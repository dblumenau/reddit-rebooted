@extends ('layouts.layout')

@section('content')
    <div class="col-sm-8">
        <h1>Register</h1>
        <form method="POST" action="/register">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Name:</label>
                <input type="text" class="form-control" id="title" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            @include('layouts.errors')
        </form>


    </div>
@endsection