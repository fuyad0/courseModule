<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/logo-softvence.png') }}" type="image/x-icon">
    <title>Title</title>
     <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container-fluid bg-white">
      <div class="row header">
        <div class="menu bg-light shadow-sm col-2">
          <div class="nav-head my-4">
            <img src="{{ asset('images/logo-softvence.png') }}" alt="" />
          </div>
          <nav>
            <ul class="list-unstyled">
              <li>
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-user-tie"></i> Customer</a>
              </li>
              <li>
                <a href="/course/view" class="{{ request()->is('course*') ? 'active' : '' }}"><i class="fa-solid fa-list"></i> Course</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-pen-nib"></i> Module</a>
              </li>
              <li>
                <a href="#"
                  ><i class="fa-solid fa-right-from-bracket"></i> Logout</a
                >
              </li>
            </ul>
          </nav>
        </div>
        <div class="main-body col-10 px-2">
          <div class="head bg-light shadow-sm p-2">
            <i class="fa-solid fa-bars p-2 pointer"></i>

            <div class="position-relative d-inline-block float-end">
                <i class="fa-solid fa-user fs-5 pointer" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"></i>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
          </div>
          <main class="bg-white mt-3 shadow p-4">
           @yield('body-section')
          </main>
        </div>
      </div>
      <footer class="text-center shadow-lg mt-2">
        <p class="p-1 mb-1">&copy; 2025 Softvance Agency. Developed By- <span class="text-success font-bold">Mahbube Anam Fuyad.</span> </p>
      </footer>
    </div>

  <script
        src="https://cdn.tiny.cloud/1/wy48dyzr279ev6tzvt7o72mhkjs7su3tmusxyqh7tbs0at5u/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"
      ></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    @yield('script')
  </body>
</html>