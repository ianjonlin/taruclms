<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $courseCode }}"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Course / {{ $courseCode }} / Create Forum Post"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3 mx-2">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Create Forum Post</h4>
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

                        <div class="row m-0">
                            <div class="alert alert-info alert-dismissible text-white" role="alert">
                                <span class="text-bold">
                                    Do not enter any negative, ill-mannered terms and keywords in your Post Title or Body.
                                </span>
                            </div>
                        </div>

                        <form method='POST' action='{{ route('storeForumPost', ['courseCode' => $courseCode]) }}'>
                            @csrf
                            @method('POST')
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Post Title</label>
                                    <input type="text" class="form-control border border-2 p-2" name="title"
                                        required maxlength="64">
                                    <label class="form-label">Title should be concise and direct to your question's
                                        theme and nature. <br> Examples - Double Linked List, Factors of Pollution,
                                        Issues on installing software etc.</label>
                                </div>

                                <div>
                                    <label class="form-label">Post Body / Description</label>
                                    <textarea class="form-control border border-2 p-2" name="body" rows="10" required></textarea>
                                    <label class="form-label">Provide description and details to your question post.</label>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <a class="btn bg-gradient-dark my-4 mb-2"
                                        href="{{ route('viewForumPostAll', ['courseCode' => $courseCode]) }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Confirm
                                        Changes</button>
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
