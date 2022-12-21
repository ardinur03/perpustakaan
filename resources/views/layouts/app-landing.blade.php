<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <script src="https://ardinur.engineer/assets/js/typed.js"></script>
</head>

<body>
    <section class="h-100 w-100 bg-white" style="box-sizing: border-box">
        <div class="container-xxl mx-auto p-0  position-relative header-2-2" style="font-family: 'Poppins', sans-serif">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="#">
                    <img style="margin-right: 0.75rem" width="45px"
                        src="{{ asset('vendor/adminlte/dist/img/perpustakaan-v1.png') }}" alt="" />
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal"
                    data-bs-target="#targetModal-item">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog"
                    aria-labelledby="targetModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-white border-0">
                            <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                                <a class="modal-title" id="targetModalLabel">
                                    <img style="margin-top: 0.5rem"width="45px"
                                        src="{{ asset('vendor/adminlte/dist/img/perpustakaan-v1.png') }}"
                                        alt="" />
                                </a>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="/">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('lihat-buku') }}">Lihat Buku</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('tentang') }}">Tentang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('kontak') }}">Kontak </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer border-0 gap-3" style="padding: 2rem; padding-top: 0.75rem">
                                <button class="btn btn-default btn-no-fill">Log In</button>
                                <button class="btn btn-fill text-white">Try Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('lihat-buku') ? 'active' : '' }}"
                                href="{{ route('lihat-buku') }}">Lihat Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/tentang') ? 'active' : '' }}"
                                href="{{ route('tentang') }}">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/kontak') ? 'active' : '' }}"
                                href="{{ route('kontak') }}">Kontak</a>
                        </li>
                    </ul>

                    @if (Auth::check())
                        @php
                            if (Auth::user()->hasRole('member')) {
                                $url = '/dashboard';
                            } else {
                                $url = '/admin/dashboard';
                            }
                        @endphp
                        <div class="d-flex">
                            <a href="{{ $url }}" class="d-flex align-items-center text-decoration-none">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->username }}" alt=""
                                    width="40" height="40" class="rounded-circle">
                                <div class="ms-2">
                                    <div class="fw-bold">{{ Auth::user()->username }}</div>
                                </div>
                            </a>

                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-fill text-white ms-3">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="gap-3">
                            <a href="{{ route('login') }}"
                                class="btn btn-default btn-no-fill btn-transparent btn-rounded">
                                <i class="fas fa-sign-in-alt"></i>
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-fill text-white btn-rounded">Daftar</a>
                        </div>
                    @endif
                </div>
            </nav>

            @yield('hero')
        </div>
    </section>

    @yield('content')


    <section class="h-100 w-100 bg-white" style="box-sizing: border-box">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

            .footer-2-2 .list-space {
                margin-bottom: 1.25rem;
            }

            .footer-2-2 .footer-text-title {
                font-size: 1.5rem;
                font-weight: 600;
                color: #000000;
                margin-bottom: 1.5rem;
            }

            .footer-2-2 .list-menu {
                color: #c7c7c7;
                text-decoration: none !important;
            }

            .footer-2-2 .list-menu:hover {
                color: #555252;
            }

            .footer-2-2 hr.hr {
                margin: 0;
                border: 0;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
            }

            .footer-2-2 .border-color {
                color: #c7c7c7;
            }

            .footer-2-2 .footer-link {
                color: #c7c7c7;
            }

            .footer-2-2 .footer-link:hover {
                color: #555252;
            }

            .footer-2-2 .social-media-c:hover circle,
            .footer-2-2 .social-media-p:hover path {
                fill: #555252;
            }

            .footer-2-2 .footer-info-space {
                padding-top: 3rem;
            }

            .footer-2-2 .list-footer {
                padding: 5rem 1rem 3rem 1rem;
            }

            .footer-2-2 .info-footer {
                padding: 0 1rem 3rem;
            }

            @media (min-width: 576px) {
                .footer-2-2 .list-footer {
                    padding: 5rem 2rem 3rem 2rem;
                }

                .footer-2-2 .info-footer {
                    padding: 0 2rem 3rem;
                }
            }

            @media (min-width: 768px) {
                .footer-2-2 .list-footer {
                    padding: 5rem 4rem 6rem 4rem;
                }

                .footer-2-2 .info-footer {
                    padding: 0 4rem 3rem;
                }
            }

            @media (min-width: 992px) {
                .footer-2-2 .list-footer {
                    padding: 5rem 6rem 6rem 6rem;
                }

                .footer-2-2 .info-footer {
                    padding: 0 6rem 3rem;
                }
            }
        </style>

        <div class="footer-2-2 container-xxl mx-auto position-relative p-0"
            style="font-family: 'Poppins', sans-serif">
            <div class="list-footer">
                <div class="row gap-md-0 gap-3">
                    <div class="col-lg-3 col-md-6">
                        <div class="">
                            <div class="list-space">
                                <img width="60px" src="{{ asset('vendor/adminlte/dist/img/perpustakaan-v1.png') }}"
                                    alt="" />
                            </div>
                            <nav class="list-unstyled">
                                <li class="list-space">
                                    <a href="" class="list-menu">Beranda</a>
                                </li>
                                <li class="list-space">
                                    <a href="{{ route('lihat-buku') }}" class="list-menu">Lihat Buku</a>
                                </li>
                                <li class="list-space">
                                    <a href="{{ route('tentang') }}" class="list-menu">Tentang</a>
                                </li>
                                <li class="list-space">
                                    <a href="{{ route('kontak') }}" class="list-menu">Kontak</a>
                                </li>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

            <div class="border-color info-footer">
                <div class="">
                    <hr class="hr" />
                </div>
                <div class="mx-auto d-flex flex-column flex-lg-row align-items-center footer-info-space gap-4">
                    <div class="d-flex title-font font-medium align-items-center gap-4">
                    </div>
                    <nav class="d-flex flex-lg-row flex-column align-items-center justify-content-center">
                        <p style="margin: 0">Copyright © 2022 PerpusApp</p>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    @stack('js')
</body>

</html>
