@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="row">
            <div class="col-lg-9">
                <h3 class="fw-normal">{{ $question->title }}</h3>
                <h6 class="text-muted fw-normal">Asked by <a href="">{{ $question->asker()->username }}</a> on @date($question->date())</h6>
                <hr>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('questions.ask') }}" class="btn btn-primary">Ask a Question</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <livewire:edit-post :post="$question->post" :qid="$question->id" :wire:key="'p'.$question->post->id"/>
                </div>

                <div class="row mt-4">
                    <h4 class="text-secondary">{{ $question->answers->count() }} answers</h4>
                    @foreach ($question->answers as $answer)
                        <livewire:edit-post :post="$answer" :wire:key="'p'.$answer->id"/>
                    @endforeach
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div id="editor"></div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        @if (Auth::check())
                            <livewire:edit-post :qid="$question->id" :wire:key="newanswer" />
                        @else
                            <a href="#" onclick="Livewire.emit('openModal', 'login'); return false;">Login</a> or <a href="#" onclick="Livewire.emit('openModal', 'register'); return false;">create an account</a> to post an answer.
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <h5 class="fw-light">Related Questions</h5>

                <ul class="list-unstyled">
                    <li class="pt-2 small"><span class="badge badge-success" style="width: 36px;">143</span> <a href="#">How to determine base type of a pointer in LLVM?</a></li>
                    <li class="pt-2 small"><span class="badge badge-success" style="width: 36px;">6</span> <a href="#">What does the ??? operator do in C++?</a></li>
                    <li class="pt-2 small"><span class="badge badge-success" style="width: 36px;">45</span> <a href="#">Difference between shared and static library linkage?</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop