@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-9">
            @foreach ($questions as $question)
                <x-question type="simple" :question="$question"/>
            @endforeach

            <div class="mt-4 justify-content-center">
                {!! $questions->appends(['q' => Request::input('q')])->links() !!}
            </div>
        </div>
        <div class="col-lg-3">
            <x-hot-questions/>
            <div class="mt-5"></div>
            <x-unanswered-questions/>
        </div>
    </div>
</div>
@stop