<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" data-double-top-nav="data-double-top-nav"
    style="display: none;">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div>
        <a class="navbar-brand" href="/">
            <div class="d-flex align-items-center py-3">
                <img class="me-2"src="/assets/img/icons/spot-illustrations/logo.png" alt="" width="80" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Module</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('dashboard') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="card-checklist"></span>
                                {{-- <span class="fas fa-chart-pie"></span> --}}
                            </span>
                            <span class="nav-link-text ps-1">Complaint</span>
                        </div>
                    </a>
                    <a class="nav-link" href="app/calendar.html" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-calendar-alt"></span>
                            </span>
                            <span class="nav-link-text ps-1">Calendar</span>
                        </div>
                    </a>
                    <a class="nav-link" href="app/chat.html" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-light navbar-vertical navbar-expand-xl navbar-vibrant" style="display: none;">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div>
        <a class="navbar-brand" href="/">
            <div class="d-flex align-items-center py-3">
                <img class="me-2"src="/assets/img/icons/spot-illustrations/logo.png" alt="" width="80" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item"><!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Module</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('dashboard') }}" role="button">
                        <div class="d-flex align-items-center text-white">
                            <span class="nav-link-icon">
                                <span class="bi-receipt-cutoff"></span>
                            </span>
                            <span class="nav-link-text ps-1">Print Dashboard</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
        </div>
        <a class="navbar-brand" href="/">
            <div class="d-flex align-items-center py-3">
                <img class="me-2"src="/assets/img/icons/spot-illustrations/logo.png" alt=""
                    width="80" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item"><!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Module</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('dashboard') }}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Print Dashboard</span>
                        </div>
                    </a>
                    <a class="nav-link" href="app/calendar.html" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-calendar-alt"></span></span><span
                                class="nav-link-text ps-1">Calendar</span></div>
                    </a><!-- parent pages--><a class="nav-link" href="app/chat.html" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-comments"></span></span><span class="nav-link-text ps-1">Chat</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
            aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="{{ route('dashboard') }}">
            <div class="d-flex align-items-center"><img class="me-2"
                    src="/assets/img/icons/spot-illustrations/logo.png" alt="" width="40" /><span
                    class="font-sans-serif text-primary">Atom Banana</span></div>
        </a>

        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
            <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-xl">
                        <img class="rounded-circle" src="/assets/img/team/avatar.png" alt="" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                    aria-labelledby="navbarDropdownUser">
                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                        <!-- <a class="dropdown-item fw-bold text-warning" href="#!"><span
                                class="fas fa-crown me-1"></span><span>Profile</span></a>
                        <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;" data-move-target="#navbarVerticalNav" data-navbar-top="combo">
        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
            aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                    class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="{{ route('dashboard') }}">
            <div class="d-flex align-items-center"><img class="me-2"
                    src="/assets/img/icons/spot-illustrations/logo.png" alt="" width="40" /><span
                    class="font-sans-serif text-primary">Atom Banana</span></div>
        </a>

        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
            <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-xl">
                        <img class="rounded-circle" src="/assets/img/team/avatar.png" alt="" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                    aria-labelledby="navbarDropdownUser">
                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                        <a class="dropdown-item fw-bold text-warning" href="#!"><span
                                class="fas fa-crown me-1"></span><span>Profile</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
