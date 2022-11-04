<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-edit"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management / Edit User / {{ $user->user_id }}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Edit User</h4>
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
                        <form method='POST' action='{{ route('user.update', ['user' => $user->id]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">User ID</label>
                                    <input type="text" class="form-control border border-2 p-2" name="user_id"
                                        required value="{{ $user->user_id }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control border border-2 p-2" name="email"
                                        required value="{{ $user->email }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control border border-2 p-2" name="name"
                                        required value="{{ $user->name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control border border-2 p-2" name="password"
                                        disabled>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Role</label>
                                    <select class="form-select border border-2 p-2" name="role" required>
                                        <option value="{{ $user->role }}"> {{ $user->role }} </option>
                                        @if ($user->role != 'Student')
                                            <option value="Student">Student</option>
                                        @endif
                                        @if ($user->role != 'Lecturer')
                                            <option value="Lecturer">Lecturer</option>
                                        @endif
                                        @if ($user->role != 'Admin')
                                            <option value="Admin">Admin</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Programme</label>
                                    <select class="form-select border border-2 p-2" name="programme">
                                        @foreach ($programmes as $programme)
                                            @if ($user->programme == '')
                                                <option value="" selected></option>
                                            @elseif ($user->programme == $programme->id)
                                                <option value="{{ $programme->id }}" selected>{{ $programme->code }}
                                                </option>
                                            @endif
                                        @endforeach
                                        @foreach ($programmes as $programme)
                                            @if ($user->programme != $programme->id)
                                                <option value="{{ $programme->id }}">{{ $programme->code }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <a class="btn bg-gradient-dark my-4 mb-2" href="{{ route('user.index') }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Update
                                        User</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </div>
</x-layout>
