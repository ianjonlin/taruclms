<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="programme.index"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Programme / Create Programme"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Create New Programme</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 justify-content-center">
                        @if ($errors->any())
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('programme.store') }}'>
                            @csrf
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select border border-2 p-2" name="type" required>
                                        <option disabled selected value>-- Select an option --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" class="form-control border border-2 p-2" name="code"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control border border-2 p-2" name="title"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Structure</label>
                                    <div class="container ps-1">
                                        <div class="row">
                                            @for ($col1 = 1; $col1 < 4; $col1++)
                                                <div class="col-6 col-md-4">
                                                    <b>Year 1 Sem {{ $col1 }}</b>
                                                    @for ($i1 = 1; $i1 <= 6; $i1++)
                                                        <select class="form-select border border-2 p-2 mb-2"
                                                            name="y1s{{ $col1 }}c{{ $i1 }}">
                                                            <option disabled selected value></option>
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}">
                                                                    {{ $course->code }}&nbsp;{{ $course->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endfor
                                                </div>
                                            @endfor
                                        </div>

                                        <br>

                                    </div>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <a class="btn bg-gradient-dark my-4 mb-2" href="{{ route('programme.index') }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Create
                                        Programme</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>
