@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}" >
@endsection

@section('content')
<div class="col-6 offset-md-3">
  <div class="card">
    <div class="card-header">Create contact</div>
    <div class="card-body">
    <form method="POST" action="{{ action('UserController@store') }}">
        {{--// Add validation token to form--}}
        {{csrf_field()}}
        <div class="row">
            <div class="col-7">
              <label for="name">Username</label>
              <input id="name" type="text" value="" name="name">
              <label for="email">E-Mail</label>
              <input id="email" type="text" value="" name="email">
            </div>
            <div class="col-5 text-center my-auto">
              <input type="submit" value="Confirm" class="btn btn-success first">
              <a href="{{ route('home') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
    </form>
    </div>
  </div>
</div>
@endsection
