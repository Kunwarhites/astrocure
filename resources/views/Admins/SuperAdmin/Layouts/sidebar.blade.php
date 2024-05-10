
<style>
    #sidenav{
        position: fixed;
        background-color: #121c39;
        color: white;
        background-image: linear-gradient(180deg,#1c2b55 10%,#080d1d 100%);
        background-size: cover;
    }
</style>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidenav">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AstroCURE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/Admins/Super/' . $user->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{route('dashboard')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('users')}}" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-brands fa-servicestack"></i>
              <p>
                Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('servicecreate')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('serviceList')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-brands fa-teamspeak"></i>
              <p>
                Astrologers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('astrologerCreate')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Astrologers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('astrologer')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Astrologers List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="{{route('appointment')}}" class="nav-link ">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Appointments
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a href="{{ route('businessHours')}}" class="nav-link ">
              <i class="nav-icon fas fa-fw fa-hospital-alt"></i>
              <p>
                Slot Schedule
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('banner')}}" class="nav-link ">
              <i class="nav-icon fas fa-solid fa-photo-film"></i>
              <p>
                Banner
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('feedback')}}" class="nav-link ">
              <i class="nav-icon fas fa-solid fa-comment"></i>
              <p>
                Feedback
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('blogs')}}" class="nav-link ">
              <i class="nav-icon fa-brands fa-blogger"></i>
              <p>
                Blogs
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('events')}}" class="nav-link ">
              <i class="nav-icon fa-solid fa-calendar-days"></i>
              <p>
                Events
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('faq')}}" class="nav-link ">
              <i class="nav-icon fa-solid fa-question"></i>
              <p>
                Faq
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('enquiry')}}" class="nav-link ">
              <i class="nav-icon fa-solid fa-circle-question"></i>
              <p>
                Enquiry
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
