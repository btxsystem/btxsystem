<ul id="menu" class="page-sidebar-menu">

    @if(\Auth::guard('admin')->user()->hasPermission('Dashboard'))
        <li class="{{ (request()->is('backoffice/dashboard')) ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-dashboard" style="color: #6CC66C"  data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                    data-loop="true"></i>
                <span class="title">Dashboard </span>
            </a>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Ebooks'))
        <li class="{{ (request()->segment(2))=='ebook' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-book" style="color: #6CC66C" data-name="notebook" data-size="18" data-c="#bdecb6" data-hc="#bdecb6" data-loop="true"></i>
                <span class="title">Ebooks</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Ebooks.list'))
                    <li class="{{ (request()->is('backoffice/ebook')) ? 'active' : '' }}">
                        <a href="{{ route('ebook.index') }}">
                            <i class="fa fa-reorder"></i>
                            Ebook List
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    <li class="{{ (request()->is('backoffice/contact-us')) ? 'active' : '' }}">
        <a href="{{ route('contact-us.index') }}">
            <i class="fa fa-envelope" style="color: #6CC66C"  data-name="contact-us" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                data-loop="true"></i>
            <span class="title">Contact US </span>
        </a>
    </li>

    @if(\Auth::guard('admin')->user()->hasPermission('Members'))
        <li class="{{ (request()->segment(2))=='members' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-user" style="color: #6CC66C" data-name="users" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2" data-loop="true"></i>
                <span class="title">Members</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Members.active'))
                    <li class="{{ (request()->is('backoffice/members/active')) ? 'active' : '' }}">
                        <a href="{{ route('members.active.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Members Active
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Members.nonactive'))
                    <li class="{{ (request()->is('backoffice/members/nonactive')) ? 'active' : '' }}">
                        <a href="{{ route('members.nonactive.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Member Nonactive
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Customers'))
        <li class="{{ (request()->is('backoffice/customer')) ? 'active' : '' }}">
            <a href="{{ route('customer.index') }}">
                <i class="fa fa-users" style="color: #6CC66C" data-name="customer" data-size="18" data-c="#bdecb6" data-hc="#bdecb6"
                    data-loop="true"></i>
                    Customers
            </a>
        </li>
    @endif
    
    @if(\Auth::guard('admin')->user()->hasPermission('Hall_Of_Fame'))
        <li class="{{ (request()->is('backoffice/hall-of-fame')) ? 'active' : '' }}">
            <a href="{{ route('hall-of-fame.index') }}">
                <i class="fa fa-diamond" style="color: #6CC66C" data-name="customer" data-size="18" data-c="#bdecb6" data-hc="#bdecb6"
                    data-loop="true"></i>
                    Hall Of Fame
            </a>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Verification_npwp'))
        <li class="{{ (request()->is('backoffice/verification-npwp')) ? 'active' : '' }}">
            <a href="{{ route('verification-npwp.index') }}">
                <i class="fa fa-check-circle" style="color: #6CC66C" data-name="customer" data-size="18" data-c="#bdecb6" data-hc="#bdecb6"
                    data-loop="true"></i>
                    Verification NPWP
            </a>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Tree'))
        <li class="{{ (request()->is('backoffice/new-tree')) ? 'active' : '' }}">
            <a href="{{ route('new-tree.index') }}">
                <i class="fa fa-sitemap" style="color: #6CC66C" data-name="share" data-size="18" data-c="#F89A14" data-hc="#F89A14"
                data-loop="true"></i>
                Tree
            </a>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Transfer_confirmation'))
        <li class="{{ (request()->is('backoffice/transfer-confirmation')) ? 'active' : '' }}">
            <a href="{{ route('transfer-confirmation.index') }}">
                <i class="fa fa-check-square" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                Transfer Confirmation
            </a>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('List_va'))
    <li class="{{ (request()->is('backoffice/list-va')) ? 'active' : '' }}">
        <a href="{{ route('list-va') }}">
            <i class="fa fa-credit-card" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
            data-loop="true"></i>
            List VA
        </a>
    </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Claim_rewards'))
        <li class="{{ (request()->is('backoffice/reward-claims')) ? 'active' : '' }}">
            <a href="{{ route('reward-claims.index') }}">
                <i class="fa fa-calendar-check-o" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                Rewards Claim
            </a>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal'))
        <li class="{{ (request()->segment(2))=='withdrawal-bonus' || (request()->segment(2))=='withdrawal-time' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-credit-card" style="color: #6CC66C" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                <span class="title">Withdrawal</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.claim'))
                    <li class="{{ (request()->is('backoffice/withdrawal-bonus')) ? 'active' : '' }}">
                        <a href="{{ route('withdrawal-bonus.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Withdrawal Claim
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.paid'))
                    <li class="{{ (request()->is('backoffice/withdrawal-bonus/paidindex')) ? 'active' : '' }}">
                        <a href="{{ route('withdrawal-bonus.paidindex') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Withdrawal Paid
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Withdrawal.time'))
                    <li class="{{ (request()->is('backoffice/withdrawal-time')) ? 'active' : '' }}">
                        <a href="{{ route('withdrawal-time.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Withdrawal Time
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Bitrex-money'))
        <li class="{{ (request()->segment(2))=='bitrex-money' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-money" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                <span class="title">Bitrex Money</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Bitrex-money.bitrex-points'))
                    <li class="{{ (request()->is('backoffice/bitrex-money/points')) ? 'active' : '' }}">
                        <a href="{{ route('bitrex-money.points') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Bitrex Points
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Bitrex-money.bitrex-value'))
                    <li class="{{ (request()->is('backoffice/bitrex-money/cash')) ? 'active' : '' }}">
                        <a href="{{ route('bitrex-money.cash') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Bitrex Value
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Bonus'))
        <li class="{{ (request()->segment(2))=='bonus' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-gift" style="color: #6CC66C" data-name="gift" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                <span class="title">Bonus</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Bonus.sponsor'))
                    <li class="{{ (request()->is('backoffice/bonus/sponsor')) ? 'active' : '' }}">
                        <a href="{{ route('bonus.sponsor') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Sponsor
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Bonus.pairing'))
                    <li class="{{ (request()->is('backoffice/bonus/pairing')) ? 'active' : '' }}">
                        <a href="{{ route('bonus.pairing') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Pairing
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Bonus.profit'))
                    <li class="{{ (request()->is('backoffice/bonus/profit')) ? 'active' : '' }}">
                        <a href="{{ route('bonus.profit') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Profit
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Bonus.reward'))
                    <li class="{{ (request()->is('backoffice/bonus/reward')) ? 'active' : '' }}">
                        <a href="{{ route('bonus.reward') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Reward
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Bonus.event'))
                    <li class="{{ (request()->is('backoffice/bonus/event-and-promotion')) ? 'active' : '' }}">
                        <a href="{{ route('bonus.event-and-promotion.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Event and promotion
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Report'))
        <li class="{{ (request()->segment(2))=='report' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-newspaper-o" style="color: #6CC66C"  data-name="map" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                <span class="title">Report</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Report.transaction'))
                    <li class="{{ (request()->is('backoffice/report/transaction')) ? 'active' : '' }}">
                        <a href="{{ route('report.transaction') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Transaction
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="sub-menu">
                 @if(\Auth::guard('admin')->user()->hasPermission('Birthdate')) 
                    <li class="#">
                        <a href="{{ route('report.birthdate') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Birthdate
                        </a>
                    </li>
                 @endif
            </ul>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Cms'))
        <li class="{{ (request()->segment(2))=='cms' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-rss" style="color: #6CC66C"  data-name="grid" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                <span class="title">CMS</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Cms.our_product'))
                    <li class="{{ (request()->is('backoffice/cms/our-products')) ? 'active' : '' }}">
                        <a href="{{ route('cms.our-products.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Our Products
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Cms.headquarter'))
                    <li class="{{ (request()->is('backoffice/cms/our-headquarters')) ? 'active' : '' }}">
                        <a href="{{ route('cms.our-headquarters.show') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Our Headquarter
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Cms.event'))
                    <li class="{{ (request()->is('backoffice/cms/event-promotions')) ? 'active' : '' }}">
                        <a href="{{ route('cms.event-promotions.show') }}">
                            <i class="fa fa-angle-double-right"></i>
                        Event Promotion
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Cms.testimonial'))
                    <li class="{{ (request()->is('backoffice/cms/testimonials')) ? 'active' : '' }}">
                        <a href="{{ route('cms.testimonials.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Testimonial
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Cms.about_us'))
                    <li class="{{ (request()->is('backoffice/cms/about-us')) ? 'active' : '' }}">
                        <a href="{{ route('cms.about-us.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            About Us
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if(\Auth::guard('admin')->user()->hasPermission('Admin_management'))
        <li class="{{ (request()->segment(2))=='admin-management' ? 'active' : '' }}">
            <a href="">
                <i class="fa fa-cogs" style="color: #6CC66C"  data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                <span class="title">Admin Management</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(\Auth::guard('admin')->user()->hasPermission('Admin_management.permssions'))
                    <li class="{{ (request()->is('backoffice/admin-management/permissions')) ? 'active' : '' }}">
                        <a href="{{ route('admin-management.permissions') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Permissions
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Admin_management.roles'))
                    <li class="{{ (request()->is('backoffice/admin-management/roles')) ? 'active' : '' }}">
                        <a href="{{ route('admin-management.roles.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Roles
                        </a>
                    </li>
                @endif
                @if(\Auth::guard('admin')->user()->hasPermission('Admin_management.user_company'))
                    <li class="{{ (request()->is('backoffice/admin-management/users')) ? 'active' : '' }}"">
                        <a href="{{ route('admin-management.users.index') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Users Company
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @include('admin/layouts/menu')
</ul>
