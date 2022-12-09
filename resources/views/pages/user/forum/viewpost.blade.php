<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="{{ $course->code }}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Forum Post / {{ $course->code }}">
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
                                        <a class="btn bg-gradient-dark my-4 mb-2"
                                            href="{{ route('viewForumPostAll', ['courseCode' => $course->code]) }}"
                                            class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (session('success') || session('error') || $errors->any())
                            <div class="cardbody mx-4 mt-3 mb-0">
                                @if (session('success'))
                                    <div class="row m-0">
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
                            </div>
                        @endif

                        <div class="card-body mx-2 mt-0 pb-0">
                            <div
                                class="d-flex align-items-center justify-content-between border-0 bg-gray-200 border-radius-lg p-3">
                                <div>
                                    <h5 class="mb-1">
                                        {{ $post->title }}
                                    </h5>
                                    <span class="text-sm">{{ $post->name }}
                                        &nbsp;&nbsp; | &nbsp;&nbsp; Posted at
                                        {{ $post->created_at }}</span>
                                    <p class="mt-3 mb-0 font-black font-weight-normal">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @foreach ($replies as $reply)
                            <div class="card-body ms-6 mx-2 mt-0 pb-0">
                                <div class="align-items-center border-0 bg-gray-200 border-radius-lg p-3">
                                    <div>
                                        <span class="text-sm">{{ $reply->name }}
                                            &nbsp;&nbsp; | &nbsp;&nbsp; Posted at
                                            {{ $reply->created_at }}</span>
                                        <p class="mt-3 mb-0 font-black font-weight-normal">
                                            {{ $reply->body }}
                                        </p>
                                    </div>
                                    @if ($reply->created_by == auth()->user()->id)
                                        <div class="me-3">
                                            <form class="d-inline" method="POST"
                                                action="{{ route('deleteForumReply', ['courseCode' => $course->code, 'id' => $reply->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-link align-middle"
                                                    onclick="return confirm('Confirm to delete forum reply?') ?? this.parentNode.submit();"></a>
                                                    <i class="material-icons">delete</i> &nbsp; Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="card-body ms-6 mx-2 mt-0 mb-0">
                            <div class="align-items-center border border-black border-radius-lg p-3">
                                <div>
                                    <form method='POST'
                                        action='{{ route('storeForumReply', ['courseCode' => $course->code, 'id' => $post->id]) }}'>
                                        @csrf
                                        <div>
                                            <textarea class="form-control border border-2 p-2" name="reply" rows="2" required
                                                placeholder="Click here to reply..."></textarea>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn bg-gradient-primary my-4 mb-2">Create
                                                Reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
