A new question "{{ $question->title }}" was posted by {{ $question->post->user->username }} on <a href="{{ env('APP_URL') }}" target="_blank">{{ env('APP_NAME') }}</a>:

{{ Illuminate\Mail\Markdown::parse($question->post->content) }}

Click <a href="{{ route('questions.view', $question->id) }}" target="_blank">here</a> to view the question.