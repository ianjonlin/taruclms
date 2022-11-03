<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Profile Information'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Profile Information</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label">User ID</label>
                                <input type="text" name="user_id" class="form-control border border-2 p-2"
                                    value='{{ old('user_id', auth()->user()->user_id) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control border border-2 p-2"
                                    value='{{ old('email', auth()->user()->email) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control border border-2 p-2"
                                    value='{{ old('name', auth()->user()->name) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Role</label>
                                <input type="text" name="role" class="form-control border border-2 p-2"
                                    value='{{ old('role', auth()->user()->role) }}' readonly>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="floatingTextarea2">About</label>
                                <textarea class="form-control border border-2 p-2" placeholder=" Say something about yourself" id="floatingTextarea2"
                                    name="about" rows="4" cols="50" readonly>{{ old('about', auth()->user()->about) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>
