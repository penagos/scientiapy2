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
                    <div class="d-flex p-0 justify-content-between">
                        <div>
                            <h4 class="text-secondary">{{ $question->answers->count() }} answers</h4>
                        </div>

                        @if ($question->answers->count())
                        <div>
                            <ul class="nav nav-pills bg-white border-1">
                                <li class="nav-item">
                                    <small><a class="nav-link @if ((request()->get('sort') ?? 'hot') == 'hot') active @endif pt-1 pb-1" href="?sort=hot">Votes</a></small>
                                </li>
                                <li class="nav-item">
                                    <small><a class="nav-link @if (request()->get('sort') == 'new') active @endif pt-1 pb-1" href="?sort=new">New</a></small>
                                </li>
                                <li class="nav-item">
                                    <small><a class="nav-link @if (request()->get('sort') == 'old') active @endif pt-1 pb-1" href="?sort=old">Old</a></small>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>

                    @foreach ($question->answers as $answer)
                        <livewire:post :post="$answer" :question="$question" :wire:key="'p'.$answer->id"/>
                    @endforeach
                </div>

                <div class="row mt-2">
                    <div class="col-lg-12 p-0">
                        @if (Auth::check())
                            <livewire:post :question="$question" :wire:key="newanswer" />
                        @else
                            <a href="#" onclick="Livewire.emit('openModal', 'login'); return false;">Login</a> or <a href="#" onclick="Livewire.emit('openModal', 'register'); return false;">create an account</a> to post an answer.
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <x-related-questions :question="$question" />
                <x-hot-questions/>
            </div>
        </div>
    </div>
</div>
@stop