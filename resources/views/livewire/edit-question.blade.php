<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label for="title" class="form-label">Question Title</label>

        <input type="text" class="form-control typeahead" id="title" aria-describedby="titleHelp"  wire:ignore>

        @error('question.title') <div>{{ $message }}</div> @enderror
        <div id="titleHelp" class="form-text">Limited to 255 characters.</div>
    </div>
    <div wire:ignore id="editor"></div>
    @error('question.post.content') <span class="error">{{ $message }}</span> @enderror

    <div class="mt-3">
        <label for="tags" class="form-label">Tags</label>
        <input type="email" class="form-control" id="tags" aria-describedby="tagsHelp">
        <div id="tagsHelp" class="form-text">Limited to 5 tags, ENTER or TAB to add more.</div>
    </div>

    <div class="mt-3 text-center">
        <input type="submit" value="Post" class="btn btn-primary">
    </div>

    <script type="text/javascript">
        $(document).ready(function () {


            //window.livewire.on('hydateTypeahead', () => setupTypeahead());
        });
    </script>
</form>