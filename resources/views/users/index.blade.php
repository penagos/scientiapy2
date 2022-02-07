@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="col-lg-9 d-flex justify-content-center">
        @foreach ($users as $user)
            <div class="card" style="width: 14rem;">
                <div class="card-header d-flex justify-content-center">
                <a href="{{ route('users.view', $user->id) }}"><img src="{{ asset('img/avatar-placeholder.svg') }}" width="64" height="64" class="rounded-circle d-inline mr-2" alt="{{ $user->username }}'s profile picture"></a>
                </div>
                <div class="card-body">
                    <h6><a href="{{ route('users.view', $user->id) }}">{{ $user->username }}</a> <span class="badge badge-success fw-light small p-1">{{ $user->reputation }}</span></h6>
                    <p class="small">
                        Joined @datetime($user->created_at)
                    </p>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {!! $users->links() !!}
        </div>
    </div>
    <div class="col-lg-3">

    </div>
</div>
@stop