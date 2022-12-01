<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="course.index"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Course / Edit Course / {{ $course->code }}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Edit Course</h4>
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
                        <form method='POST' action='{{ route('course.update', ['course' => $course]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" class="form-control border border-2 p-2" name="code"
                                        required maxlength="8" value="{{ $course->code }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control border border-2 p-2" name="title"
                                        required maxlength="48" value="{{ $course->title }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Course Coordinator</label>
                                    <select class="form-select border border-2 p-2" name="cc_id" required>
                                        {{-- Get all CCs --}}
                                        @foreach ($courses as $c)
                                            @if ($c->cc_id != null)
                                                {{ $cc_ids[] = $c->cc_id }}
                                            @endif
                                        @endforeach

                                        {{-- Get existing CC --}}
                                        @foreach ($users as $user)
                                            @if ($user->id == $course->cc_id)
                                                <option value="{{ $user->id }}" selected>
                                                    {{ $user->user_id }}&nbsp;{{ $user->name }}
                                                </option>
                                            @elseif($course->cc_id == null)
                                                <option disabled selected value>-- select an option --</option>
                                            @break
                                        @endif
                                    @endforeach

                                    {{-- Check if lecturer is not a CC of any course --}}
                                    @foreach ($users as $user)
                                        @if ($user->id != $course->cc_id && !in_array($user->id, $cc_ids))
                                            <option value="{{ $user->id }}">
                                                {{ $user->user_id }}&nbsp;{{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <a class="btn bg-gradient-dark my-4 mb-2" href="{{ route('course.index') }}"
                                    class="text-primary text-gradient font-weight-bold">Go Back</a>
                                <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Update
                                    Course</button>
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
