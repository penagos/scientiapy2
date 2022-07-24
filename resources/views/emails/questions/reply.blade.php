A new reply was posted in "{{ $post->question->title }}" by {{ $post->user->username }} on <a href="{{ env('APP_URL') }}" target="_blank">{{ env('APP_NAME') }}</a>:

{{ Illuminate\Mail\Markdown::parse($post->content) }}

Click <a href="{{ route('questions.view', $post->question->id) }}" target="_blank">here</a> to view the reply.