@extends('layouts.app-landing')

@section('hero')
    <div>
        <div class="mx-auto d-flex flex-lg-row flex-column hero">
            <!-- Left Column -->
            <div
                class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center">
                <h1 class="title-text-big">
                    <span id="title-hero"></span>
                </h1>
                <p class="text-caption" style="font-size: 20px">
                    <span id="deskripsi-title-hero"></span>
                </p>
                <div class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3"
                    style="margin-top: 20px">
                    @if (Auth::check())
                        @php
                            if (Auth::user()->hasRole('member')) {
                                $url = '/dashboard';
                                $text = 'Dashboard';
                            } else {
                                $url = '/admin/dashboard';
                                $text = 'Dashboard Admin';
                            }
                        @endphp
                        <a href="{{ $url }}" class="btn btn-fill text-white">{{ $text }}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-fill text-white">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-outline">
                            <div class="d-flex align-items-center">
                                <svg class="me-2" width="13" height="12" viewBox="0 0 13 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.9293 7.99988L6.66668 5.15788V10.8419L10.9293 7.99988ZM12.9173 8.27722L5.85134 12.9879C5.80115 13.0213 5.74283 13.0404 5.6826 13.0433C5.62238 13.0462 5.5625 13.0327 5.50934 13.0042C5.45619 12.9758 5.41175 12.9334 5.38075 12.8817C5.34976 12.83 5.33337 12.7708 5.33334 12.7105V3.28922C5.33337 3.22892 5.34976 3.16976 5.38075 3.11804C5.41175 3.06633 5.45619 3.02398 5.50934 2.99552C5.5625 2.96706 5.62238 2.95355 5.6826 2.95644C5.74283 2.95932 5.80115 2.97848 5.85134 3.01188L12.9173 7.72255C12.963 7.75299 13.0004 7.79423 13.0263 7.84261C13.0522 7.89099 13.0658 7.94501 13.0658 7.99988C13.0658 8.05475 13.0522 8.10878 13.0263 8.15716C13.0004 8.20553 12.963 8.24678 12.9173 8.27722Z"
                                        fill="#555B61" />
                                </svg>
                                Daftar
                            </div>
                        </a>
                    @endif
                </div>
            </div>
            <!-- Right Column -->
            <div class="right-column text-center d-flex justify-content-center pe-0">
                <img id="img-fluid" class="h-auto mw-100"
                    src="http://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header2/Header-2-1.png"
                    alt="" />
            </div>
        </div>
    </div>

    <section class="h1-00 w-100 bg-white" style="box-sizing: border-box">
        <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
            <div class="d-flex flex-lg-row flex-column align-items-center">
                <!-- Left Column -->
                <div class="img-hero text-center justify-content-center d-flex">
                    <img id="hero" class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
                        alt="" />
                </div>
                <div
                    class="right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
                    <h2 class="title-text">3 Manfaat Membaca</h2>
                    <ul style="padding: 0; margin: 0">
                        <li class="list-unstyled" style="margin-bottom: 2rem">
                            <h4
                                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-white d-flex align-items-center justify-content-center">
                                    1
                                </span>
                                Menambah Wawasan dan Pengetahuan
                            </h4>
                            <p class="text-caption">
                                Membaca buku sama halnya dengan mengisi kepala seseorang dengan<br
                                    class="d-sm-inline d-none" />
                                berbagai macam informasi baru.
                            </p>
                        </li>
                        <li class="list-unstyled" style="margin-bottom: 2rem">
                            <h4
                                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-white d-flex align-items-center justify-content-center">
                                    2
                                </span>
                                Dapat Meningkatkan Kualitas Memori
                            </h4>
                            <p class="text-caption">
                                Buku memang sangat berfungsi meningkatkan kualitas otak sehingga <br
                                    class="d-sm-inline d-none" />
                                kualitas memori terus terasah.
                            </p>
                        </li>
                        <li class="list-unstyled" style="margin-bottom: 4rem">
                            <h4
                                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <span class="circle text-white d-flex align-items-center justify-content-center">
                                    3
                                </span>
                                Melatih Keterampilan Menganalisis
                            </h4>
                            <p class="text-caption">
                                Buku membantu melatih otak untuk dapat berpikir lebih kritis<br
                                    class="d-sm-inline d-none" />
                                maupun mampu menganalisis.
                            </p>
                        </li>
                    </ul>
                    <button class="btn btn-learn text-white">Lebih Lanjut</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        new Typed('#title-hero', {
            strings: ['Hallo Selamat Datang!'],
            typeSpeed: 100,
            delaySpeed: 600,
            showCursor: false,
            loop: false
        });
        new Typed('#deskripsi-title-hero', {
            strings: ['Aplikasi Perpustakaan dengan layanan digital!',
                'Aplikasi Perpustakaan adalah sebagai sarana untuk mempermudah kampus untuk memanajemen perpustakaan dalam proses peminjaman dan pengembalian.',
                'Skuy Membaca!', 'Mari Belajar!',
                'Ayo ramaikan tagar <span class="text-dark"><b>#SuarakanKebaikanMembaca</b></span>',
                'Ayo ramaikan tagar <span class="text-dark"><b>#KampuskuMembaca</b></span>',
                'Ayo ramaikan tagar <span class="text-dark"><b>#GerakanMembaca</b></span>',
                'Ayo ramaikan tagar <span class="text-dark"><b>#AyoMembaca</b></span>',
                'Ayo ramaikan tagar <span class="text-dark"><b>#HariMembacaku</b></span>'
            ],
            typeSpeed: 50,
            delaySpeed: 600,
            loop: true
        });
    </script>
@endpush
