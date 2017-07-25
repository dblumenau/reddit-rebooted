@include('layouts.head')
@include('layouts.nav')
@if ($flash = session('message'))
    <div class="alert alert-success" role="alert">
        {{$flash}}
    </div>
@endif
{{--@include('layouts.header')--}}
<div class="container">
    {{--<div class="row">--}}
        @yield('content')
        {{--@include('layouts.sidebar')--}}
    {{--</div><!-- /.row -->--}}
</div><!-- /.container -->
{{--@include('layouts.footer')--}}
@include('layouts.scripts')
</body>
</html>