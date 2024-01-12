<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15"></div>
        <div class="sidebar-brand-text mx-3"> <img src="{{asset('img/logo.png')}}" class="adminLogo"> </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <!-- Nav Item - Pages Collapse Menu -->


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-users"></i>
            <span> Users</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('admin.invitation.index') }}">
                    Invitation Request
                </a>
                <a class="collapse-item" href="{{ route('admin.users.index') }}">
                    Registered Users
                </a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImages" aria-expanded="true" aria-controls="collapseImages">
            <i class="fas fa-image"></i>
            <span> Images</span>
        </a>
        <div id="collapseImages" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.images.show.unreviewed') }}">
                    Published Images ( Unreviewed )
                </a>

            </div>
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                <!-- <a class="collapse-item" href="{{ route('admin.images.show.reviewed') }}"> -->
                    Published Images ( Reviewed )
                </a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseModel" aria-expanded="true" aria-controls="collapseModel">
            <i class="fas fa-image"></i>
            <span> Models</span>
        </a>
        <div id="collapseModel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                    Base Models
                </a>
                <a class="collapse-item" href="#">
                    Lora
                </a>
                <a class="collapse-item" href="#">
                    Embeddings
                </a>
                <a class="collapse-item" href="#">
                    Controlnet
                </a>
                <a class="collapse-item" href="#">
                    SDXL
                </a>

            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePublicModel" aria-expanded="true" aria-controls="collapsePublicModel">
            <i class="fas fa-image"></i>
            <span> Public Models</span>
        </a>
        <div id="collapsePublicModel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                    Base Models
                </a>
                <a class="collapse-item" href="#">
                    Lora
                </a>
                <a class="collapse-item" href="#">
                    Embeddings
                </a>
                <a class="collapse-item" href="#">
                    Controlnet
                </a>
                <a class="collapse-item" href="#">
                    SDXL
                </a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmail" aria-expanded="true" aria-controls="collapseEmail">
            <i class="fas fa-envelope"></i>
            <span> Email Form</span>
        </a>
        <div id="collapseEmail" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">
                    Send
                </a>
                <a class="collapse-item" href="#">
                    Recieve
                </a>
                <a class="collapse-item" href="#">
                    Template
                </a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
            <i class="fas fa-cog"></i>
            <span> Settings</span>
        </a>
        <div id="collapseProfile" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.account_setting') }}">
                    Profile
                </a>


            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading"></div>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>