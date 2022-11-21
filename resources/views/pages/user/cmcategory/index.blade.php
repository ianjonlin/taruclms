<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $course->code }}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Course Materials / {{ $course->code }}">
        </x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header pb-0 p-3 px-2">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="ps-4 pt-4">Manage Course Material Categories</h3>
                                        <h5 class="ps-4">{{ $course->code }}&nbsp;{{ $course->title }}</h5>
                                    </div>
                                    <div class="me-3">
                                        <a class="btn bg-gradient-dark mb-0"
                                            href="{{ route('createCMCategory', ['courseCode' => $course->code]) }}">
                                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Category</a>
                                        &nbsp;
                                        <a class="btn bg-gradient-info mb-0" href="">
                                            <i class="material-icons text-sm">upload</i>&nbsp;&nbsp;Upload Course
                                            Materials
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (session('success') || session('error'))
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="row">
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ session('success') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="row">
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
                        <div class="card-body px-2">
                            <div class="accordion-1">
                                <div class="container">
                                    <div class="row">
                                        <div class="mx-auto">
                                            <div class="accordion" id="accordion">
                                                @php($i = 1)
                                                @foreach ($categories as $category)
                                                    <div class="accordion-item mb-3 border p-3">
                                                        <h5 class="accordion-header" id="{{$i}}">
                                                            <button
                                                                class="accordion-button border-bottom font-weight-bold collapsed"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#c{{$i}}" aria-expanded="true"
                                                                aria-controls="c{{$i}}">
                                                                {{ $category->name }}
                                                                <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                                    aria-hidden="true"></i>
                                                            </button>
                                                        </h5>
                                                        <div id="c{{$i}}" class="accordion-collapse collapse"
                                                            aria-labelledby="h{{$i}}" data-bs-parent="#accordion"
                                                            style="">
                                                            <div class="text-end mt-3 me-3">
                                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                                    href="{{ route('editCMCategory', ['courseCode' => $course->code, 'id' => $category->id]) }}"
                                                                    data-original-title="" title="">
                                                                    <i class="material-icons">edit</i> &nbsp; Edit
                                                                    Category
                                                                </a>
                                                                &nbsp;
                                                                <form class="d-inline" method="POST"
                                                                    action="{{ route('deleteCMCategory', ['courseCode' => $course->code, 'id' => $category->id]) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-link"
                                                                        data-original-title="" title=""
                                                                        onclick="return confirm('Confirm to delete category and uploaded materials of {{ $category->name }} ?') ?? this.parentNode.submit();"></a>
                                                                        <i class="material-icons">delete</i> &nbsp;
                                                                        Delete
                                                                        Category
                                                                    </button>
                                                                </form>
                                                            </div>

                                                            <div>
                                                                {{-- TABLE --}}
                                                            </div>

                                                            <div class="accordion-body text-sm opacity-8">
                                                                A table should be here!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php($i++)
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end me-3">
                                    <a class="btn bg-gradient-dark my-4 mb-2"
                                        href="{{ route('viewCourse', ['courseCode' => $course->code]) }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
    </main>
</x-layout>