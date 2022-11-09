<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="programme-edit"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Programme / Edit Programme / {{ $programme->code }}">
        </x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Edit Programme</h4>
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
                        <form method='POST' action='{{ route('programme.update', ['programme' => $programme]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select border border-2 p-2" name="type">
                                        @foreach ($types as $type)
                                            @if ($programme->type == $type)
                                                <option value="{{ $type }}" selected>{{ $type }}
                                                </option>
                                            @endif
                                        @endforeach

                                        @foreach ($types as $type)
                                            @if ($programme->type != $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" class="form-control border border-2 p-2" name="code"
                                        required value="{{ $programme->code }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control border border-2 p-2" name="title"
                                        required value="{{ $programme->title }}">
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <a class="btn bg-gradient-dark my-4 mb-2" href="{{ route('programme.index') }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Update
                                        Programme</button>
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
