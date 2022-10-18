<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="icon" type="images/mantenar.svg" href="{{ asset('images/mantenar.svg') }}">
</head>

<body>

  <main class="py-4 container">
    @yield('content')

    <div class="text-center py-4">
      <hr>
      <h6>Copyright &copy; Mantenar 2022 | <a class="b__p" href="https://emmannueldesina.vercel.app/" target="_blank" rel="noopener noreferrer">Platinum Innovations</a> </h6>
    </div>
  </main>

  <link href="{{ asset('util/bootstrap-5.1.3-slim/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('util/boxicons-2.1.4/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('util/custom.css') }}" rel="stylesheet">
</body>

</html>