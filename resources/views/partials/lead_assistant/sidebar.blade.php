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
                    <span class="menu-icon"><i class="icon-placeholder fe fe-user "></i></span>
                </a>
            </li>

             <li class="menu-item @if(route::is('lead_assistant.getMyLeads')) active @endif">
                <a href="{{ route('lead_assistant.getMyLeads') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">My Leads</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-edit "></i></span>
                </a>
            </li>

            <li class="menu-item @if(route::is('lead_assistant.attendedList')) active @endif">
                <a href="{{ route('lead_assistant.attendedList') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Attednded List</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>

            <li class="menu-item @if(route::is('lead_assistant.workSchedule')) active @endif">
                <a href="{{ route('lead_assistant.workSchedule') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Work Schedule</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>