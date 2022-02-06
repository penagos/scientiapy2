<div class="float-end text-muted fs-6 lh-sm bg-light rounded p-2">
    <div class="d-flex">
    <div>
        <a href="#"><img src="{{ asset('img/avatar-placeholder.svg') }}" class="m-1" width="32" height="32" alt="{{ $post->user->username }}'s profile picture"></a>
    </div>
    <div class="ml-2">
        <small>Posted @datetime($post->created_at) @edited($post->isEdited())</small><br>
        <small><a href="{{ route('users.view', $post->user->id) }}">{{ $post->user->username }}</a> - {{ $post->user->reputation }}</small>
    </div>
    </div>
</div>