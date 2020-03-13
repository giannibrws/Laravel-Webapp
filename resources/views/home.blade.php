@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}" >
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    @include('newcontact')
        </div>

        <table class="table table-bordered my-5">
            <tr>
                <th width="50px">#</th>
                <th width="200px">Username</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Manage</th>
            </tr>
            <?php
            $iterator = 0;
            ?>
            @foreach ($users as $key => $value)
                <?php $iterator++; ?>
                <tr>
                    <td width="50px">{{$iterator}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    {{--Filter createdAt field: --}}
                    <td width=135px>{{date("Y.m.d", strtotime($value['created_at']))}}</td>
                    <td width="200px">
                        <form method="PATCH" action="{{ action('UserController@edit', $value['id']) }}">
                            {{csrf_field()}}
                        <button value="edit" class="btn btn-success manage">Edit</button>
                        </form>

                        {{--@info: Verzend een form action naar de userController destroy function & geef het id mee--}}
                        <form method="POST" action="{{ action('UserController@destroy', $value['id']) }}">
                            {{method_field("DELETE")}}
                            {{csrf_field()}}
                            <button value="delete" class="btn btn-danger manage">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
{{$users->links()}}
    </div>
</div>
@endsection
