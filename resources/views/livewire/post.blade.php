<div class="card mt-2">
  <div class="card-body">
    <div class="row">
        <div class="col-lg-1 text-center">
            <h1><a href="#" class="text-muted"><i class="bi bi-caret-up-fill"></i></a></h1>
            <h2><span class="badge bg-success">0</span></h2>
            <h1><a href="#" class="text-muted"><i class="bi bi-caret-down-fill"></i></a></h1>
        </div>
        <div class="col-lg-11">
            @if ($showPostEditor)
                <div id="{{ $editorID }}"></div>
                <div class="float-start pb-2">
                    <a href="{{ $editLink }}"><small>Use full editor</small></a>
                    <a href="#" wire:click.prevent="cancelEdit"><small>Cancel</small></a>
                </div>
                
            @else
                <p class="card-text"><small>{{ $post->content }}</small></p>
                <div class="float-start pb-2">
                    <a href="#" wire:click.prevent="edit"><small>Edit</small></a>
                </div>
            @endif

            <div class="float-end col-lg-2 text-muted fs-6 lh-sm pb-2">
                <small>posted @date($post->created_at)</small><br>
                <small><a href="#">{{ $post->user->name }}</a> - 7682</small>
            </div>
            <div class="clearfix"></div>
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

              @if ($showCommentPoster)
                <form>
                    <input type="text" class="form-control">
                </form>
              @else
                <a a href="#" wire:click.prevent="comment"><small>Add a comment</small></a>
              @endif
            </div>
        </div>
    </div>
  </div>
</div>