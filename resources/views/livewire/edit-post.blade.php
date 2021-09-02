<div id="post{{ $post->id }}" class="card mt-2">
  <div class="card-body">
    <div class="row">
        <div class="col-xs-2 col-lg-1 text-center">
            <h1><a href="#" class="text-lightgray" wire:click.prevent="upvote"><i class="bi bi-caret-up-fill"></i></a></h1>
            <h2><span class="badge bg-success fw-light">{{ $post->reputation }}</span></h2>
            <h1><a href="#" class="text-lightgray" wire:click.prevent="downvote"><i class="bi bi-caret-down-fill"></i></a></h1>
        </div>
        <div class="col-xs-10 col-lg-11">
            @if ($showPostEditor)
                <form wire:submit.prevent="save">
                  <div id="{{ $editorID }}"></div>
                  <input id="{{ $editorContents }}" type="hidden" wire:model="post.content">
                  <div class="float-start mt-2 pb-2">
                      <input type="submit" class="btn btn-primary" onclick="window.syncEditorContents('{{ $editorID }}', '{{ $editorContents }}');" value="Save">
                      <a class="btn btn-light" href="{{ $editLink }}"><small>Use full editor</small></a>
                      <a class="btn btn-light" href="#" wire:click.prevent="cancelEdit"><small>Cancel</small></a>
                  </div>
                </form>
            @else
                <div class="card-text">
                  {{ Illuminate\Mail\Markdown::parse($post->content) }}
                </div>
                <div class="float-start pb-2">
                    <a href="#" wire:click.prevent="edit"><small>Edit</small></a>
                </div>
                <div class="float-end text-muted fs-6 lh-sm pb-2">
                    <small>posted @date($post->created_at) @edited($post->isEdited())</small><br>
                    <small><a href="#">{{ $post->user->name }}</a> - {{ $post->user->reputation }}</small>
                </div>
            @endif

            <div class="clearfix"></div>
            <div id="comments">
              @if ($post->comments->count() > 0)
                <div class="mt-2" style="clear: both;">
                  <hr>
                  <div>
                  @foreach ($post->comments as $comment)
                    <livewire:edit-comment :comment="$comment" :key="'c'.$comment->id"/>
                  @endforeach
                  </div>
                </div>
              @endif

              <livewire:edit-comment :post="$post" :key="'newcomment'.$post->id"/>
            </div>
        </div>
    </div>
  </div>
</div>