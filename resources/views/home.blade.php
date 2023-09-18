@extends('layouts.web')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>
    @foreach($posts as $post)
        @include('partials.post')
    @endforeach
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dolore dolorum itaque iusto quae reprehenderit. Error ratione rem saepe voluptate.</p>
    <footer>
        <h2>bye</h2>
        <h3>links</h3>
        <table>
            <tr>
                <td><a href="{{route('contact')}}">contact</a></td>
                <td><a href=""></a></td>
            </tr>
        </table>
    </footer>
@endsection
