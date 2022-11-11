<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="programme.index"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Programme / View Programme / {{ $programme->code }}">
        </x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">View Programme</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 justify-content-center">
                        <div class="row justify-content-center">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control border border-2 p-2" name="type" readonly
                                    value="{{ $programme->type }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Code</label>
                                <input type="text" class="form-control border border-2 p-2" name="code" readonly
                                    value="{{ $programme->code }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control border border-2 p-2" name="title" readonly
                                    value="{{ $programme->title }}">
                            </div>

                            @if (!$programme_structure_y1_s1->isEmpty())
                                <div class="mb-3">
                                    <label class="form-label">Structure</label>
                                    <div class="form-control border border-2">

                                        <div class="container p-1">
                                            <div class="row p-1">
                                                <div class="col-6 col-md-4">
                                                    <b>Year 1 Semester 1</b>
                                                    <ul class="text-sm list-group pt-2">
                                                        @foreach ($programme_structure_y1_s1 as $p)
                                                            <li class="list-group-item p-0 border-0">
                                                                {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="col-6 col-md-4">
                                                    <b>Year 1 Semester 2</b>
                                                    @if (!$programme_structure_y1_s2->isEmpty())
                                                        <ul class="text-sm list-group pt-2">
                                                            @foreach ($programme_structure_y1_s2 as $p)
                                                                <li class="list-group-item p-0 border-0">
                                                                    {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                                <div class="col-6 col-md-4">
                                                    <b>Year 1 Semester 3</b>
                                                    @if (!$programme_structure_y1_s3->isEmpty())
                                                        <ul class="text-sm list-group pt-2">
                                                            @foreach ($programme_structure_y1_s3 as $p)
                                                                <li class="list-group-item p-0 border-0">
                                                                    {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        @if (!$programme_structure_y2_s1->isEmpty())
                                            <div class="container p-1 pt-3">
                                                <div class="row p-1">
                                                    <div class="col-6 col-md-4">
                                                        <b>Year 2 Semester 1</b>
                                                        <ul class="text-sm list-group pt-2">
                                                            @foreach ($programme_structure_y2_s1 as $p)
                                                                <li class="list-group-item p-0 border-0">
                                                                    {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <b>Year 2 Semester 2</b>
                                                        @if (!$programme_structure_y2_s2->isEmpty())
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y2_s2 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <b>Year 2 Semester 3</b>
                                                        @if (!$programme_structure_y2_s3->isEmpty())
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y2_s3 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (!$programme_structure_y3_s1->isEmpty())
                                            <div class="container p-1 pt-4">
                                                <div class="row p-1">
                                                    <div class="col-6 col-md-4">
                                                        <b>Year 3 Semester 1</b>
                                                        <ul class="text-sm list-group pt-2">
                                                            @foreach ($programme_structure_y3_s1 as $p)
                                                                <li class="list-group-item p-0 border-0">
                                                                    {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <b>Year 3 Semester 2</b>
                                                        @if (!$programme_structure_y3_s2->isEmpty())
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y3_s2 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <b>Year 3 Semester 3</b>
                                                        @if (!$programme_structure_y3_s3->isEmpty())
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y3_s3 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (!$programme_structure_y4_s1->isEmpty())
                                            <div class="container p-1 pt-4">
                                                <div class="row p-1">
                                                    <div class="col-6 col-md-4">
                                                        <b>Year 4 Semester 1</b>
                                                        <ul class="text-sm list-group pt-2">
                                                            @foreach ($programme_structure_y4_s1 as $p)
                                                                <li class="list-group-item p-0 border-0">
                                                                    {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <b>Year 4 Semester 2</b>
                                                        @if (!$programme_structure_y3_s3->isEmpty())
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y4_s2 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <b>Year 4 Semester 3</b>
                                                        @if (!$programme_structure_y3_s3->isEmpty())
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y4_s3 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-row-reverse">
                                <a class="btn bg-gradient-dark my-4 mb-2" href="{{ route('programme.index') }}"
                                    class="text-primary text-gradient font-weight-bold">Go Back</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>
