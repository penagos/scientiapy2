@if ($questions->count())
<div id="relatedQuestions" class="mb-5>
    <h5 class="fw-light">Related Questions</h5>

    @foreach ($questions as $question)
    <div class="d-flex pt-2">
        <div class="pr-2"><span class="badge bg-light text-dark border-1" style="width: 36px;">{{ $question->post->score }}</span></div>
        <div class="small"><a href="{{ route('questions.view', $question->id) }}">{{ $question->title }}</a></div>
    </div>
    @endforeach
</div>
@endif