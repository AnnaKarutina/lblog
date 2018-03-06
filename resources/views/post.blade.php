@extends('main')

@section('content')
    <post postid="{{ $id }}" user="{{ Auth::user() ? Auth::user()->name : null }}"></post>
@endsection