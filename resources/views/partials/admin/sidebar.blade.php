<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <img class="admin-brand-logo" src="{{ asset('img/logo.png') }}" width="40" alt="atmos Logo">
        <div class="ml-auto">
            <!-- <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a> -->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">

            <li class="menu-item @if(route::is('admin.dashboard')) active @endif">
                <a href="{{ route('admin.dashboard') }}" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Dashboard</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>

            <li class="menu-item @if(route::is('roleList') || route::is('addRole')) active opened @endif">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Role Management
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder fe fe-edit "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu" @if(route::is('roleList') || route::is('addRole')) style="display: block;" @endif>
                    <li class="menu-item @if(route::is('addRole')) active @endif">
                        <a href="{{ route('addRole') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add Role</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item @if(route::is('roleList')) active @endif">
                        <a href="{{ route('roleList') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Role List </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbook "></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item @if(route::is('userList') || route::is('addUser')) active opened @endif">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">User Management
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder fe fe-user "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu" @if(route::is('userList') || route::is('addUser')) style="display: block;" @endif>
                    <li class="menu-item @if(route::is('addUser')) active @endif">
                        <a href="{{ route('addUser') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add User</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item @if(route::is('userList')) active @endif">
                        <a href="{{ route('userList') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">User List </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbook "></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>