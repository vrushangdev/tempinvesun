<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <img class="admin-brand-logo" src="{{ asset('img/front/logo.png') }}" width="150" alt="Invesun Logo">
        <div class="ml-auto">
            <!-- <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a> -->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">

            <li class="menu-item @if(route::is('retailer.dashboard')) active @endif">
                <a href="{{ route('retailer.dashboard') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Dashboard</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>

            <li class="menu-item">
                <a href="https://invesun.com?shared=retailer&sharing_id={{ Auth::guard('retailer')->user()->sharing_id }}" class="menu-link" target="_blank">
                    <span class="menu-label">
                        <span class="menu-name">Share Refferal</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>

             <li class="menu-item @if(route::is('retailer.getMyLeads')) active @endif">
                <a href="{{ route('retailer.getMyLeads') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">My Leads</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-phone "></i></span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>