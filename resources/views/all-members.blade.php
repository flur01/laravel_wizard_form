@extends('index')

@section('title', 'All members')

@section('main')

<nav class="navbar navbar-light" style="background-color: rgba(0, 0, 0, 0.05);">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <button class="btn btn-lg btn-outline-dark">
        <h1>
          Registration
        </h1>
      </button>
    </a>
    @auth

    <form class="d-flex" action="{{ route('logout') }}" method="POST">
      <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
      <button class="btn btn-lg btn-outline-dark" type="submit">Logout</button>
    </form>
    @endauth
  </div>
</nav>


  <all-members csrf="{{csrf_token()}}"></all-members>
@endsection