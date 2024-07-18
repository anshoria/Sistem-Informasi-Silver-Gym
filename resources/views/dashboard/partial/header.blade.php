<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-4" href="/dashboard"><img src="/img/logo2.png" width="30"
            alt=""> Silver Gym</a>
    <button class="navbar-toggler d-md-none collapsed shadow-none border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex justify-content-end" style="padding-right: 70px" id="profil-admin">
        <li class="dropdown d-flex justify-content-center align-items-center">
            @if ($notif->count() > 0)
                <a href="#" class="nav-link position-relative" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="bi bi-bell-fill text-white"></span>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle">
                    </span>
                </a>
            @elseif ($notif->count() == 0)
                <a href="#" class="nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="bi bi-bell-fill text-white"></span>
                </a>
            @endif

            <ul class="dropdown-menu dropdown-menu-end">
                @forelse ($notif as $notification)
                    <li><a class="dropdown-item bi bi-person-fill-add" href="/dashboard/notif-member">
                            {{ $notification->data['message'] }}</a>
                    </li>
                @empty
                    <div class="text-center">
                        <span class="bi bi-x-lg"></span>
                    </div>
                @endforelse
            </ul>
        </li>

        <div class="border-start mx-3 opacity-50"></div>

        <li class="dropdown d-flex justify-content-center align-items-center" style="margin-right: 2.2rem;">
            <a href="#" class="nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="bi bi-sun-fill theme-icon-active text-white" data-theme-icon-active="bi-sun-fill"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#" data-bs-theme-value="light">
                        <span class="bi bi-sun-fill opacity-50" data-theme-icon="bi-sun-fill"></span> Light
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-theme-value="dark">
                        <span class="bi bi-moon-stars opacity-50" data-theme-icon="bi-moon-stars"></span> Dark
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-theme-value="auto">
                        <span class="bi bi-circle-half opacity-50" data-theme-icon="bi-circle-half"></span> Auto
                    </a>
                </li>
            </ul>
        </li>

        <li class="dropdown d-flex justify-content-center align-items-center">
            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                style="font-size: 1.1rem">
                <span class="text-white">
                    Welcome {{ auth()->user()->nama }}
                </span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item bi bi-person-fill" href="/dashboard/profil"> My Profile</a></li>
                <li><a class="dropdown-item bi bi-gear-fill" href="/dashboard/settings"> Settings</a></li>
                <li class="dropdown-divider"></li>
                <form action="/adminlogout" method="post">
                    @csrf
                    <li><button class="dropdown-item bi bi-box-arrow-right" type="submit"> Log out</button>
                    </li>
                </form>
            </ul>
        </li>
    </div>
</header>
