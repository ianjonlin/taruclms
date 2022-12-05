<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="course.index"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Course / {{ $course->code }} / Assigned Lecturers"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <h3 class="p-4">Assigned Lecturers</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-2">
                            @if (session('success') || session('error'))
                                <div class="card-body py-0">
                                    @if (session('success'))
                                        <div class="row m-0">
                                            <div class="alert alert-success alert-dismissible text-white"
                                                role="alert">
                                                <span class="text-sm">{{ session('success') }}</span>
                                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                    data-bs-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="row m-0">
                                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                                <span class="text-sm">{{ session('error') }}</span>
                                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                    data-bs-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="container mb-2">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="mb-4 border border-black border-2 rounded mx-2 p-3">
                                            <form method='POST' action='{{ route('addLecturer') }}'>
                                                @csrf
                                                <div>
                                                    <label class="form-label font-weight-bold">Add Lecturer</label>
                                                    <select class="form-select border border-2 p-2" name="lecturer_id"
                                                        required>
                                                        <option disabled selected value>-- select an option --</option>

                                                        @if ($assigned_lecturers->isNotEmpty())
                                                            @foreach ($assigned_lecturers as $assigned_lecturer)
                                                                {{ $al_ids[] = $assigned_lecturer->id }}
                                                            @endforeach

                                                            @foreach ($lecturers as $lecturer)
                                                                @if ($lecturer->id != $course->cc_id)
                                                                    @if (!in_array($lecturer->id, $al_ids))
                                                                        <option value="{{ $lecturer->id }}">
                                                                            {{ $lecturer->user_id }}&nbsp;{{ $lecturer->name }}
                                                                        </option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @foreach ($lecturers as $lecturer)
                                                                @if ($lecturer->id != $course->cc_id)
                                                                    <option value="{{ $lecturer->id }}">
                                                                        {{ $lecturer->user_id }}&nbsp;{{ $lecturer->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2">Add
                                                        Lecturer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="border border-black border-2 rounded p-3">
                                            <form method='get'
                                                action='{{ route('course.show', ['course' => $course]) }}'>
                                                <div class="row justify-content-center">
                                                    <div>
                                                        <label class="form-label font-weight-bold">
                                                            Search by Lecturer ID or Name</label>
                                                        <input type="text" class="form-control border border-2 ps-2"
                                                            id="keyword" name="keyword"
                                                            value="{{ $search_keyword }}">
                                                    </div>

                                                    <div class="text-end">
                                                        <button class="btn bg-gradient-secondary my-4 mb-2 me-2"
                                                            onclick="resetSearch()">Reset</button>
                                                        <button type="submit"
                                                            class="btn bg-gradient-primary my-4 mb-2">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="px-4 fw-normal text-end mb-3">
                                Total records - <b><u>{{ $assigned_lecturers->count() }}</u></b> lecturer(s)
                                assigned
                            </p>

                            <div class="table-responsive p-0 ms-3" style="max-height: 80vh;">
                                <table class="table align-items-center mb-0">
                                    <thead style="position: sticky; top: 0; background: white; z-index: 10">
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                Name
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($assigned_lecturers->count() == 0)
                                            <tr>
                                                <td colspan="3" class="text-center">No lecturers are assigned to this
                                                    course yet!</td>
                                            </tr>
                                        @endif

                                        @foreach ($assigned_lecturers as $assigned_lecturer)
                                            <tr>
                                                <td>
                                                    <div class="align-middle text-sm ps-3">
                                                        <h6 class="mb-0 text-sm">{{ $assigned_lecturer->user_id }}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary text-sm font-weight-bold">{{ $assigned_lecturer->name }}</span>
                                                </td>
                                                <td class="align-middle text-center" style="z-index: 3">
                                                    <form class="d-inline" method="POST"
                                                        action="{{ route('deleteLecturer', ['lecturer_id' => $assigned_lecturer->id, 'course_id' => $course->id]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-link"
                                                            data-original-title="" title=""
                                                            onclick="return confirm('Confirm to delete lecturer {{ $assigned_lecturer->user_id }} {{ $assigned_lecturer->name }}?') ?? this.parentNode.submit();"></a>
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <a class="btn bg-gradient-dark my-4 mb-2 mt-6 me-4" href="{{ route('course.index') }}"
                                    class="text-primary text-gradient font-weight-bold">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
        </div>
    </main>
</x-layout>

<script>
    function resetSearch() {
        document.getElementById('keyword').value = "";
    }
</script>
