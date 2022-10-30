<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Mantenar') }}</title>
  <link rel="icon" type="images/mantenar.svg" href="{{ asset('images/mantenar.svg') }}">
</head>

<body>

  <main class="py-4 container">

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class='bx bx-check-circle pe-1'></i>
      {{ session()->get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class='bx bx-error-circle pe-1'></i>
      {{ session()->get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @yield('content')

    <div class="text-center py-4">
      <hr>
      <h6>Copyright &copy; Mantenar 2022 | <a class="b__p" href="https://emmannueldesina.vercel.app/" target="_blank" rel="noopener noreferrer">Platinum Innovations</a> </h6>
    </div>
  </main>

  <link href="{{ asset('util/boxicons-2.1.4/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('util/multi-select/filter_multi_select.css') }}" rel="stylesheet">
  <link href="{{ asset('util/bootstrap-5.1.3-slim/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('util/bootstrap-5.1.3-slim/bootstrap-table.min.css') }}" rel="stylesheet">

  <script src="{{ asset('util/bootstrap-5.1.3-slim/bootstrap.min.js') }}"></script>
  <script src="{{ asset('util/jquery-3.6.0.js') }}"></script>
  <script src="{{ asset('util/bootstrap-5.1.3-slim/bootstrap-table.min.js') }}"></script>
  <script src="{{ asset('util/multi-select/filter-multi-select-bundle.min.js') }}"></script>
  <script src="{{ asset('util/bootbox.min.js') }}"></script>

  <link href="{{ asset('util/custom.css') }}" rel="stylesheet">
  <script>
    setTimeout(function() {
      $(".alert").hide('medium');
    }, 3000);
  </script>
  @stack('scripts')
</body>

</html>