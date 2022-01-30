@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-9">
            @livewire('edit-question', ['question' => $question])
        </div>
    </div>
</div>
@stop