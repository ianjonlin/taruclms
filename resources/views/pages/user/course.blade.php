<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $course->code }}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Course / {{ $course->code }}"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid px-2 px-md-4">
            <div class="row ps-3 me-0">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="row">
                            <div class="bg-gradient-info shadow-dark border-radius-xl">
                                <h3 class="p-4 text-white">{{ $course->code }}&nbsp;{{ $course->title }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success') || session('error'))
                <div class="card-body">
                    @if (session('success'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ session('success') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ session('error') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <div class="row ps-1 mb-4">
                <div class="col-md-5 mb-4">
                    <div class="card shadow-dark h-100">
                        <div class="card-header pb-0 ps-3 px-3 d-flex align-items-center justify-content-between">
                            <h3 class="mb-0 ms-2">Course Details</h3>
                            @if ($isCC == true)
                                <div class="me-0">
                                    <a class="btn bg-gradient-dark mb-0"
                                        href="{{ route('editDetails', ['courseCode' => $course->code]) }}">
                                        <i class="material-icons text-sm">edit</i>&nbsp;&nbsp;Edit</a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body pt-4">
                            <p>
                                @if ($course->details == '')
                                    <i>Its Empty... Nothing to see here...</i>
                                @else
                                    {{ $course->details }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card mb-4 shadow-dark h-100">
                        <div class="card-header pb-0 px-3 d-flex align-items-center justify-content-between">
                            <h3 class="mb-0 ms-2">Course Forum</h3>
                            @if (auth()->user()->role == 'Student')
                                <div class="me-0">
                                    <a class="btn bg-gradient-dark mb-0" href="">
                                        <i class="material-icons text-sm">post_add</i>&nbsp;&nbsp;Post Question</a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body pt-4 p-3 ms-2">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="material-icons text-lg">expand_more</i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                                            <span class="text-xs">27 March 2020, at 12:30 PM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                        - $ 2,500
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="material-icons text-lg">expand_less</i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Apple</h6>
                                            <span class="text-xs">27 March 2020, at 04:30 AM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 2,000
                                    </div>
                                </li>
                            </ul>
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="material-icons text-lg">expand_less</i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                                            <span class="text-xs">26 March 2020, at 13:45 PM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 750
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button
                                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                class="material-icons text-lg">expand_less</i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                                            <span class="text-xs">26 March 2020, at 12:30 PM</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 1,000
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row px-3 mb-4">
                <div class="card shadow-dark">
                    <div class="card-header pb-0 ps-3 px-0 pb-3 d-flex align-items-center justify-content-between">
                        <h3 class="mb-0">Course Materials</h3>
                        @if ($isCC == true)
                            <div class="me-3">
                                <a class="btn bg-gradient-dark mb-0" href="{{ route('viewCMCategory', ['courseCode' => $course->code]) }}">
                                    <i class="material-icons text-sm">settings</i>&nbsp;&nbsp;Manage
                                </a>
                                &nbsp;
                                <a class="btn bg-gradient-info mb-0" href="">
                                    <i class="material-icons text-sm">upload</i>&nbsp;&nbsp;Upload
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card-body pt-4 p-3">

                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" id="nav-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 active" id="c1-tab" data-bs-toggle="tab"
                                        href="#c1" role="tab" aria-controls="c1" aria-selected="true">
                                        Lecture Slides
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" id="c2-tab" data-bs-toggle="tab"
                                        href="#c2" role="tab" aria-controls="c2" aria-selected="false">
                                        Tutorial Questions
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" id="c3-tab" data-bs-toggle="tab"
                                        href="#c3" role="tab" aria-controls="c3" aria-selected="false">
                                        Practical Questions
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="c1" role="tabpanel"
                                aria-labelledby="c1-tab">
                                <div class="table-responsive p-0 mt-3">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Information</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">Lecture Slides</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                john@creative-tim.com
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                    <p class="text-xs text-secondary mb-0">Organization</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="c2" role="tabpanel" aria-labelledby="c2-tab">
                                <div class="table-responsive p-0 mt-3">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Information</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-3.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user2">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">Tutorial Questions</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                alexa@creative-tim.com</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Programator</p>
                                                    <p class="text-xs text-secondary mb-0">Developer</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="c3" role="tabpanel" aria-labelledby="c3-tab">
                                <div class="table-responsive p-0 mt-3">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    File Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    File Information</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-4.jpg"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">Practical Questions</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                laurent@creative-tim.com</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Executive</p>
                                                    <p class="text-xs text-secondary mb-0">Projects</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
