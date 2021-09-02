@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="fw-normal">{{ $question->title }}</h3>
                    <h6 class="text-muted fw-normal">Asked by <a href="">{{ $question->asker()->name }}</a> on @date($question->date())</h6>
                    <hr>
                    <livewire:edit-post :post="$question->post" :wire:key="'p'.$question->post->id"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <h4 class="text-secondary">{{ $question->answers->count() }} answers</h4>
                    <div>
                    @foreach ($question->answers as $answer)
                        <livewire:edit-post :post="$answer" :wire:key="'p'.$answer->id"/>
                    @endforeach
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <div id="editor"></div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary" value="Post Answer">
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('questions.ask') }}" class="btn btn-primary">Ask a Question</a>
        </div>
    </div>
</div>
@stop