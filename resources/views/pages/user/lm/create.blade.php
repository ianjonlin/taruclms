<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $courseCode }}"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Learning Materials / {{ $courseCode }} / Add Learning Material">
        </x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Upload New Learning Material</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 justify-content-center">
                        @if ($errors->any())
                            <div class="row m-0">
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
                        <form method='POST' enctype="multipart/form-data"
                            action='{{ route('storeLearningMaterial', ['courseCode' => $courseCode]) }}'>
                            @csrf
                            @method('POST')
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control border border-2 p-2" name="name"
                                        required maxlength="64">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-select border border-2 p-2" name="category" required>
                                        <option disabled selected value>-- select an option --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Material / File</label>
                                    <input type="file" class="form-control form-control-lg border border-2"
                                        name="file">
                                    <label class="form-label">Maximum Upload Size - 100mb &nbsp;&nbsp;|&nbsp;&nbsp;
                                        Supported Upload
                                        Types: .doc, .docx, .xlx, .xlxs, .ppt, .pptx,
                                        .pdf, .jpg,
                                        .jpeg, .png, .gif, .txt</label>
                                </div>

                                OR

                                <div class="mb-3 mt-2">
                                    <label class="form-label">Web URL Link</label>
                                    <input type="text" class="form-control border border-2 p-2" name="url">
                                </div>


                                <div class="d-flex flex-row-reverse">
                                    <a class="btn bg-gradient-dark my-4 mb-2"
                                        href="{{ route('viewLMCategory', ['courseCode' => $courseCode]) }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Upload
                                        Material</button>
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
