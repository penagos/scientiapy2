<div>
    @if ($edit)
        <hr class="bg-secondary">
        <form wire:submit.prevent="save">
            <input type="hidden" wire:model="comment.post_id">
            <textarea id="{{ $this->editorID }}" class="form-control @error('comment.content') is-invalid @endif" wire:model="comment.content" rows="5"></textarea>
            @error('comment.content') @errorMessage($message) @enderror
            <div class="mt-2 pb-2">
                <input type="submit" class="btn btn-primary" value="Save">
                <a class="btn btn-light" href="#" wire:click.prevent="cancelEdit"><small>Cancel</small></a>
            </div>
        </form>
    @elseif ($comment && $comment->id)
        <hr class="bg-secondary">
        <p class="mb-0 small">
            {{ $comment->content }}
        <p>
        <div class="d-flex justify-content-between">
            <div class="small text-muted">Posted @datetime($comment->date()) by <a href="#">{{ $comment->user->username }}</a> @edited($comment->isEdited())</div>
            
            @if (Auth::check())
            <div class="small"><a href="#" wire:click.prevent="edit"><i class="bi bi-pencil"></i> Edit</a></div>
            @endif
        </div>
    @elseif (!$edit)
        <br>
        @if (Auth::check())
            <a a href="#" wire:click.prevent="comment"><small>Add a comment</small></a>
        @else
            <a a href="#" onclick="Livewire.emit('openModal', 'login'); return false;"><small>Add a comment</small></a>
        @endif
    @endif
</div>