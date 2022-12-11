<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $course->code }}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View All Forum Post / {{ $course->code }}">
        </x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header pb-0 p-3 ps-2">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="ps-4 pt-4">View All Forum Post</h3>
                                        <h5 class="ps-4">{{ $course->code }}&nbsp;{{ $course->title }}</h5>
                                    </div>

                                    <div class="me-3">
                                        <a class="btn bg-gradient-dark mb-0"
                                            href="{{ route('viewCourse', ['courseCode' => $course->code]) }}"
                                            class="text-primary text-gradient font-weight-bold">Go Back</a>
                                        @if (auth()->user()->role == 'Student')
                                            &nbsp;
                                            <a class="btn bg-gradient-primary mb-0"
                                                href="{{ route('createForumPost', ['courseCode' => $course->code]) }}">
                                                <i class="material-icons text-sm">post_add</i>&nbsp;&nbsp;Post
                                                Question</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-2 pt-0">
                            @if (session('success') || session('error'))
                                <div class="card-body py-0 mt-3 mb-0">
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

                            <div class="card-body">
                                @if (!$userposts->isEmpty())
                                    <h4>Your Posts</h4>
                                    @foreach ($userposts as $post)
                                        <div class="row mx-0">
                                            <div
                                                class="d-flex align-items-center justify-content-between border-0 bg-gray-200 border-radius-lg mb-3 py-3">
                                                <div class="row w-100">
                                                    <div class="col-sm-10">
                                                        <h5>
                                                            <a
                                                                href="{{ route('viewForumPost', ['courseCode' => $course->code, 'id' => $post->id]) }}">
                                                                {{ $post->title }}</a>
                                                        </h5>
                                                        <span class="text-sm">Posted at {{ $post->created_at }}</span>
                                                        &nbsp;&nbsp;
                                                        <i
                                                            class="material-icons">comment</i>&nbsp;{{ $post->replyCount }}
                                                    </div>
                                                    <div class="col-sm-2 d-flex justify-content-center mt-3">
                                                        <form class="d-inline" method="POST"
                                                            action="{{ route('deleteForumPost', ['courseCode' => $course->code, 'id' => $post->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-link align-middle"
                                                                onclick="return confirm('Confirm to delete forum post?') ?? this.parentNode.submit();"></a>
                                                                <i class="material-icons">delete</i> &nbsp; Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <br>
                                @endif

                                <h4>Most Recent Posted Questions</h4>
                                <div style="height:30em; overflow-y: scroll;">
                                    @foreach ($forumposts as $post)
                                        <div class="row mx-0 pe-3">
                                            <div
                                                class="d-flex align-items-center justify-content-between border-0 bg-gray-200 border-radius-lg mb-3 py-3">
                                                <div class="row w-100">
                                                    <div class="col-sm-10">
                                                        <h5>
                                                            <a
                                                                href="{{ route('viewForumPost', ['courseCode' => $course->code, 'id' => $post->id]) }}">
                                                                {{ $post->title }}</a>
                                                        </h5>
                                                        <span class="text-sm">{{ $post->name }}
                                                            &nbsp;&nbsp; | &nbsp;&nbsp; Posted at
                                                            {{ $post->created_at }}</span>
                                                        &nbsp;&nbsp;
                                                        <i
                                                            class="material-icons">comment</i>&nbsp;{{ $post->replyCount }}
                                                    </div>

                                                    @if ($post->created_by == auth()->user()->id)
                                                        <div class="col-sm-2 d-flex justify-content-center mt-3">
                                                            <form class="d-inline" method="POST"
                                                                action="{{ route('deleteForumPost', ['courseCode' => $course->code, 'id' => $post->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-link align-middle"
                                                                    onclick="return confirm('Confirm to delete forum post?') ?? this.parentNode.submit();"></a>
                                                                    <i class="material-icons">delete</i> &nbsp; Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
