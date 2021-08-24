@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-9">
            @livewire('edit-question')
        </div>
        <div class="col-lg-3 d-none d-lg-block d-xl-block">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        Valid markdown syntax is supported. For additional help, click <a href="#">here</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop