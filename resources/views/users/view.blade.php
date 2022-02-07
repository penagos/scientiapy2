@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <img class="card-img-top p-5" src="{{ asset('img/avatar-placeholder.svg') }}" alt="Profile picture">
                <div class="card-body">
                    <h5 class="fw-light">{{ $user->username }} <span class="badge badge-success fw-light small p-1">{{ $user->reputation }}</span></h5>
                    <p class="small">
                        Joined @datetime($user->created_at)
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <h5 class="fw-light">{{ $questions->total() }} Questions asked by {{ $user->username }}</h5>

                @foreach ($questions as $question)
                    <x-question type="simple" :question="$question"/>
                @endforeach

                <div class="mt-4 justify-content-center">
                    {!! $questions->appends(['q' => Request::input('q')])->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop