<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $course->code }}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Course / {{ $course->code }}"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <h3 class="p-4">{{ $course->code }}&nbsp;{{ $course->title }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
