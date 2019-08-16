<ul id="menu" class="page-sidebar-menu">
    <li >

    <a href="{{ route('dashboard') }}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Dashboard </span>
        </a>
    </li>

        <li >
            <a href="">
                <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                <span class="title">Admin Management</span>
                <span class="fa arrow"></span>
            </a>

            <ul class="sub-menu">

                    <li>
                        <a href="{{ route('admin-management.permissions') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Permissions
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin-management.roles.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Roles
                        </a>
                    </li>
                
                <li >
                    <a href="{{ route('admin-management.users.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Users Company
                    </a>
                </li>

            </ul>
        </li>

        <li >
            <a href="#">
                <i class="livicon" data-name="users" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2" data-loop="true"></i>
                <span class="title">Members</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ route('members.active.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Members Active
                    </a>
                </li>
                <li >
                    <a href="{{ route('members.nonactive.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Member Nonactive
                    </a>
                </li>
            </ul>
     </li>
    <li>
         <a href="{{ route('customer.index') }}">
            <i class="livicon" data-name="customer" data-size="18" data-c="#bdecb6" data-hc="#bdecb6"
               data-loop="true"></i>
                Customers
        </a>
    </li>
    <li>
        <a href="{{ route('tree.index') }}">
            <i class="livicon" data-name="share" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            Tree
        </a>
    </li>
    <li >
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Training</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('trainings.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Training Management 
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-angle-double-right"></i>
                    Training Class
                </a>
            </li>
        </ul>
    </li>
    <li >
        <a href="#">
            <i class="livicon" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Bitrex Money</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('bitrex-money.points') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Bitrex Points
                </a>
            </li>
            <li>
                <a href="{{ route('bitrex-money.cash') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Bitrex Cash
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="livicon" data-name="event" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            <span class="title">Event & Promotion</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('event.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Event
                </a>
            </li>
            <li>
                <a href="{{ route('promotion.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Promotion
                </a>
            </li>
        </ul>
    </li>
    @include('admin/layouts/menu')
</ul>