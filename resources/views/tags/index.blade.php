@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-9">
        @foreach ($tags as $tag)
            <x-tag :tag="$tag"/>
        @endforeach
    </div>
    <div class="col-lg-3">

    </div>
</div>
@stop