<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shopping Mart | @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .sidebar {
      background-color: #343a40;
      color: white;
      padding-top: 1rem;
      width: 200px;
      transition: transform 0.3s ease;
    }
    .main-content {
      flex: 1;
      transition: margin-left 0.3s ease;
    }
    .sidebar.hidden {
      transform: translateX(-100%);
    }
    @media (min-width: 992px) {
      .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      }
      .main-content {
        margin-left: 200px;
      }
      .sidebar.hidden + .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
  <nav class="sidebar d-lg-block d-none" id="sidebar">
    <div class="sidebar-sticky">
      <h4 class="text-white px-3">S-Mart</h4>
      <hr class="text-light">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-light" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="{{ route('products.index') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="{{ route('cart.show') }}">Cart</a>
        </li>
      </ul>
    </div>
  </nav>
  <main class="main-content">
    <header class="bg-dark py-3">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col-auto d-lg-none">
            <button class="btn btn-outline-light" id="toggle-sidebar">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
          <div class="col-auto">
            <h3 class="text-white">Shopping Mart</h3>
          </div>
        </div>
      </div>
    </header>
    <div class="container mt-4">
      @yield('content')
    </div>
    <footer class="bg-dark py-3 mt-auto">
      <div class="container text-center text-white">
        <p>© 2024 Shopping Mart. All rights reserved.</p>
        <p>Contact us at <a href="mailto:support@shoppingmart.com" class="text-white">support@shoppingmart.com</a></p>
        <p>Follow us on:
          <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
        </p>
      </div>
    </footer>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    document.getElementById('toggle-sidebar').addEventListener('click', function () {
      document.getElementById('sidebar').classList.toggle('hidden');
      document.querySelector('.main-content').classList.toggle('sidebar-hidden');
    });
  </script>
  @yield('scripts')
</body>
</html>
