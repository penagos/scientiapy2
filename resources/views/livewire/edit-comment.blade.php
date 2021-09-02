<div>
    <p class="mb-0">
        <small>{{ $comment->content }} <span class="text-muted">&mdash; <a href="#">{{ $comment->user->name }}</a> @date($comment->date())</span></small>
    </p>
    <small><a href="#">Edit</a></small>
    <hr>
</div>