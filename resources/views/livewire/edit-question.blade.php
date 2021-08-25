<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label for="title" class="form-label">Question Title</label>

        <input type="text" class="form-control typeahead" id="title" aria-describedby="titleHelp" wire:model.lazy="question.title">

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
            var substringMatcher = function(strs) {
                return function findMatches(q, cb) {
                    var matches, substringRegex;

                    // an array that will be populated with substring matches
                    matches = [];

                    // regex used to determine if a string contains the substring `q`
                    substrRegex = new RegExp(q, 'i');

                    // iterate through the pool of strings and for any string that
                    // contains the substring `q`, add it to the `matches` array
                    $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                    });

                    cb(matches);
                };
            };

            var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
            'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
            'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
            'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
            'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
            'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
            'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
            'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
            ];

            $('.typeahead').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                }, {
                    name: 'states',
                    source: substringMatcher(states)
                }
            );
        });
    </script>
</form>