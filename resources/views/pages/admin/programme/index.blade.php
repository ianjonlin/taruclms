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
                        <div class="card-header pb-0 p-3 px-2">
                            <div class="row">
                                <div class="col-md-12 d-flex align-items-center justify-content-between">
                                    <h3 class="p-4">Manage Programme</h3>
                                    <div class="me-3">
                                        <a class="btn bg-gradient-dark mb-0" href="{{ route('programme.create') }}">
                                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Programme</a>
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

                            <div class="border border-black border-2 rounded mx-4 p-3 mb-4">
                                <form method='get' class="mx-3" action='{{ route('programme.index') }}'>
                                    <div class="row justify-content-center">
                                        <div class="mb-3">
                                            <label class="form-label">Search by Title</label>
                                            <input type="text" class="form-control border border-2 p-2"
                                                name="title">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Search by Code</label>
                                            <input type="text" class="form-control border border-2 p-2"
                                                name="code">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Search by Type</label>
                                            <br>
                                            <select class="form-select border border-2 p-2" name="type">
                                                <option disabled selected value>-- Select an option --</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>
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
                                Total records - <b><u>{{ $programmes->count() }}</u></b> programme(s)
                            </p>

                            <div class="table-responsive p-0" style="max-height: 400px;">
                                <table class="table align-items-center mb-0">
                                    <thead style="position: sticky; top: 0; background: white; z-index: 10">
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                @sortablelink('id')
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                @sortablelink('type')</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                @sortablelink('code')</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                @sortablelink('title')</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Programme Structure</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($programmes->count() == 0)
                                            <tr>
                                                <td colspan="6" class="text-center">No programme records to display!
                                                </td>
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
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm text-secondary mb-0">{{ $programme->type }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $programme->code }}</h6>

                                                    </div>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm text-secondary mb-0">{{ $programme->title }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a rel="tooltip" class="btn btn-info btn-link"
                                                        href=" {{ route('programme.show', ['programme' => $programme]) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">remove_red_eye</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center" style="z-index: 3">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
