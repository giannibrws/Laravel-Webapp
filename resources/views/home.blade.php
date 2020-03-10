@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>

        <table class="table table-bordered my-5">
            <tr>
                <th width="80px">#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Registered At:</th>
                <th>
                    Manage:
                </th>

            </tr>

            @foreach ($users as $key => $value)

                <tr>
                    <td>{{$value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    {{--Filter createdAt field: --}}
                    <td>{{substr($value['created_at'], 0, strpos($value['created_at'], "T"))}}</td>
                    <td width="200px">
                        <a href="#" class="btn btn-success">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach

        </table>

    </div>
</div>
@endsection
