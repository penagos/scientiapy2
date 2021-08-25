<html>
  <head>
    <title>Scientiapy - @yield('title')</title>

    @livewireStyles
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('questions.index') }}">Questions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tags</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Users</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
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

  @livewireScripts
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/typeahead/typeahead.bundle.min.js') }}"></script>
</html>