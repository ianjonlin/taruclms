@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('userProfile') }} ">
            <img src="{{ asset('assets') }}/img/logo-taruc.png" class="navbar-brand-img" alt="taruc_logo">
            <span class="ms-2 font-weight-bold text-white">TAR UC Learning Management System</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">User Details</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'userProfile' ? 'active bg-gradient-info' : '' }} "
                    href="{{ route('userProfile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'changePassword' ? ' active bg-gradient-info' : '' }} "
                    href="{{ route('changePassword') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-wrench ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Change Password</span>
                </a>
            </li>

            @if (auth()->user()->role == 'Student')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Programme
                        Structure</h6>
                </li>
            @elseif (auth()->user()->role == 'Lecturer')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Courses
                        Assigned</h6>
                </li>
            @elseif (auth()->user()->role == 'Admin')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Admin Functions
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'user.index' ? ' active bg-gradient-info' : '' }} "
                        href="{{ route('user.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">manage_accounts</i>
                        </div>
                        <span class="nav-link-text ms-1">Manage User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'programme.index' ? ' active bg-gradient-info' : '' }} "
                        href="{{ route('programme.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">school</i>
                        </div>
                        <span class="nav-link-text ms-1">Manage Programme</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'course.index' ? ' active bg-gradient-info' : '' }} "
                        href="{{ route('course.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">storage</i>
                        </div>
                        <span class="nav-link-text ms-1">Manage Course</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $activePage == 'keyword.index' ? ' active bg-gradient-info' : '' }} "
                        href="{{ route('keyword.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">report</i>
                        </div>
                        <span class="nav-link-text ms-1">Blocked Keywords</span>
                    </a>
                </li>
            @endif

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Templates</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-info' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'tables' ? ' active bg-gradient-info' : '' }} "
                    href="{{ route('tables') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'billing' ? ' active bg-gradient-info' : '' }}  "
                    href="{{ route('billing') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'notifications' ? ' active bg-gradient-info' : '' }}  "
                    href="{{ route('notifications') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Notifications</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
