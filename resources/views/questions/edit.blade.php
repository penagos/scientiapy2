@extends('layouts.app')
@section('title', $question->id ? 'Edit Question' : 'Ask a New Question')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-9">
            <h3 class="fw-normal pb-4">{{ $question->id ? 'Edit' : 'New' }} Question</h3>
            @livewire('question', ['question' => $question])
        </div>
        <div class="col-lg-3">
            <div class="card border-0">
                <div class="card-body">
                    <p>
                        The editor supports any valid Markdown syntax. For examples, see <a href="https://www.markdownguide.org/basic-syntax/" target="_blank">this webpage</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop