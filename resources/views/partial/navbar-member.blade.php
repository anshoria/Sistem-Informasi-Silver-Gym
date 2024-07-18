<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand mx-2" href="/"><img src="/img/logo2.png" alt=""></a>
        <!-- Toggler btn -->
        <button class="list navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <i class="bi bi-list fs-1"></i>
        </button>

        <!-- sidebar -->
        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">

            <!-- sidebar header -->
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><img src="/img/logo2.png" width="70"
                        alt=""></h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <!-- sidebar body -->
            <div class="offcanvas-body p-4 p-xxl-0">
                <ul class="navbar-nav justify-content-start align-items-center mx-2 fs-5 flex-grow-1">
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="/Halaman-member#hero">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/Halaman-member#personaltrainer">Personal Trainer</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/Halaman-member#tips">Tips</a>
                    </li>
                </ul>

                <!-- Login -->

                <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Welcome {{ explode(' ', auth()->user()->nama)[0] }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item bi bi-person-fill" href="/profil"> My Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <form action="/Logout" method="post">
                            @csrf
                            <li><button class="dropdown-item bi bi-box-arrow-right" type="submit"> Log out</button>
                            </li>
                        </form>
                    </ul>
                </li>

            </div>
        </div>
    </div>
</nav>
