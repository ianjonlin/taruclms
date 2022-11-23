<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $course->code }}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Learning Materials / {{ $course->code }}">
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
                                        <h3 class="ps-4 pt-4">Manage Learning Materials</h3>
                                        <h5 class="ps-4">{{ $course->code }}&nbsp;{{ $course->title }}</h5>
                                    </div>
                                    <div class="me-3">
                                        <a class="btn bg-gradient-dark mb-0"
                                            href="{{ route('createLMCategory', ['courseCode' => $course->code]) }}">
                                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Category</a>
                                        &nbsp;
                                        <a class="btn bg-gradient-primary mb-0"
                                            href="{{ route('createLearningMaterial', ['courseCode' => $course->code]) }}">
                                            <i class="material-icons text-sm">upload</i>&nbsp;&nbsp;Upload Learning
                                            Materials
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (session('success') || session('error'))
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="row mx-2">
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
                                    <div class="row mx-2">
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

                            @if ($categories->isEmpty())
                                <p class="text-center">No Learning Material Category have been created yet.</p>
                            @endif

                            <div class="accordion-1">
                                <div class="container">
                                    <div class="row">
                                        <div class="mx-auto">
                                            <div class="accordion" id="accordion">
                                                @php($i = 1)
                                                @foreach ($categories as $category)
                                                    <div class="accordion-item mb-3 border p-3">
                                                        <h5 class="accordion-header" id="{{ $i }}">
                                                            <button
                                                                class="accordion-button border-bottom font-weight-bold collapsed"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#c{{ $i }}"
                                                                aria-expanded="true"
                                                                aria-controls="c{{ $i }}">
                                                                {{ $category->name }}
                                                                <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                                    aria-hidden="true"></i>
                                                            </button>
                                                        </h5>
                                                        <div id="c{{ $i }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="h{{ $i }}"
                                                            data-bs-parent="#accordion" style="">
                                                            <div class="text-end mt-3 me-3">
                                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                                    href="{{ route('editLMCategory', ['courseCode' => $course->code, 'id' => $category->id]) }}"
                                                                    data-original-title="" title="">
                                                                    <i class="material-icons">edit</i> &nbsp; Edit
                                                                    Category
                                                                </a>
                                                                &nbsp;
                                                                <form class="d-inline" method="POST"
                                                                    action="{{ route('deleteLMCategory', ['courseCode' => $course->code, 'id' => $category->id]) }}">
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

                                                            <div class="accordion-body text-sm opacity-8">
                                                                <div class="table-responsive"
                                                                    style="max-height: 400px;">
                                                                    <table class="table align-items-center mb-0">
                                                                        <thead
                                                                            style="position: sticky; top: 0; background: white; z-index: 10">
                                                                            <tr>
                                                                                <th
                                                                                    class="text-left text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                                                    File Name
                                                                                </th>
                                                                                <th
                                                                                    class="text-left text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                                                    File Information
                                                                                <th
                                                                                    class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                                                    Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @php($count = 0)
                                                                            @foreach ($learningMaterials as $material)
                                                                                @if ($material->category == $category->id)
                                                                                    <tr>
                                                                                        <td class="align-middle">
                                                                                            <h6
                                                                                                class="text-md text-secondary mb-0">
                                                                                                {{ $material->name }}
                                                                                            </h6>
                                                                                        </td>
                                                                                        <td class="align-middle">
                                                                                            <p
                                                                                                class="text-sm text-secondary mb-0">
                                                                                                .{{ $material->ext }} -
                                                                                                {{ round((int) Storage::size($material->path) / 100000, 2) }}
                                                                                                mb
                                                                                            </p>
                                                                                        </td>
                                                                                        <td class="align-middle text-center"
                                                                                            style="z-index: 3">
                                                                                            <a rel="tooltip"
                                                                                                class="btn btn-info btn-link"
                                                                                                href=" {{ route('downloadLearningMaterial', ['courseCode' => $course->code, 'id' => $material->id]) }}"
                                                                                                data-original-title=""
                                                                                                title="">
                                                                                                <i
                                                                                                    class="material-icons">download</i>
                                                                                                <div
                                                                                                    class="ripple-container">
                                                                                                </div>
                                                                                            </a>
                                                                                            <form class="d-inline"
                                                                                                method="POST"
                                                                                                action="{{ route('deleteLearningMaterial', ['courseCode' => $course->code, 'id' => $material->id]) }}">
                                                                                                @csrf
                                                                                                @method('delete')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger btn-link"
                                                                                                    data-original-title=""
                                                                                                    title=""
                                                                                                    onclick="return confirm('Confirm to delete material {{ $material->name }}?') ?? this.parentNode.submit();"></a>
                                                                                                    <i
                                                                                                        class="material-icons">delete</i>
                                                                                                </button>
                                                                                            </form>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php($count++)
                                                                                @endif
                                                                            @endforeach

                                                                            @if ($count == 0)
                                                                                <tr>
                                                                                    <td colspan="3"
                                                                                        class="text-center">No uploaded
                                                                                        learning materials under this
                                                                                        category!</td>
                                                                                </tr>
                                                                            @endif

                                                                        </tbody>
                                                                    </table>
                                                                </div>
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
