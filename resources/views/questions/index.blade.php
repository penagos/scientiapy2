@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-9">
        @foreach ($questions as $question)
            <x-question type="simple" :question="$question"/>
        @endforeach

        <div class="mt-4 justify-content-center">
            {!! $questions->appends(['q' => Request::input('q')])->links() !!}
        </div>
    </div>
    <div class="col-lg-3">

    </div>
</div>
@stop