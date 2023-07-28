@if (Auth::user()->hasRole('super_admin'))
<nav class="sb-sidenav accordion sb-sidenav-dark bg-indigo-800 shadow-sm" id="sidenavAccordion" name="11">
    <div class="sb-sidenav-menu ">
        <div class="nav ">
            <a class="nav-link text-light btn-outline-info mt-4" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <a class="nav-link text-light btn-outline-info" href="{{ route('admin.students') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Students
            </a>

            <a class="nav-link text-light btn-outline-info" href="{{ route('admin.students.attendance') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Students Attendance
            </a>
            <a class="nav-link text-light btn-outline-info" href="{{ route('admin.single.student.attendances') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Single Student Attendance Report
            </a>

            <a class="nav-link text-light btn-outline-info" href="{{ route('admin.students.leave.requests') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Students Leave Requests
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer bg-transparent text-center text-dark">
        <div class="small">Logged in as:</div>
        <h5>{{ Auth::user()->name }}</h5>
    </div>
</nav>

@elseif (Auth::user()->hasRole('student'))
<nav class="sb-sidenav accordion sb-sidenav-dark shadow bg-gray-800" id="sidenavAccordion" name="22">
    <div class="sb-sidenav-menu ">
        <div class="nav ">
            <a class="nav-link text-white" href="{{ route('student.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link text-white" href="{{ route('student.attendances') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                See Attendace
            </a>
            <a class="nav-link text-white" href="{{ route('student.attendance.create',Auth::user()) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Mark Attendace
            </a>
            <a class="nav-link text-white" href="{{ route('student.leave.request.create',Auth::user()) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Request For Leave
            </a>
            <a class="nav-link text-white" href="{{ route('student.leave.requests.index',Auth::user()) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Request Submitted
            </a>



        </div>
    </div>
    <div class="sb-sidenav-footer bg-transparent text-center text-muted">
        <div class="small">Logged in as:</div>
        <h5>{{ Auth::user()->name }}</h5>
    </div>
</nav>

@endif
