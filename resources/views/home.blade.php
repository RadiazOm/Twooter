@extends('layouts.web')
@extends('partials.post')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>
    @yield('post')
@endsection

