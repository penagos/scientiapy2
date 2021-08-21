@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-9">
            <h3 class="fw-normal">{{ $question->title }}</h3>
            <h6 class="text-muted fw-normal">Asked by <a href="">{{ $question->asker()->name }}</a> on @date($question->date())</h6>
            <hr>
            <x-question type="detailed" :question="$question"/>

            <h4 class="text-secondary">X answers</h4>
            <hr>
            @foreach ($question->answers as $answer)
                <x-post :post="$answer"/>
            @endforeach
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>
@stop