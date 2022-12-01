<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user.index"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage User"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header pb-0 p-3 px-2">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <h3 class="p-4">Manage User</h3>
                                    <div class="me-3">
                                        <a class="btn bg-gradient-dark mb-0" href="{{ route('user.create') }}">
                                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add User</a>
                                    </div>
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

                            <div class="border border-black border-2 rounded mx-4 p-3 mb-4">
                                <form method='get' class="mx-3" action='{{ route('user.index') }}'>
                                    <div class="row justify-content-center">
                                        <div class="mb-3">
                                            <label class="form-label">Search by User ID or Name or Email</label>
                                            <input type="text" class="form-control border border-2 p-2"
                                                name="keyword">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Search by Role</label>
                                            <br>
                                            <select class="form-select border border-2 p-2" id="role"
                                                name="role" onchange="disableProgramme(this)">
                                                <option disabled selected value>-- Select an option --</option>
                                                <option value="Student">Student</option>
                                                <option value="Lecturer">Lecturer</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Search by Programme</label>
                                            <select class="form-select border border-2 p-2" id="programme"
                                                name="programme">
                                                <option disabled selected value>-- Select an option --</option>
                                                @foreach ($programmes as $programme)
                                                    <option value="{{ $programme->id }}">{{ $programme->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-4 text-end pt-2">
                                            <input type="reset" class="btn bg-gradient-secondary my-4 mb-2 me-2">
                                            <button type="submit"
                                                class="btn bg-gradient-primary my-4 mb-2">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <p class="px-4 fw-normal text-end mb-3">
                                Total records - <b><u>{{ $users->count() }}</u></b> user(s)
                            </p>

                            <div class="table-responsive p-0" style="max-height: 80vh;">
                                <table class="table align-items-center mb-0">
                                    <thead style="position: sticky; top: 0; background: white; z-index: 10">
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                @sortablelink('user_id')
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                @sortablelink('name')</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                @sortablelink('email')</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                @sortablelink('role')</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                @sortablelink('programme')</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count() == 0)
                                            <tr>
                                                <td colspan="6" class="text-center">No user records to display!</td>
                                            </tr>
                                        @endif

                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm text-center">{{ $user->user_id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $user->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-sm text-secondary mb-0">
                                                        {{ $user->email }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-sm font-weight-bold">{{ $user->role }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-sm font-weight-bold">
                                                        @if ($user->role == 'Student')
                                                            @foreach ($programmes as $programme)
                                                                @if ($programme->id == $user->programme)
                                                                    {{ $programme->code }}
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center" style="z-index: 3">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href=" {{ route('user.edit', ['user' => $user]) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    @if ($user->id != auth()->user()->id)
                                                        <form class="d-inline" method="POST"
                                                            action="{{ route('user.destroy', ['user' => $user]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-link"
                                                                data-original-title="" title=""
                                                                onclick="return confirm('Confirm to delete user {{ $user->name }}?') ?? this.parentNode.submit();"></a>
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>

<script>
    function disableProgramme(role) {
        if (role.value == "Lecturer" || role.value == "Admin") {
            document.getElementById("programme").selectedIndex = "0";
            document.getElementById("programme").setAttribute("disabled", "");
        } else {
            document.getElementById("programme").removeAttribute("disabled");
        }
    }
</script>
