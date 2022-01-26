<form wire:submit.prevent="save">
  <div id="{{ $id }}" wire:ignore></div>
  <input type="hidden" wire:model="post.question_id">
  <input id="{{ $id }}-contents" type="hidden" wire:model.defer="post.content">
  @error('post.content') @errorMessage($message) @enderror
  @if ($post && !$post->question)
    <div class="mt-3">
        <label for="tags" class="form-label">Tags</label>
        <input type="text" class="form-control post-tags" id="{{ $id }}-tags" wire:model.defer="tags" aria-describedby="tagsHelp" wire:ignore>
        @error('tags') @errorMessage($message) @enderror
        <div id="tagsHelp" class="form-text">Limited to 5 tags, ENTER to confirm / add more.</div>
    </div>
    <script>
      initializeTypeAhead();
    </script>
  @endif
  <div class="float-start mt-2 pb-2">
      <input type="submit" class="btn btn-primary" onclick="window.syncEditorContents('{{ $id }}', '{{ $id }}-contents'); @if ($post && !$post->question) document.getElementById('{{ $id }}-tags').dispatchEvent(new Event('input')); @endif" value="Save">
      <a class="btn btn-light" href="{{ $fullEditorLink }}"><small>Use full editor</small></a>

      @if ($contents != '')
        <a class="btn btn-light" href="#" wire:click.prevent="cancelEdit"><small>Cancel</small></a>
      @endif
  </div>
</form>