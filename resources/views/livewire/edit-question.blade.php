<form id="askQuestion" wire:submit.prevent="submit">
    <div class="mb-3">
        <label for="title" class="form-label">Question Title</label>

        <input type="text" class="form-control typeahead" id="title" aria-describedby="titleHelp" wire:model.defer="question.title" wire:ignore>

        @error('question.title') <div>{{ $message }}</div> @enderror
        <div id="titleHelp" class="form-text">Limited to 255 characters.</div>
    </div>
    <div id="editor"></div>
    <input id="editorContents" type="hidden" value="{{ $question->post ?? '' }}">
    @error('post.content') <span class="error">{{ $message }}</span> @enderror

    <div class="mt-3">
        <label for="tags" class="form-label">Tags</label>
        <input type="text" class="form-control post-tags" id="tags" aria-describedby="tagsHelp" wire:model.defer="question.tags" wire:ignore>
        <div id="tagsHelp" class="form-text">Limited to 5 tags, ENTER to confirm / add more.</div>
    </div>

    <div class="mt-3 text-center">
        <input type="submit" value="Post" class="btn btn-primary" onclick="window.syncEditorContents('editor', 'editorContents');">
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            console.log($('#editorContents').val());
            const editor = window.createToastEditor('editor', $('#editorContents').val());
        });
    </script>
</form>