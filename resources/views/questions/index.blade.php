@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-9">
        @foreach ($questions as $question)
            <x-question type="simple" :question="$question"/>
        @endforeach
    </div>
    <div class="col-lg-3">

    </div>
</div>
@stop