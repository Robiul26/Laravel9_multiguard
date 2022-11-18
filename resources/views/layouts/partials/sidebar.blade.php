  @php
      $admin_guard = Auth::guard('admin')->user();
      $web_guard = Auth::guard('web')->user();
  @endphp
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:black;">
      @if ($admin_guard)
          <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
              <span class="brand-text font-weight-light">Essential-Infotech</span>
          </a>
      @endif
      @if ($web_guard)
          <a href="{{ route('dashboard') }}" class="brand-link text-center">
              <span class="brand-text font-weight-light">Essential-Infotech</span>
          </a>
      @endif

      <!-- Sidebar -->
      <div class="sidebar">
          @if (Auth::guard('admin')->check())
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false" id="side">
                      <li class="nav-item has-treeview menu-open">
                          @if ($admin_guard)
                              <a href="{{ route('admin.dashboard') }}"
                                  class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-tachometer-alt"></i>
                                  <p> Dashboard</p>
                              </a>
                          @endif
                          @if ($web_guard)
                              <a href="{{ route('dashboard') }}"
                                  class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-tachometer-alt"></i>
                                  <p> Dashboard</p>
                              </a>
                          @endif
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('customers.index') }}"
                              class="nav-link {{ Request::routeIs('customers.index') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-address-book"></i>
                              <p> Customer </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('warhouses.index') }}"
                              class="nav-link  {{ Request::routeIs('warhouses.index') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-address-book"></i>
                              <p> Warhouse </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('categories.index') }}"
                              class="nav-link {{ Request::routeIs('categories.index') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-address-book"></i>
                              <p> Category </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('units.index') }}"
                              class="nav-link  {{ Request::routeIs('units.index') ? 'active' : '' }}">
                              <i class="nav-icon fa fa-address-book"></i>
                              <p> Unit </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-shopping-cart"></i>
                              <p> Store
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="#Purchase" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Store List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon far fa-money-bill-alt"></i>
                              <p> Store Release
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="#Sale" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Store Release List</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li
                          class="nav-item {{ Request::routeIs('roles.index') || Request::routeIs('roles.edit') || Request::routeIs('permissions.index') || Request::routeIs('permissions.edit') || Request::routeIs('admins.index') || Request::routeIs('users.index') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                              <p> Manage Users
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              @if ($admin_guard->can('Admin Create') ||
                                  $admin_guard->can('Admin View') ||
                                  $admin_guard->can('Admin Edit') ||
                                  $admin_guard->can('Admin Delete'))
                                  <li class="nav-item">
                                      <a href="{{ route('admins.index') }}"
                                          class="nav-link {{ Request::routeIs('admins.index') ? 'active' : '' }}">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Admin</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('permissions.index') }}"
                                          class="nav-link {{ Request::routeIs('permissions.index') || Request::routeIs('permissions.edit') ? 'active' : '' }}">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Permission List</p>
                                      </a>
                                  </li>
                              @endif

                              @if ($admin_guard->can('user.create') ||
                                  $admin_guard->can('user.edit') ||
                                  $admin_guard->can('user.delete') ||
                                  $admin_guard->can('user.update'))
                                  <li class="nav-item">
                                      <a href="{{ route('users.index') }}"
                                          class="nav-link {{ Request::routeIs('users.index') ? 'active' : '' }}">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>User</p>
                                      </a>
                                  </li>
                              @endif
                              @if ($admin_guard->can('role.create') ||
                                  $admin_guard->can('role.edit') ||
                                  $admin_guard->can('role.delete') ||
                                  $admin_guard->can('role.update'))
                                  <li class="nav-item">
                                      <a href="{{ route('roles.index') }}"
                                          class="nav-link {{ Request::routeIs('roles.index') || Request::routeIs('roles.edit') ? 'active' : '' }}">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Role & Permission</p>
                                      </a>
                                  </li>
                              @endif


                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#uReport" class="nav-link">
                              <i class="nav-icon fa fa-flag" aria-hidden="true"></i>
                              <p> Reports</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="#Setting" class="nav-link">
                              <i class="nav-icon fas fa-cog"></i>
                              <p> Settings</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          @if ($admin_guard)
                              <form method="POST" action="{{ route('admin.logout') }}">
                                  @csrf
                                  <a href="{{ route('admin.logout') }}"
                                      onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                      class="nav-link">
                                      <i class="nav-icon far fa-arrow-alt-circle-left"></i>
                                      <p> Logout</p>
                                  </a>
                              </form>
                          @endif
                          @if ($web_guard)
                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                      class="nav-link">
                                      <i class="nav-icon far fa-arrow-alt-circle-left"></i>
                                      <p> Logout</p>
                                  </a>
                              </form>
                          @endif
                      </li>

                  </ul>
              </nav>
          @endif
      </div>
  </aside>
