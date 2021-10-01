<div>
    @if ($edit)
        <form wire:submit.prevent="save">
            <input type="hidden" wire:model="comment.post_id">
            <input type="text" id="{{ $this->editorID }}" class="form-control" wire:model="comment.content">
            @error('comment.content') <div class="mt-2 text-danger error small">{{ $message }}</div>@enderror
            <div class="mt-2 pb-2">
                <input type="submit" class="btn btn-primary" value="Save">
                <a class="btn btn-light" href="#" wire:click.prevent="cancelEdit"><small>Cancel</small></a>
            </div>
        </form>
    @elseif ($comment && $comment->id)
        <p class="mb-0">
            <small>{{ $comment->content }} <span class="text-muted">&mdash; <a href="#">{{ $comment->user->name }}</a> @date($comment->date()) @edited($comment->isEdited())</span></small>
        </p>

        @if (Auth::check())
        <small><a href="#" wire:click.prevent="edit">Edit</a></small>
        @endif
    @elseif (!$edit)
        @if (Auth::check())
            <a a href="#" wire:click.prevent="comment({{ $post->id }})"><small>Add a comment</small></a>
        @else
            <a a href="#" onclick="Livewire.emit('openModal', 'login'); return false;"><small>Add a comment</small></a>
        @endif
    @endif
    <hr>
</div>