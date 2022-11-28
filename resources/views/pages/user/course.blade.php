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
                    <div class="card shadow-dark">
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
                            <p style="white-space: pre-line; height: 320px; overflow-y: scroll;">
                                @if ($course->details == '')
                                    <i>No information is available.</i>
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
                            <h3 class="mb-0 ms-2">Course Forum (TO-DO)</h3>
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
                        <h3 class="mb-0">Learning Materials</h3>
                        @if ($isCC == true)
                            <div class="me-3">
                                <a class="btn bg-gradient-dark mb-0"
                                    href="{{ route('viewLMCategory', ['courseCode' => $course->code]) }}">
                                    <i class="material-icons text-sm">settings</i>&nbsp;&nbsp;Manage
                                </a>
                                &nbsp;
                                <a class="btn bg-gradient-primary mb-0"
                                    href="{{ route('createLearningMaterial', ['courseCode' => $course->code]) }}">
                                    <i class="material-icons text-sm">upload</i>&nbsp;&nbsp;Upload
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card-body pt-4 p-3">

                        @if ($lMCategories->isEmpty())
                            <p class="text-center">No Learning Material Category have been created yet.</p>
                        @else
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    @php($lmcCount = 0)
                                    @php($lmcCategory = [])
                                    @foreach ($lMCategories as $category)
                                        @php($lmcCount++)
                                        @php(array_push($lmcCategory, $category->id))
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link mb-0 px-0 py-1 {{ $lmcCount == 1 ? ' active' : '' }}"
                                                id="lm-pills-{{ $lmcCount }}-tab" data-bs-toggle="tab"
                                                href="#lm-pills-{{ $lmcCount }}" role="tab"
                                                aria-controls="lm-pills-{{ $lmcCount }}" aria-selected="true">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="tab-content">
                                @for ($i = 1; $i <= $lmcCount; $i++)
                                    <div class="tab-pane fade {{ $i == 1 ? ' show active' : '' }}"
                                        id="lm-pills-{{ $i }}" role="tabpanel"
                                        aria-labelledby="lm-pills-{{ $i }}-tab">

                                        <div class="table-responsive p-0 mt-3" style="max-height: 300px;">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Name</th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            File Information / URL</th>
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($lmNum = 0)
                                                    @foreach ($learningMaterials as $material)
                                                        @if ($material->category == $lmcCategory[$i - 1])
                                                            <tr>
                                                                <td class="align-middle">
                                                                    <h6 class="text-md text-secondary mb-0">
                                                                        {{ $material->name }}
                                                                    </h6>
                                                                </td>
                                                                <td class="align-middle">
                                                                    @if ($material->type == 'url')
                                                                        <p class="text-sm text-secondary mb-0">
                                                                            <u>
                                                                                <a
                                                                                    href="{{ $material->path }}">{{ $material->path }}</a>
                                                                            </u>
                                                                        </p>
                                                                    @else
                                                                        <p class="text-sm text-secondary mb-0">
                                                                            .{{ $material->ext }}
                                                                            -
                                                                            {{ round((int) Storage::size($material->path) / 100000, 2) }}
                                                                            mb
                                                                        </p>
                                                                    @endif
                                                                </td>
                                                                @if ($material->type == 'file')
                                                                    <td class="align-middle text-center"
                                                                        style="z-index: 3">
                                                                        <a rel="tooltip"
                                                                            class="btn btn-info btn-link"
                                                                            href=" {{ route('downloadLearningMaterial', ['courseCode' => $course->code, 'id' => $material->id]) }}"
                                                                            data-original-title="" title="">
                                                                            <i class="material-icons">download</i>
                                                                            <div class="ripple-container">
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                            @php($lmNum++)
                                                        @endif
                                                    @endforeach

                                                    @if ($lmNum == 0)
                                                        <tr>
                                                            <td colspan="3" class="text-center">No uploaded
                                                                learning materials under this
                                                                category!</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if (auth()->user()->role != 'Student')
                <div class="row px-3 mb-4">
                    <div class="card shadow-dark">
                        <div class="card-header pb-0 ps-3 px-0 pb-3 d-flex align-items-center justify-content-between">
                            <h3 class="mb-0">Course Materials</h3>
                            @if ($isCC == true)
                                <div class="me-3">
                                    <a class="btn bg-gradient-dark mb-0"
                                        href="{{ route('viewCMCategory', ['courseCode' => $course->code]) }}">
                                        <i class="material-icons text-sm">settings</i>&nbsp;&nbsp;Manage
                                    </a>
                                    &nbsp;
                                    <a class="btn bg-gradient-primary mb-0"
                                        href="{{ route('createCourseMaterial', ['courseCode' => $course->code]) }}">
                                        <i class="material-icons text-sm">upload</i>&nbsp;&nbsp;Upload
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="card-body pt-4 p-3">

                            @if ($cMCategories->isEmpty())
                                <p class="text-center">No Course Material Category have been created yet.</p>
                            @else
                                <div class="nav-wrapper position-relative end-0">
                                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                        @php($cmcCount = 0)
                                        @php($cmcCategory = [])
                                        @foreach ($cMCategories as $category)
                                            @php($cmcCount++)
                                            @php(array_push($cmcCategory, $category->id))
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link mb-0 px-0 py-1 {{ $cmcCount == 1 ? ' active' : '' }}"
                                                    id="cm-pills-{{ $cmcCount }}-tab" data-bs-toggle="tab"
                                                    href="#cm-pills-{{ $cmcCount }}" role="tab"
                                                    aria-controls="cm-pills-{{ $cmcCount }}"
                                                    aria-selected="true">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    @for ($j = 1; $j <= $cmcCount; $j++)
                                        <div class="tab-pane fade {{ $j == 1 ? ' show active' : '' }}"
                                            id="cm-pills-{{ $j }}" role="tabpanel"
                                            aria-labelledby="cm-pills-{{ $j }}-tab">

                                            <div class="table-responsive p-0 mt-3" style="max-height: 300px;">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Name</th>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                File Information / URL</th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php($lmNum = 0)
                                                        @foreach ($courseMaterials as $material)
                                                            @if ($material->category == $cmcCategory[$j - 1])
                                                                <tr>
                                                                    <td class="align-middle">
                                                                        <h6 class="text-md text-secondary mb-0">
                                                                            {{ $material->name }}
                                                                        </h6>
                                                                    </td>
                                                                    <td class="align-middle">
                                                                        @if ($material->type == 'url')
                                                                            <p class="text-sm text-secondary mb-0">
                                                                                <u>
                                                                                    <a
                                                                                        href="{{ $material->path }}">{{ $material->path }}</a>
                                                                                </u>
                                                                            </p>
                                                                        @else
                                                                            <p class="text-sm text-secondary mb-0">
                                                                                .{{ $material->ext }}
                                                                                -
                                                                                {{ round((int) Storage::size($material->path) / 100000, 2) }}
                                                                                mb
                                                                            </p>
                                                                        @endif
                                                                    </td>
                                                                    @if ($material->type == 'file')
                                                                        <td class="align-middle text-center"
                                                                            style="z-index: 3">
                                                                            <a rel="tooltip"
                                                                                class="btn btn-info btn-link"
                                                                                href=" {{ route('downloadCourseMaterial', ['courseCode' => $course->code, 'id' => $material->id]) }}"
                                                                                data-original-title="" title="">
                                                                                <i class="material-icons">download</i>
                                                                                <div class="ripple-container">
                                                                                </div>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                @php($lmNum++)
                                                            @endif
                                                        @endforeach

                                                        @if ($lmNum == 0)
                                                            <tr>
                                                                <td colspan="3" class="text-center">No uploaded
                                                                    course materials under this
                                                                    category!</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
