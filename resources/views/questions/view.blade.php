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
                    <x-post :post="$question"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <h4 class="text-secondary">{{ $question->answers->count() }} answers</h4>
                    @foreach ($question->answers as $answer)
                        <x-post :post="$answer"/>
                    @endforeach
                </div>
            </div>

            <form>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="flex flex-col space-y-2">
                            <div id="editor" class="block w-full rounded-md border-gray-300 shadow-sm"><div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Post Answer">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>
@stop