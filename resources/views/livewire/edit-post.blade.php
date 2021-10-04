<div id="post{{ $post->id ?? 'new' }}" class="card mt-2" style="background: #fcfcfc;">
  <div class="card-body">
    <div class="row">
      @if ($post->id)
        <div class="col-xs-2 col-lg-1 text-center">
            @if (Auth::check())
            <h1>
              @if (!$post->upvoted())  
                <a href="#" class="text-lightgray" wire:click.prevent="upvote"><i class="bi bi-caret-up-fill"></i></a>
              @else
                <i class="bi bi-caret-up-fill text-primary"></i>
              @endif
            </h1>
            @endif
            <h2>
              @if ($post->isAcceptedAnswer())  
                <span class="badge bg-success fw-light">{{ $post->score }}</span>
              @else
                {{ $post->score }}
              @endif
            </h2>
            @if (Auth::check())
            <h1>
              @if (!$post->downvoted())  
                <a href="#" class="text-lightgray" wire:click.prevent="downvote"><i class="bi bi-caret-down-fill"></i></a>
              @else
                <i class="bi bi-caret-down-fill text-primary"></i>
              @endif
            </h1>

            @if (!$post->question_id && $post->isAuthor())
            <h3 class="pb-3">
              @if ($post->isAcceptedAnswer())
                <i class="bi bi-check-lg text-success"></i>
              @else
                <a href="#" wire:click.prevent="accept"><i class="bi bi-check-lg text-lightgray"></i></a>
              @endif
            </h3>
            @endif
            <a href="#" class="text-lightgray" wire:click.prevent="favorite"><i class="bi @if ($post->favorited) bi-star-fill text-warning @else bi-star @endif"></i></a>
            @endif 
        </div>
        <div class="col-xs-10 col-lg-11">
            @if ($showPostEditor)
              <x-inline-post-editor :id="$editorID" :contents="$editorContents" :full-editor-link="$editLink" />
            @else
                <div class="card-text">
                  {{ Illuminate\Mail\Markdown::parse($post->content) }}
                </div>

                @if (Auth::check())
                <div class="float-start pb-2">
                    <a href="#" wire:click.prevent="edit" class="small"><i class="bi bi-pencil"></i> Edit</a>
                </div>
                @endif
                <div class="float-end text-muted fs-6 lh-sm bg-light rounded p-2">
                    <small>posted @date($post->created_at) @edited($post->isEdited())</small><br>
                    <small><a href="#">{{ $post->user->username }}</a> - {{ $post->user->reputation }}</small>
                </div>
            @endif

            <div class="clearfix"></div>
            <div id="comments" class="mt-3">
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

              <livewire:edit-comment :postID="$post->id" :key="'newcomment'.$post->id"/>
            </div>
        </div>
      @else
        <x-inline-post-editor :id="$editorID" contents="" full-editor-link="" />
        <script>
            $(document).ready(() => {
              // We cannot create the toast editor until a full DOM load
              Livewire.emit('createEditor', '{{ $editorID }}', '');
            });
        </script>
      @endif
    </div>
  </div>
</div>