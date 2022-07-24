@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="col-lg-9">
        <div class="card-columns">
            @foreach ($tags as $tag)
            <div class="card tag-card m-2">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('questions.search', ['tag' => $tag->tag]) }}">{{ $tag->tag }}</a></h5>
                    <p class="card-text"><small class="text-muted">{{ count($tag->questions) }} questions</small></p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div class="mt-4 justify-content-center">
            {!! $tags->links() !!}
        </div>
    </div>
    <div class="col-lg-3">

    </div>
</div>
@stop