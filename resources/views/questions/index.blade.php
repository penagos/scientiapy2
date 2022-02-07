@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-lg-9">
            <div class="d-flex justify-content-between">
                <h5 class="fw-light">{{ $questions->total() }} Questions</h5>

                <ul class="nav nav-pills bg-white border-1">
                    <li class="nav-item">
                        <small><a class="nav-link active pt-1 pb-1" href="?sort=new">Newest</a></small>
                    </li>
                    <li class="nav-item">
                        <small><a class="nav-link pt-1 pb-1" href="?sort=hot">Hot</a></small>
                    </li>
                    <li class="nav-item">
                        <small><a class="nav-link pt-1 pb-1" href="?sort=unanswered">Unanswered</a></small>
                    </li>
                </ul>
            </div>

            @foreach ($questions as $question)
                <x-question type="simple" :question="$question"/>
            @endforeach

            <div class="mt-4 justify-content-center">
                {!! $questions->appends(['q' => Request::input('q')])->links() !!}
            </div>
        </div>
        <div class="col-lg-3">
            <x-hot-questions/>
            <div class="mt-5"></div>
            <x-unanswered-questions/>
        </div>
    </div>
</div>
@stop