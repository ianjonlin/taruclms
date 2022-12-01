<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="userProfile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">User Profile</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label">User ID</label>
                                <input type="text" name="user_id" class="form-control border border-2 p-2"
                                    value='{{ old('user_id', auth()->user()->user_id) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control border border-2 p-2"
                                    value='{{ old('email', auth()->user()->email) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control border border-2 p-2"
                                    value='{{ old('name', auth()->user()->name) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Role</label>
                                <input type="text" name="role" class="form-control border border-2 p-2"
                                    value='{{ old('role', auth()->user()->role) }}' readonly>
                            </div>

                            @if (auth()->user()->role == 'Student')
                                <div class="mb-3 col-md-12">
                                    @if (!$programme_structure_y1_s1->isEmpty())
                                        <div class="mb-3">
                                            <label class="form-label">Programme Structure</label>
                                            <div class="form-control border border-2">

                                                <div class="container p-1">
                                                    <div class="row ps-1">
                                                        <div class="col-6 col-md-4">
                                                            <b>Year 1 Semester 1</b>
                                                            <ul class="text-sm list-group pt-2">
                                                                @foreach ($programme_structure_y1_s1 as $p)
                                                                    <li class="list-group-item p-0 border-0">
                                                                        {{ $p->code }}&nbsp;{{ $p->title }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        <div class="col-6 col-md-4">
                                                            <b>Year 1 Semester 2</b>
                                                            @if (!$programme_structure_y1_s2->isEmpty())
                                                                <ul class="text-sm list-group pt-2">
                                                                    @foreach ($programme_structure_y1_s2 as $p)
                                                                        <li class="list-group-item p-0 border-0">
                                                                            {{ $p->code }}&nbsp;{{ $p->title }}
                                                                        </li>
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
                                                                            {{ $p->code }}&nbsp;{{ $p->title }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>


                                                @if (!$programme_structure_y2_s1->isEmpty())
                                                    <div class="container p-1 pt-3">
                                                        <div class="row ps-1">
                                                            <div class="col-6 col-md-4">
                                                                <b>Year 2 Semester 1</b>
                                                                <ul class="text-sm list-group pt-2">
                                                                    @foreach ($programme_structure_y2_s1 as $p)
                                                                        <li class="list-group-item p-0 border-0">
                                                                            {{ $p->code }}&nbsp;{{ $p->title }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                            <div class="col-6 col-md-4">
                                                                <b>Year 2 Semester 2</b>
                                                                @if (!$programme_structure_y2_s2->isEmpty())
                                                                    <ul class="text-sm list-group pt-2">
                                                                        @foreach ($programme_structure_y2_s2 as $p)
                                                                            <li class="list-group-item p-0 border-0">
                                                                                {{ $p->code }}&nbsp;{{ $p->title }}
                                                                            </li>
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
                                                                                {{ $p->code }}&nbsp;{{ $p->title }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!$programme_structure_y3_s1->isEmpty())
                                                    <div class="container p-1 pt-4">
                                                        <div class="row ps-1">
                                                            <div class="col-6 col-md-4">
                                                                <b>Year 3 Semester 1</b>
                                                                <ul class="text-sm list-group pt-2">
                                                                    @foreach ($programme_structure_y3_s1 as $p)
                                                                        <li class="list-group-item p-0 border-0">
                                                                            {{ $p->code }}&nbsp;{{ $p->title }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                            <div class="col-6 col-md-4">
                                                                <b>Year 3 Semester 2</b>
                                                                @if (!$programme_structure_y3_s2->isEmpty())
                                                                    <ul class="text-sm list-group pt-2">
                                                                        @foreach ($programme_structure_y3_s2 as $p)
                                                                            <li class="list-group-item p-0 border-0">
                                                                                {{ $p->code }}&nbsp;{{ $p->title }}
                                                                            </li>
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
                                                                                {{ $p->code }}&nbsp;{{ $p->title }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!$programme_structure_y4_s1->isEmpty())
                                                    <div class="container p-1 pt-4">
                                                        <div class="row ps-1">
                                                            <div class="col-6 col-md-4">
                                                                <b>Year 4 Semester 1</b>
                                                                <ul class="text-sm list-group pt-2">
                                                                    @foreach ($programme_structure_y4_s1 as $p)
                                                                        <li class="list-group-item p-0 border-0">
                                                                            {{ $p->code }}&nbsp;{{ $p->title }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                            <div class="col-6 col-md-4">
                                                                <b>Year 4 Semester 2</b>
                                                                @if (!$programme_structure_y3_s3->isEmpty())
                                                                    <ul class="text-sm list-group pt-2">
                                                                        @foreach ($programme_structure_y4_s2 as $p)
                                                                            <li class="list-group-item p-0 border-0">
                                                                                {{ $p->code }}&nbsp;{{ $p->title }}
                                                                            </li>
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
                                                                                {{ $p->code }}&nbsp;{{ $p->title }}
                                                                            </li>
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
                                </div>
                            @elseif (auth()->user()->role == 'Lecturer')
                                <div class="mb-3 col-md-12">
                                    @if (!$assigned_courses->isEmpty())
                                        <div class="mb-3">
                                            @if ($isCC)
                                                <label class="form-label">Manage Course</label>
                                            @else
                                                <label class="form-label">Assigned Courses</label>
                                            @endif
                                            <div class="form-control border border-2">
                                                <div class="container p-1">
                                                    <div class="row ps-1">
                                                        <div>
                                                            <ul class="text-sm list-group">
                                                                @if ($isCC == true)
                                                                    @foreach ($assigned_courses as $course)
                                                                        <li class="list-group-item p-0 border-0">
                                                                            {{ $course->code }}&nbsp;{{ $course->title }}
                                                                            - <b>Course Coordinator</b>
                                                                        </li>
                                                                    @endforeach
                                                                @elseif ($isCC == false)
                                                                    @foreach ($assigned_courses as $course)
                                                                        <li class="list-group-item p-0 border-0">
                                                                            {{ $course->code }}&nbsp;{{ $course->title }}
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>
