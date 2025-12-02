<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Laravel 10 App')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container p-5">
      <a class="navbar-brand" href="#">Sikambing</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/produk">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>

        </ul>
        <div class="d-flex">
          <a class="btn btn-primary me-2" href="/login" role="button">Login</a>
          <a class="btn btn-outline-primary" href="/register" role="button">Register</a>
        </div>

      </div>
    </div>
  </nav>


  @yield('content')

</body>

</html>