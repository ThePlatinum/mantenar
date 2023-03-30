<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Mantenar') }}</title>
  <meta name="author" content="Emmanuel Adesina">
  </meta>
  <meta name="description" content="To keep organization file share secure and unbounded">
  </meta>
  <link rel="icon" type="images/mantenar.svg" href="{{ asset('images/mantenar.svg') }}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}" />
  <link rel="apple-touch-icon" href="{{ asset('images/mantenar.svg') }}" />
  <meta name="theme-color" content="#080A41" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" defer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous" defer></script>
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
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class='bx bx-check-circle pe-1'></i>
      {{ session('status') }}
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
      <h6>Copyright &copy; Mantenar 2022 | <a class="b__p" href="https://emmanueldesina.vercel.app/" target="_blank" rel="noopener noreferrer">Platinum Innovations</a> </h6>
    </div>
  </main>

  <link href="{{ asset('util/boxicons-2.1.4/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('util/multi-select/filter_multi_select.css') }}" rel="stylesheet">
  <link href="{{ asset('util/bootstrap-5.1.3-slim/bootstrap-table.min.css') }}" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
  <script src="{{ asset('util/bootstrap-5.1.3-slim/bootstrap-table.min.js') }}"></script>
  <script src="{{ asset('util/multi-select/filter-multi-select-bundle.min.js') }}"></script>
  <script src="{{ asset('util/bootbox.min.js') }}"></script>
  <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>

  <link href="{{ asset('util/custom.css') }}" rel="stylesheet">
  <script>
    setTimeout(function() {
      $(".alert").hide('medium');
      console.clear()
    }, 3000);

    // Notification 
    window.onload =()=>{
      if (!("Notification" in window))
        alert("This browser does not support desktop notification");
      else if (Notification.permission !== "denied") {
        Notification.requestPermission().then((permission) => {
          if (permission === "granted") {}
        });
      }
    }

    Pusher.logToConsole = false;
    const pusher = new Pusher("__MANTENAR", {
      wsHost: '127.0.0.1',
      wsPort: 6001,
      wsPath: this.app.path === null ? '' : this.app.path,
      cluster: "mt1",
      forceTLS: false,
      authEndpoint: `/laravel-websockets/auth`,
      auth: {
        headers: {
          'X-CSRF-Token': "{{ csrf_token() }}",
          'X-App-ID': '__MANTENAR',
        },
      },
    });
  </script>
  @stack('scripts')
  
  <script>
    if (!navigator.serviceWorker.controller) {
      navigator.serviceWorker.register("/sw.js").then(function() {});
    }
  </script>
</body>

</html>