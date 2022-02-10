@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3">
            <x-user-profile :user="$user"/>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <h5 class="fw-light">Your favorited questions</h5>

                @foreach ($questions as $question)
                    <x-question type="simple" :question="$question"/>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop