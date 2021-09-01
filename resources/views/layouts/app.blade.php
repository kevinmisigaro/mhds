<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    {{ $pagecss }}
    <style>
        .btn-register-nav{
            background: blue; 
            color: white;
            padding: 10px 40px;
            font-weight: bold;
        }
        .btn-register-nav-alt{
            background: transparent; 
            color: blue;
            padding: 10px 40px;
            font-weight: bold;
            border: 1px solid blue;
        }
        .btn-register-nav-alt:hover{
            background: blue; 
            color: white;
        }
        .btn-register-nav:hover{
            color: blue;
            background: white;
            border: 1px solid blue;
        }
    </style>
    @livewireStyles
    <title>MDDS</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">MHDS</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
              </li>
              <li class="nav-item">
                <a href="/terms" class="nav-link">Terms</a>
              </li>
            </ul>
            @if (\Illuminate\Support\Facades\Auth::check())
            <a href="/dashboard/customer/home" type="button" class="btn btn-register-nav-alt">
               Dashboard
            </a>
            @else
            <a href="/register" type="button" class="btn btn-register-nav">
                Register
            </a>
            @endif
          </div>
        </div>
      </nav>
    
        {{ $slot }}

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    @livewireScripts
  </body>
</html>