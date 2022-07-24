<div class="card border-0">
    <div class="card-body">
    <form id="askQuestion" wire:submit.prevent="create">
        <div class="mb-3">
            <label for="title" class="form-label">Question Title</label><br>

            <input type="text" class="form-control" id="title" aria-describedby="titleHelp" wire:model="question.title">

            @error('question.title') @errorMessage($message) @enderror
            <div id="titleHelp" class="form-text">Limited to 255 characters.</div>
        </div>
        <div id="editor" wire:ignore></div>
        <input id="editorContents" type="hidden" wire:model.defer="post.content">
        @error('post.content') @errorMessage($message) @enderror

        <?php /* TODO: this should be single sourced with inline post editor for questions */ ?>
        <div class="mt-3">
            <div wire:ignore>
                <input type="text" data-provide="typeahead" autocomplete="off" class="form-control post-tags " id="tags" aria-describedby="tagsHelp" wire:model.defer="tags" placeholder="Tags" onchange="this.dispatchEvent(new InputEvent('input'))">
            </div>
            <div id="tagsHelp" class="form-text">Limited to 5 tags, ENTER to confirm / add more.</div>
            @error('tags') @errorMessage($message) @enderror
        </div>

        <div class="mt-3">
            <div wire:ignore>
                <input type="text" data-provide="typeahead" autocomplete="off" class="form-control post-users " id="users" aria-describedby="usersHelp" wire:model.defer="users" placeholder="Users" onchange="this.dispatchEvent(new InputEvent('input'))">
            </div>
            <div id="usersHelp" class="form-text">Email these users with new activity. ENTER to confirm / add more.</div>
            @error('users') @errorMessage($message) @enderror
        </div>

        <div class="mt-3 text-center">
        <input type="submit" value="{{ $post && ($post->id ?? null) ? 'Save' : 'Post' }}" class="btn btn-primary" onclick="window.syncEditorContents('editor', 'editorContents');">
            <a class="btn btn-light" href="{{ url()->previous() }}">Cancel</a>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                const editor = window.createToastEditor('editor', $('#editorContents').val());
            });
        </script>
    </form>
    </div>
</div>