@extends('main')

@section('content')
    @auth
        <addform user_id="{{ Auth::user() ? Auth::user()->id : null }}"></addform>
    @endauth
    @guest
        <p class="mt-4 alert alert-danger">Not authenticated to add posts</p>
    @endguest
@endsection