@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-9">
            <h3 class="fw-normal pb-4">New Question</h3>
            @livewire('question', ['question' => $question])
        </div>
    </div>
</div>
@stop