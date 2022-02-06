@extends('layouts.app')
@section('title', $question->title)

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="row">
            <div class="col-lg-9">
                <h3 class="fw-normal">{{ $question->title }}</h3>
                <h6 class="text-muted fw-normal">Asked by <a href="{{ route('users.view', $question->post->user->id) }}">{{ $question->post->user->username }}</a> on @date($question->date())</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <livewire:post :post="$question->post" :question="$question" :wire:key="'p'.$question->post->id"/>
                </div>

                <div class="row mt-4">
                    <h4 class="text-secondary">{{ $question->answers->count() }} answers</h4>
                    @foreach ($question->answers as $answer)
                        <livewire:post :post="$answer" :question="$question" :wire:key="'p'.$answer->id"/>
                    @endforeach
                </div>

                <div class="row mt-2">
                    <div class="col-lg-12">
                        @if (Auth::check())
                            <livewire:post :question="$question" :wire:key="newanswer" />
                        @else
                            <a href="#" onclick="Livewire.emit('openModal', 'login'); return false;">Login</a> or <a href="#" onclick="Livewire.emit('openModal', 'register'); return false;">create an account</a> to post an answer.
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <x-related-questions/>
                <div class="mt-5"></div>
                <x-hot-questions/>
            </div>
        </div>
    </div>
</div>
@stop