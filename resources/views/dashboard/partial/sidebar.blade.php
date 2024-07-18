<nav id="sidebarMenu" class="col-md-3 col-lg-3 col-xxl-2 d-md-block bg-dark sidebar collapse">
    <div class="nav-position position-sticky pt-4 px-3">
        <ul class="nav flex-column">
            <li class="nav-item" id="sub-judul">
                <div class="row">
                    <div class="col-12 col-md-auto d-flex align-items-center gap-2" style="margin-left: 20px">
                        @if (auth()->user()->gambar)
                            <img src="{{ asset('storage/' . auth()->user()->gambar) }}" alt="" class="img-fluid"
                                style="height:70px; width:70px;overflow:hidden;object-fit:cover;border-radius:50%;">
                        @else
                            <img src="/img/profile.png" alt="" class="img-fluid"
                                style="height:70px; width:70px;overflow:hidden;object-fit:cover;border-radius:50%;">
                        @endif
                        <p class="text-light mt-3">{{ auth()->user()->nama }}</p>
                    </div>
                </div>
            </li>
            <hr class="text-light">
            <div class="row">
                <div class="custom-col">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} rounded" aria-current="page"
                            href="/dashboard">
                            <i class="bi bi-house-door"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/member*') ? 'active' : '' }} rounded"
                            href="/dashboard/member">
                            <i class="bi bi-file-person"></i>
                            Member
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/personal_trainer*') ? 'active' : '' }} rounded"
                            href="/dashboard/personal_trainer">
                            <i class="bi bi-people"></i>
                            Personal Trainer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/presensi*') ? 'active' : '' }} rounded"
                            href="/dashboard/presensi">
                            <i class="bi bi-card-checklist"></i>
                            Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/transaksi*') ? 'active' : '' }} rounded"
                            href="/dashboard/transaksi">
                            <i class="bi bi-wallet2"></i>
                            Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/admin*') ? 'active' : '' }} rounded"
                            href="/dashboard/admin">
                            <i class="bi bi-person-gear"></i>
                            Admin
                        </a>
                    </li>
                </div>

                <div class="custom-col">
                    {{-- laporan --}}
                    <h5
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
                        <span>Laporan</span>
                    </h5>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/laporan-transaksi*') ? 'active' : '' }} rounded"
                            href="/dashboard/laporan-transaksi">
                            <i class="bi bi-journal-text"></i>
                            Laporan Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/laporan-member*') ? 'active' : '' }} rounded"
                            href="/dashboard/laporan-member">
                            <i class="bi bi-journal-text"></i>
                            Laporan Member
                        </a>
                    </li>


                    {{-- notifikasi --}}
                    <h5
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
                        <span>Notifikasi</span>
                    </h5>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/notif-member*') ? 'active' : '' }} rounded"
                            href="/dashboard/notif-member">
                            <i class="bi bi-person-fill-add"></i>
                            Notifikasi Member Baru
                        </a>
                    </li>
                </div>
            </div>
            <div class="d-flex justify-content-center" id="profil-admin-2">
                <hr class="text-light">
                <li class="dropdown d-flex justify-content-center align-items-center">
                    <a class="fs-5 text-white text-decoration-none border-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome {{ auth()->user()->nama }}
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
                <hr class="text-light">
                <li class="dropup d-flex justify-content-center align-items-center">
                    @if ($notif->count() > 0)
                        <a href="#" class="nav-link position-relative" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="bi bi-bell-fill text-white"></span>
                            <span
                                class="position-absolute top-20 start-70 translate-middle p-1 bg-danger rounded-circle">
                            </span>
                        </a>
                    @elseif ($notif->count() == 0)
                        <a href="#" class="nav-link" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="bi bi-bell-fill text-white"></span>
                        </a>
                    @endif

                    <ul class="dropdown-menu">
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
                    <a href="#" class="nav-link" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="bi bi-sun-fill theme-icon-active text-white"
                            data-theme-icon-active="bi-sun-fill"></span>
                    </a>
                    <ul class="dropdown-menu">
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
                                <span class="bi bi-circle-half opacity-50" data-theme-icon="bi-circle-half"></span>
                                Auto
                            </a>
                        </li>
                    </ul>
                </li>
            </div>
        </ul>
    </div>
</nav>
