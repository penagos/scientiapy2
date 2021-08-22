@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <form>
                <div class="mb-3">
                    <label for="title" class="form-label">Question Title</label>
                    <input type="email" class="form-control" id="title" aria-describedby="titleHelp">
                    <div id="titleHelp" class="form-text">Limited to 255 characters.</div>
                </div>
                <div id="editor"></div>

                <div class="mt-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="email" class="form-control" id="tags" aria-describedby="tagsHelp">
                    <div id="tagsHelp" class="form-text">Limited to 5 tags, ENTER or TAB to add more.</div>
                </div>
            </form>
        </div>
        <div class="col-lg-3">
            right
        </div>
    </div>
</div>
@stop