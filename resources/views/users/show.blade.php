@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-12 my-4">
            <div class="float-left">
                <h2>Show User</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 my-4">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>

                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
        </div>
    </div>
@endsection