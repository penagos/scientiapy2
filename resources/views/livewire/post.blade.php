<div id="post{{ $post->id ?? 'new' }}" class="card mt-2 border-0">
  <div class="card-body p-0 pt-4">
    <div class="row">
      @if ($post->id)
        <div class="col-xs-2 col-lg-1 text-center">
            @if (Auth::check())
            <h1 class="mb-0"><a href="#" class="text-lightgray" wire:click.prevent="upvote"><i class="bi bi-caret-up-fill @if ($post->upvoted()) text-primary @endif"></i></a></h1>
            @endif
            <h2 class="mb-0">
                <span class="badge fw-normal @if ($question->isAcceptedAnswer($post)) bg-success fw-light @else bg-light text-dark @endif">{{ $post->score ?? 0 }}</span>
            </h2>
            @if (Auth::check())
              <h1><a href="#" class="text-lightgray" wire:click.prevent="downvote"><i class="bi bi-caret-down-fill @if ($post->downvoted()) text-primary @endif"></i></a></h1>

              @if ($post != $question->post)
                <h3 class="pb-3">
                  @if ($question->isAcceptedAnswer($post))
                    <i class="bi bi-check-lg text-success"></i>
                  @else
                    <a href="#" wire:click.prevent="accept"><i class="bi bi-check-lg text-lightgray"></i></a>
                  @endif
                </h3>
              @endif
              <a href="#" class="text-lightgray" wire:click.prevent="favorite" title="Favorite post"><i class="bi @if ($post->favorited) bi-star-fill text-warning @else bi-star @endif"></i></a>
            @endif 
        </div>
        <div class="col-xs-10 col-lg-11">
            @if ($showPostEditor)
              <x-inline-post-editor :post="$post" :id="$editorID" :contents="$editorContents" :full-editor-link="$editLink" />
            @else
                <div id="postContainer{{ $post->id }}" class="card-text">
                  {{ Illuminate\Mail\Markdown::parse($post->content) }}
                </div>

                <div class="float-start pb-2">
                  @if ($tags)
                    <div class="pb-2">
                      @foreach (explode(',', $tags) as $tag)
                        <span class="badge bg-lightblue fw-normal mr-2"><a href="#">{{ $tag }}</a></span>
                      @endforeach
                    </div>
                  @endif
                  @if (Auth::check())
                    <a href="#" wire:click.prevent="edit" class="small"><i class="bi bi-pencil"></i> Edit</a>
                  @endif
                </div>
                <div class="float-end text-muted fs-6 lh-sm bg-light rounded p-2">
                  <div class="d-flex">
                    <div>
                      <a href="#"><img src="{{ asset('img/avatar-placeholder.svg') }}" class="m-1" width="32" height="32" alt="{{ $post->user->username }}'s profile picture"></a>
                    </div>
                    <div class="ml-2">
                      <small>Posted @datetime($post->created_at) @edited($post->isEdited())</small><br>
                      <small><a href="#">{{ $post->user->username }}</a> - {{ $post->user->reputation }}</small>
                    </div>
                  </div>
                </div>
            @endif

            <div class="clearfix"></div>
            <div id="comments" class="mt-3 pl-4 pb-4">
              @if ($post->comments->count() > 0)
                <div class="mt-2" style="clear: both;">
                  <div>
                  @foreach ($post->comments as $comment)
                    <livewire:comment :comment="$comment" :key="'c'.$comment->id"/>
                  @endforeach
                  </div>
                </div>
              @endif

              <livewire:comment :postID="$post->id" :key="'newcomment'.$post->id"/>
            </div>
        </div>
      @else
        <x-inline-post-editor :post="null" :id="$editorID" contents="" full-editor-link="" />
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