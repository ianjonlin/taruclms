<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="programme.index"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Programme"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <h3 class="p-4">Manage Programme</h3>
                                    <div class="me-3">
                                        <a class="btn bg-gradient-dark mb-0" href="{{ route('programme.create') }}">
                                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Programme</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-2">
                            @if (session('success') || session('error'))
                                <div class="card-body py-0">
                                    @if (session('success'))
                                        <div class="row">
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
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                @sortablelink('id')
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                @sortablelink('code')</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                @sortablelink('title')</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($programmes->count() == 0)
                                            <tr>
                                                <td colspan="6">No programme records to display!</td>
                                            </tr>
                                        @endif

                                        @foreach ($programmes as $programme)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm text-center">{{ $programme->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $programme->code }}</h6>

                                                    </div>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $programme->title }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href=" {{ route('programme.edit', ['programme' => $programme]) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <form class="d-inline" method="POST"
                                                        action="{{ route('programme.destroy', ['programme' => $programme]) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-link"
                                                            data-original-title="" title=""
                                                            onclick="return confirm('Confirm to delete programme {{ $programme->code }} - {{ $programme->title }} ?') ?? this.parentNode.submit();"></a>
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex flex-row-reverse">
                                    @if ($programmes->hasPages())
                                        <div class="pagination-wrapper">
                                            {{ $programmes->links() }}
                                        </div>
                                    @endif
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
