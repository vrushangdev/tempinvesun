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

            <li class="menu-item @if(route::is('consumer.dashboard')) active @endif">
                <a href="{{ route('consumer.dashboard') }}" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Consumer Timeline</span>
                    </span>
                    <span class="menu-icon"><i class="icon-placeholder fe fe-home "></i></span>
                </a>
            </li>

        </ul>
    </div>
</aside>