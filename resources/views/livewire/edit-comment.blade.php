<div>
    @if ($showCommentEditor)
        <form wire:submit.prevent="save">
            <input type="text" class="form-control" wire:model="comment.content">
            <div class="mt-2 pb-2">
                <input type="submit" class="btn btn-primary" value="Save">
                <a class="btn btn-light" href="#" wire:click.prevent="cancelEdit"><small>Cancel</small></a>
            </div>
        </form>
    @else
        <p class="mb-0">
            <small>{{ $comment->content }} <span class="text-muted">&mdash; <a href="#">{{ $comment->user->name }}</a> @date($comment->date()) @edited($comment->isEdited())</span></small>
        </p>
        <small><a href="#" wire:click.prevent="edit">Edit</a></small>
    @endif
    <hr>
</div>