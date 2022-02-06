<div class="card border-0">
    <div class="card-body">
    <form id="askQuestion" wire:submit.prevent="create">
        <div class="mb-3">
            <label for="title" class="form-label">Question Title</label><br>

            <input type="text" class="form-control" id="title" aria-describedby="titleHelp" wire:model.defer="question.title" wire:ignore>

            @error('question.title') @errorMessage($message) @enderror
            <div id="titleHelp" class="form-text">Limited to 255 characters.</div>
        </div>
        <div id="editor" wire:ignore></div>
        <input id="editorContents" type="hidden" wire:model.defer="post.content">
        @error('post.content') @errorMessage($message) @enderror

        <div class="mt-3">
            <input type="text" class="form-control post-tags" id="tags" aria-describedby="tagsHelp" wire:model.defer="question.tags" placeholder="Tags" wire:ignore>
            <div id="tagsHelp" class="form-text">Limited to 5 tags, ENTER to confirm / add more.</div>
        </div>

        <div class="mt-3 text-center">
            <input type="submit" value="Post" class="btn btn-primary" onclick="window.syncEditorContents('editor', 'editorContents');">
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                const editor = window.createToastEditor('editor', $('#editorContents').val());
            });
        </script>
    </form>
    </div>
</div>