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
                <th>Registered At:</th>
                <th>Manage:</th>
            </tr>
            @foreach ($users as $key => $value)

                <tr>
                    <td width="50px">{{$value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    {{--Filter createdAt field: --}}
                    <td width=135px>{{substr($value['created_at'], 0, strpos($value['created_at'], "T"))}}</td>
                    <td width="200px">
                        <a href="#" class="btn btn-success">Edit</a>
                        {{--@info: Verzend een form action naar de userController destroy function & geef het id mee--}}
                        {{$test = $value['id'] }}
                        <form method="POST" action="{{ action('UserController@destroy', $value['id']) }}">
                            {{method_field("DELETE")}}
                            {{csrf_field()}}
                            <button type="submit" value="delete" class="btn btn-danger">Delete</button>
                        </form>

                        <a href="{{ route('edit') }}" class="btn btn-success manage">Edit</a>
                        <a href="#" class="btn btn-danger manage">Delete</a>

                    </td>
                </tr>
            @endforeach
        </table>

    </div>
</div>
@endsection
