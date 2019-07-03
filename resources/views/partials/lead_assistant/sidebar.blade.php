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

            <li class="menu-item @if(route::is('lead_assistant.dashboard')) active @endif">
                <a href="{{ route('lead_assistant.dashboard') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Dashboard</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>

            <li class="menu-item @if(route::is('lead_assistant.getLeadRequest')) active @endif">
                <a href="{{ route('lead_assistant.getLeadRequest') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Lead Request</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>
        </ul>
    </div>
</aside>