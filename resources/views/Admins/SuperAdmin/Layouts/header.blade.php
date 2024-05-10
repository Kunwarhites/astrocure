  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="" class="nav-link">@yield('title')</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="" class="nav-link">Contact</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form class="form-inline">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" type="search" placeholder="Search"
                              aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">{{ $totalFeedbackCount }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  @foreach ($feedbackData as $feed)
                      <a href="{{ route('feedback')}}" class="dropdown-item">
                          <!-- Message Start -->
                          <div class="media">
                              <img src="{{ url('dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                  class="img-size-50 mr-3 img-circle">
                              <div class="media-body">
                                  <h3 class="dropdown-item-title">
                                      {{ $feed->name }}
                                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                  </h3>
                                  <p class="text-sm">{{ \Illuminate\Support\Str::limit($feed->comment, $limit = 20, $end = '...') }}</p>
                                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                      {{ $feed->created_at->diffForHumans() }}</p>
                              </div>
                          </div>
                          <!-- Message End -->
                      </a>
                      <div class="dropdown-divider"></div>
                  @endforeach

                  <a href="{{ route('feedback')}}" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="" class="dropdown-item">
                      <i class="fas fa-envelope mr-2"></i> 4 new messages
                      <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="" class="dropdown-item">
                      <i class="fas fa-users mr-2"></i> 8 friend requests
                      <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="" class="dropdown-item">
                      <i class="fas fa-file mr-2"></i> 3 new reports
                      <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          <li class="nav-item dropdown ">
              <a class="nav-link" data-toggle="dropdown" href="">
                  <img src="{{ asset('images/Admins/Super/' . $user->image) }}" class="img-fluid rounded-circle img-thumbnail" style="width:30px;height:30px;" alt=""> &nbsp; {{ $user->name }}
                  {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-2">
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('Admin.profile')}}" class="dropdown-item">
                      <i class="fa-solid fa-circle-user mr-2"></i> <span class="text-success">Profile
                          <small>({{ $user->name }})</small></span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="" class="dropdown-item">
                      <i class="fa-solid fa-gear mr-2"></i> <span class="text-primary">Setting</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('logouts') }}" class="dropdown-item">
                      <i class="fa-solid fa-right-from-bracket mr-2"></i><span class="text-danger"> Logout</span>
                  </a>
                  <div class="dropdown-divider"></div>

              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
