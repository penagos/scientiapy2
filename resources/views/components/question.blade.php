<div class="card mt-2 border-0">
  <div class="card-body">
    <div class="row">
        <div class="col-lg-1">
            <h2 class="mb-0">
                <span class="badge fw-normal @if ($question->acceptedAnswer) bg-success fw-light @else bg-light text-dark @endif">{{ $question->post->reputation ?? 0 }}</span>
            </h2>

            <small>{{ $question->views }} views</small>
        </div>
        <div class="col-lg-11">
            <h6 class="card-title"><a href="{{ route('questions.view', $question->id) }} ">{{ $question->title }}</a></h6>
            <p class="card-text"><small>{{ $question->post->preview() }}</small></p>

            <div class="float-start">
                <span class="badge bg-lightblue fw-normal mr-1"><a href="#">Light</a></span>
                <span class="badge bg-lightblue fw-normal mr-1"><a href="#">Light</a></span>
                <span class="badge bg-lightblue fw-normal mr-1"><a href="#">Light</a></span>
                <span class="badge bg-lightblue fw-normal mr-1"><a href="#">Light</a></span>
            </div>

            <x-post-author :post="$question->post" />
        </div>
    </div>
  </div>
</div>