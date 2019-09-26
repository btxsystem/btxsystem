<ul id="menu" class="page-sidebar-menu">
    <li >

    <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard" style="color: #6CC66C"  data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Dashboard </span>
        </a>
    </li>

        <li >
            <a href="#">
                <i class="fa fa-book" style="color: #6CC66C" data-name="notebook" data-size="18" data-c="#bdecb6" data-hc="#bdecb6" data-loop="true"></i>
                <span class="title">Ebooks</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li >
                    <a href="{{ route('ebook.index') }}">
                        <i class="fa fa-reorder"></i>
                        Ebook List
                    </a>
                </li>
                <li >
                    <a href="{{ route('ebook.create') }}">
                        <i class="fa fa-plus"></i>
                        Create New Ebook
                    </a>
                </li>

            </ul>
        </li>

        <li >
            <a href="#">
                <i class="fa fa-user" style="color: #6CC66C" data-name="users" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2" data-loop="true"></i>
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
            <i class="fa fa-users" style="color: #6CC66C" data-name="customer" data-size="18" data-c="#bdecb6" data-hc="#bdecb6"
               data-loop="true"></i>
                Customers
        </a>
    </li>
    <li>
        <a href="{{ route('new.tree.index') }}">
            <i class="fa fa-sitemap" style="color: #6CC66C" data-name="share" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            Tree
        </a>
    </li>
    <li>
        <a href="{{ route('transfer-confirmation.index') }}">
            <i class="fa fa-check-square" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            Transfer Confirmation
        </a>
    </li>
    <li>
            <a href="{{ route('reward-claims.index') }}">
                <i class="fa fa-check-square" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                Rewards Claim
            </a>
    <li>
    <!-- <li>
        <a href="{{ route('withdrawal-bonus.index') }}">
            <i class="fa fa-check-square" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
                data-loop="true"></i>
                Withdrawal Bonus
        </a>
    <li> -->
        <a href="#">
            <i class="fa fa-credit-card" style="color: #6CC66C" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Withdrawal</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('withdrawal-bonus.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Withdrawal Claim
                </a>
            </li>
            <li>
                <a href="{{ route('withdrawal-bonus.paidindex') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Withdrawal Paid
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-street-view" style="color: #6CC66C" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
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
            <i class="fa fa-money" style="color: #6CC66C" data-name="money" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
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
                    Bitrex Value
                </a>
            </li>
        </ul>
    </li>
    <li >
        <a href="#">
            <i class="fa fa-gift" style="color: #6CC66C" data-name="gift" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Bonus</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <!-- <li>
                <a href="{{ route('bonus.general') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Income
                </a>
            </li> -->
            <li>
                <a href="{{ route('bonus.sponsor') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Sponsor
                </a>
            </li>
            <li>
                <a href="{{ route('bonus.pairing') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Pairing
                </a>
            </li>
            <li>
                <a href="{{ route('bonus.profit') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Profit
                </a>
            </li>
            <li>
                <a href="{{ route('bonus.reward') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Reward
                </a>
            </li>
        </ul>
    </li>
    <li >
        <a href="#">
            <i class="fa fa-newspaper-o" style="color: #6CC66C"  data-name="map" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Report</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('report.transaction-member') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Transaction Member
                </a>
            </li>
            <li>
                <a href="{{ route('report.membership') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Membership
                </a>
            </li>
        </ul>
    </li>
    <li >
        <a href="#">
            <i class="fa fa-rss" style="color: #6CC66C"  data-name="grid" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">CMS</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ route('cms.our-products.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Our Products
                </a>
            </li>
            <li>
                <a href="{{ route('cms.our-headquarters.show') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Our Headquarter
                </a>
            </li>
            <li>
                <a href="{{ route('cms.event-promotions.show') }}">
                    <i class="fa fa-angle-double-right"></i>
                   Event Promotion
                </a>
            </li>
            <li>
                <a href="{{ route('cms.testimonials.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Testimonial
                </a>
            </li>
            <li>
                <a href="{{ route('cms.about-us.index') }}">
                    <i class="fa fa-angle-double-right"></i>
                    About Us
                </a>
            </li>
        </ul>
    </li>
    <li >
        <a href="">
            <i class="fa fa-cogs" style="color: #6CC66C"  data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
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
    @include('admin/layouts/menu')
</ul>