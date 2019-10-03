<ul id="menu" class="page-sidebar-menu">
    <li class="{{ (request()->is('backoffice/dashboard')) ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard" style="color: #6CC66C"  data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Dashboard </span>
        </a>
    </li>

    <li class="{{ (request()->segment(2))=='ebook' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-book" style="color: #6CC66C" data-name="notebook" data-size="18" data-c="#bdecb6" data-hc="#bdecb6" data-loop="true"></i>
            <span class="title">Ebooks</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/ebook')) ? 'active' : '' }}">
                <a href="{{ route('ebook.index') }}">
                    <i class="fa fa-reorder"></i>
                    Ebook List
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/ebook/create')) ? 'active' : '' }}">
                <a href="{{ route('ebook.create') }}">
                    <i class="fa fa-plus"></i>
                    Create New Ebook
                </a>
            </li>

        </ul>
    </li>

    <li class="{{ (request()->segment(2))=='members' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-user" style="color: #6CC66C" data-name="users" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2" data-loop="true"></i>
            <span class="title">Members</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/members/active')) ? 'active' : '' }}">
                <a href="{{ route('members.active.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Members Active
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/members/nonactive')) ? 'active' : '' }}">
                <a href="{{ route('members.nonactive.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Member Nonactive
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ (request()->is('backoffice/customer')) ? 'active' : '' }}">
        <a href="{{ route('customer.index') }}">
            <i class="fa fa-users" style="color: #6CC66C" data-name="customer" data-size="18" data-c="#bdecb6" data-hc="#bdecb6"
                data-loop="true"></i>
                Customers
        </a>
    </li>
    <li class="{{ (request()->is('backoffice/new-tree')) ? 'active' : '' }}">
        <a href="{{ route('new-tree.index') }}">
            <i class="fa fa-sitemap" style="color: #6CC66C" data-name="share" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            Tree
        </a>
    </li>
    <li class="{{ (request()->is('backoffice/transfer-confirmation')) ? 'active' : '' }}">
        <a href="{{ route('transfer-confirmation.index') }}">
            <i class="fa fa-check-square" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            Transfer Confirmation
        </a>
    </li>
    <li class="{{ (request()->is('backoffice/reward-claims')) ? 'active' : '' }}">
        <a href="{{ route('reward-claims.index') }}">
            <i class="fa fa-calendar-check-o" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
            data-loop="true"></i>
            Rewards Claim
        </a>
    <li class="{{ (request()->segment(2))=='withdrawal-bonus' || (request()->segment(2))=='withdrawal-time' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-credit-card" style="color: #6CC66C" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Withdrawal</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/withdrawal-bonus')) ? 'active' : '' }}">
                <a href="{{ route('withdrawal-bonus.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Withdrawal Claim
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/withdrawal-bonus/paidindex')) ? 'active' : '' }}">
                <a href="{{ route('withdrawal-bonus.paidindex') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Withdrawal Paid
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/withdrawal-time')) ? 'active' : '' }}">
                <a href="{{ route('withdrawal-time.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Withdrawal Time
                </a>
            </li>
        </ul>
    </li>

    <li class="{{ (request()->segment(2))=='bitrex-money' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-money" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Bitrex Money</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/bitrex-money/points')) ? 'active' : '' }}">
                <a href="{{ route('bitrex-money.points') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Bitrex Points
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/bitrex-money/cash')) ? 'active' : '' }}">
                <a href="{{ route('bitrex-money.cash') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Bitrex Value
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ (request()->segment(2))=='bonus' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-gift" style="color: #6CC66C" data-name="gift" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Bonus</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/bonus/sponsor')) ? 'active' : '' }}">
                <a href="{{ route('bonus.sponsor') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Sponsor
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/bonus/pairing')) ? 'active' : '' }}">
                <a href="{{ route('bonus.pairing') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Pairing
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/bonus/profit')) ? 'active' : '' }}">
                <a href="{{ route('bonus.profit') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Profit
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/bonus/reward')) ? 'active' : '' }}">
                <a href="{{ route('bonus.reward') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Reward
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/bonus/event-and-promotion')) ? 'active' : '' }}">
                <a href="{{ route('bonus.event-and-promotion') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Event and promotion
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ (request()->segment(2))=='report' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-newspaper-o" style="color: #6CC66C"  data-name="map" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Report</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/report/transaction')) ? 'active' : '' }}">
                <a href="{{ route('report.transaction') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Transaction
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ (request()->segment(2))=='cms' ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-rss" style="color: #6CC66C"  data-name="grid" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">CMS</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/cms/our-products')) ? 'active' : '' }}">
                <a href="{{ route('cms.our-products.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Our Products
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/cms/our-headquarters')) ? 'active' : '' }}">
                <a href="{{ route('cms.our-headquarters.show') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Our Headquarter
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/cms/event-promotions')) ? 'active' : '' }}">
                <a href="{{ route('cms.event-promotions.show') }}">
                    <i class="fa fa-angle-double-right"></i>
                   Event Promotion
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/cms/testimonials')) ? 'active' : '' }}">
                <a href="{{ route('cms.testimonials.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Testimonial
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/cms/about-us')) ? 'active' : '' }}">
                <a href="{{ route('cms.about-us.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    About Us
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ (request()->segment(2))=='admin-management' ? 'active' : '' }}">
        <a href="">
            <i class="fa fa-cogs" style="color: #6CC66C"  data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
            <span class="title">Admin Management</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="{{ (request()->is('backoffice/admin-management/permissions')) ? 'active' : '' }}">
                <a href="{{ route('admin-management.permissions') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Permissions
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/admin-management/roles')) ? 'active' : '' }}">
                <a href="{{ route('admin-management.roles.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Roles
                </a>
            </li>
            <li class="{{ (request()->is('backoffice/admin-management/users')) ? 'active' : '' }}"">
                <a href="{{ route('admin-management.users.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Users Company
                </a>
            </li>
        </ul>
    </li>
    @include('admin/layouts/menu')
</ul>