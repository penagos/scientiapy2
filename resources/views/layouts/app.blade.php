<html>
  <head>
    <title>Scientiapy - @yield('title')</title>

    @livewireStyles
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset('css/highlight/atom-one-light.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script defer src="{{ asset('js/alpine.min.js') }}"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form method="GET" action="{{ route('questions.search') }}" class="w-100 mb-0">
            <input class="form-control me-2" type="search" placeholder="Search" name="q" value="{{ Request::input('q') ?? '' }}" aria-label="Search">
          </form>

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('questions.index') }}">Questions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('tags.index') }}">Tags</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.index') }}">Users</a>
            </li>
          </ul>

          @if (Auth::check())
            <a href="{{ route('questions.ask') }}" class="btn btn-sm btn-primary"><nobr>Ask Question</nobr></a>
            <div class="btn-group pl-4">
              <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('img/avatar-placeholder.svg') }}" width="32" height="32" class="rounded-circle d-inline mr-2" alt="{{ auth()->user()->username }}'s profile picture">
                {{ auth()->user()->username }}
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('users.view', Auth::user()->id) }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('users.favorites') }}">Favorites</a></li>
                <li><a class="dropdown-item" href="{{ route('users.teams') }}">Teams</a></li>
                <li><a class="dropdown-item" href="{{ route('users.settings') }} ">Settings</a></li>
                <li><a class="dropdown-item" href="#">Dark Mode <i class="pl-2 bi bi-moon-fill"></i></a></li>
                <li><a class="dropdown-item" href="{{ route('users.logout') }}">Logout</a></li>
              </ul>
            </div>
          @else
            <button onclick="Livewire.emit('openModal', 'login')" class="btn">Login</button>
            <button onclick="Livewire.emit('openModal', 'register')" class="btn btn-primary">Join</button>
          @endif
        </div>
      </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="mt-6 bg-light pt-4 pb-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h4 class="text-muted display-6">{{ config('app.name') }}</h4>
            <p class="text-muted">
              The open source Q&A website.
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 text-center text-muted">
            <small>&copy; @php echo date('Y', time()); @endphp <a href="https://www.github.com/penagos/" target="_blank">Luis Penagos</a>. Licensed as open source software under the <a href="https://www.github.com/penagos/scientiapy/LICENSE.md">MIT License</a>.</small>
          </div>
        </div>
      </div>
    </footer>
  </body>

  @livewire('livewire-ui-modal')
  @livewireScripts
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-tags/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('js/typeahead/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('js/highlight.min.js') }}"></script>

  <script type="text/javascript">
    Livewire.on('createEditor', (editorID, content) => {
      const editor = window.createToastEditor(editorID);
      editor.setMarkdown(content);
    });

    Livewire.on('focusInput', (editorID) => {
      document.getElementById(editorID).focus();
    });

    Livewire.on('renderPost', (postContainer) => {
      document.querySelectorAll(`#${postContainer} code`).forEach((el) => {
        hljs.highlightElement(el);
      });
    });

    Livewire.on('initializeTypeAhead', () => {
      initializeTypeAhead();
    });

    function initializeTypeAhead() {
      var questionsFetcher = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{{ route("api.questions.search", ["query" => "%QUERY"]) }}',
            wildcard: '%QUERY'
        }
      });

      $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      }, {
        name: 'questions',
        source: questionsFetcher
      });

      var tags = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '{{ route("api.tags.search", ["query" => "%QUERY"]) }}',
          wildcard: '%QUERY',
          filter: function(list) {
              
          return $.map(list, function(name) {
              return { 'name': name };
            });
          }
        }
      });
      tags.initialize();

      $('.post-tags').tagsinput({
        typeaheadjs: {
          name: 'tags',
          displayKey: 'name',
          source: tags.ttAdapter(),
        },
        tagClass: 'bg-primary p-1 mt-2 mb-2 rounded',
        cancelConfirmKeysOnEmpty: false
      });
    }

    $(document).ready(function () {
        initializeTypeAhead();
        hljs.highlightAll();

      $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      })
    });
  </script>
</html>