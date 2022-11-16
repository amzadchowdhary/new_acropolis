<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <a href="#" class="brand-link">
        <x-application-logo class="brand-image img-circle elevation-3" />
        <span class="brand-text font-weight-light">New Acropolis</span>
    </a>



    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <a href="#" class="d-block">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <a href="{{route('user.profile',['id'=>Auth::user()->id])}}" class="brand-link">
                    <div class="image">
                        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        {{ Auth::user()->name }}
                    </div>
                </a>
            </div>
        </a>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>

