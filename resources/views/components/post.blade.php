<div class="card mt-2">
  <div class="card-body">
    <div class="row">
        <div class="col-lg-1">
            <h2><span class="badge bg-success">0</span></h2>
        </div>
        <div class="col-lg-11">
            <p class="card-text"><small>{{ $post->content }}</small></p>

            <div class="float-start pb-2">
              <a href="#"><small>Edit</small></a>
            </div>
            <div class="float-end col-lg-2 text-muted fs-6 lh-sm pb-2">
                <small>posted @date($post->created_at)</small><br>
                <small><a href="#">{{ $post->user->name }}</a> - 7682</small>
            </div>

            <div id="comments">
              @if ($post->comments->count() > 0)
                <div class="mt-2" style="clear: both;">
                  <hr>
                  @foreach ($post->comments as $comment)
                    <p><small>{{ $comment->content }} <span class="text-muted">&mdash; <a href="#">{{ $comment->user->name }}</a> @date($comment->date())</span></small></p>
                    <hr>
                  @endforeach
                </div>
              @endif

              <a href="#"><small>Add a comment</small></a>
            </div>
        </div>
    </div>
  </div>
</div>