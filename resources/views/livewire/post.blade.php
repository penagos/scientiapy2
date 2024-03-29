<div id="post{{ $post->id ?? 'new' }}" class="card mt-2 border-0">
  <div class="card-body @if ($post->id) p-0 @else p-3 @endif pt-4">
    <div class="row">
      @if ($post->id)
        <div class="col-2 col-lg-1 text-center">
            @if (Auth::check())
            <h1 class="mb-0"><a href="#" class="text-lightgray" wire:click.prevent="upvote"><i class="bi bi-caret-up-fill @if ($post->upvoted()) text-primary @endif"></i></a></h1>
            @endif
            <h2 class="mb-0">
                <span class="badge fw-normal @if ($question->isAcceptedAnswer($post)) bg-success fw-light @else bg-light text-dark @endif">{{ $post->score ?? 0 }}</span>
            </h2>
            @if (Auth::check())
              <h1><a href="#" class="text-lightgray" wire:click.prevent="downvote"><i class="bi bi-caret-down-fill @if ($post->downvoted()) text-primary @endif"></i></a></h1>

              @if ($post->question_id)
                <h3 class="pb-3">
                  @if ($question->isAcceptedAnswer($post))
                    <a href="#" wire:click.prevent="unaccept"><i class="bi bi-check-lg text-success"></i></a>
                  @else
                    <a href="#" wire:click.prevent="accept"><i class="bi bi-check-lg text-lightgray"></i></a>
                  @endif
                </h3>
              @else
                <a href="#" class="text-lightgray" wire:click.prevent="favorite" title="Favorite post"><i class="bi @if ($post->favorited) bi-star-fill text-warning @else bi-star @endif"></i></a>
              @endif
            @endif 
        </div>
        <div class="col-10 col-sm-10 col-lg-11">
            @if ($showPostEditor)
              <x-inline-post-editor :post="$post" :id="$editorID" :contents="$editorContents" :full-editor-link="$editLink" />
            @else
                <div id="postContainer{{ $post->id }}" class="card-text post-content">
                  {{ Illuminate\Mail\Markdown::parse($post->content) }}
                </div>

                <div class="float-start pb-2">
                  @if ($tags)
                    <div class="pb-2">
                      @foreach ($tags as $tag)
                        @if ($tag !== '')
                          <span class="badge bg-lightblue fw-normal mr-2"><a href="{{ route('tags.search', $tag) }}">{{ $tag }}</a></span>
                        @endif
                      @endforeach
                    </div>
                  @endif
                  @if (Auth::check())
                    <a href="#" wire:click.prevent="edit" class="small"><i class="bi bi-pencil"></i> Edit</a>
                  @endif
                </div>
                <div wire:ignore>
                  <x-post-author :post="$post" />
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