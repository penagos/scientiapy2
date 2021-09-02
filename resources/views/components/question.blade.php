<div class="card mt-2">
  <div class="card-body">
    <div class="row">
        <div class="col-lg-1">
            <h2><span class="badge bg-success">{{ $question->post->reputation }}</span></h2>
            <small>{{ $question->views }} views</small>
        </div>
        <div class="col-lg-11">
            <h6 class="card-title"><a href="{{ route('questions.view', $question->id) }} ">{{ $question->title }}</a></h6>
            <p class="card-text"><small>{{ $question->post->preview() }}</small></p>

            <div class="float-start">
                <span class="badge bg-lightblue fw-normal mr-2"><a href="#">Light</a></span>
                <span class="badge bg-lightblue fw-normal mr-2"><a href="#">Light</a></span>
                <span class="badge bg-lightblue fw-normal mr-2"><a href="#">Light</a></span>
                <span class="badge bg-lightblue fw-normal mr-2"><a href="#">Light</a></span>
            </div>

            <div class="float-end col-lg-2 text-muted fs-6 lh-sm">
                <small>posted @date($question->post->created_at)</small><br>
                <small><a href="#">{{ $question->post->user->name }}</a> - 7682</small>
            </div>
        </div>
    </div>
  </div>
</div>