<header class="admin-header">
    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
    <nav class=" ml-auto">
        <ul class="nav align-items-center">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark">{{ substr(Auth::guard('retailer')->user()->name, 0, 1) }}</span>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right">
                    <a class="dropdown-item" id="copyButton" href="javascript:void(0);"> Sharing Link</a>
                    <input type="hidden" class="copyLinkUrl" id="copyTarget" value="http://invesun.homipod.com?shared=retailer&sharing_id={{ Auth::guard('retailer')->user()->sharing_id }}">
                   <!--  <a class="dropdown-item" href="{{ route('retailer.changePassoword') }}">  Change Password</a>
                    <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="{{ route('retailer.logout') }}"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>