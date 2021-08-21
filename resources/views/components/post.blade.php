<div class="card mt-2">
  <div class="card-body">
    <div class="row">
        <div class="col-lg-1">
            <h2><span class="badge bg-success">0</span></h2>
        </div>
        <div class="col-lg-11">
            <p class="card-text"><small>{{ $post->content }}</small></p>

            <div class="float-end col-lg-2 text-muted fs-6 lh-sm">
                <small>posted @date($post->created_at)</small><br>
                <small><a href="#">{{ $post->user->name }}</a> - 7682</small>
            </div>
        </div>
    </div>

    @if ($post->comments->count() > 0)
      @foreach ($post->comments as $comment)
        comment here!
      @endforeach
    @endif
  </div>
</div>