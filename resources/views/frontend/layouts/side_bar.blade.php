<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('member.profile.reset-password')}}" method="POST">
                {{ method_field('post') }}
                @csrf
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="old_password" id="old_password" type="password" min="5">
                        <label class="form-label">Old Password</label>
                    </div>
                    <div style="color:red" id="message_old_password">

                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="new_password" id="new_password" type="password" min="5">
                        <label class="form-label">New Password</label>
                    </div>
                    <div style="color:red" id="message_new_password">

                    </div>
                </div>
                <div class="form-group form-float col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-line">
                        <input class="form-control" name="confirm_new_password" id="confirm_new_password" type="password" min="5">
                        <label class="form-label">Confirm New Password</label>
                    </div>
                    <div style="color:red" id="message_confirm_new_password">

                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary" id="submit" disabled value="Change Password">
                </div>
            </form>
        </div>
    </div>
</div>

<aside id="leftsidebar" class="sidebar">
    <div class="user-info" style="background:#b92240;">
        <div class="image">
            <img src="{{isset($profile['src']) ? asset($profile['src']) : asset('/assetsebook/v2/img/logo-white.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" style="color:white">{{isset($profile->username) ? $profile->username : $profile['username'] }}</div>
            <div class="email" style="color:white">{{isset($profile->email) ? $profile->email : $profile['email'] }}</div>
        </div>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="header">Menu</li>
            <li class="{{ (request()->is('member')) ? 'active' : '' }}"> <a href="{{route('member.dashboard')}}"><i class="zmdi zmdi-view-dashboard col-red"></i><span>Dashboard</span> </a> </li>
            <li class="{{ (request()->is('member/tree')) ? 'active' : '' }}"> <a href="{{route('member.tree')}}"><i class="zmdi zmdi-device-hub col-blue"></i><span>Tree</span> </a> </li>
            <li class="{{ (request()->is('member/ebook')) ? 'active' : '' }}"> <a href="{{ route('member.ebook.index') }}"><i class="zmdi zmdi-book col-red"></i><span>Ebook</span> </a> </li>
            <li class="{{ (request()->is('member/reward')) ? 'active' : '' }}"> <a href="{{ route('member.reward') }}"><i class="zmdi zmdi-star-half col-blue"></i><span>My Rewards</span> </a> </li>
            <li class="{{ (request()->is('member/bonus')) ? 'active' : '' }}"> <a href="{{ route('member.bonus.index') }}"><i class="zmdi zmdi-ticket-star col-red"></i><span>My Bonus</span> </a> </li>
            <li class="{{ (request()->segment(2))=='income-and-expenses' ? 'active' : '' }}"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-money col-green"></i><span>Debit and Credit</span> </a>
                <ul class="ml-menu">
                    <li class="{{ (request()->is('member/income-and-expenses/bitrex-points')) ? 'active' : '' }}"><a href="{{route('member.bitrex-money.bitrex-points')}}">Bitrex Points</a> </li>
                    <li class="{{ (request()->is('member/income-and-expenses/bitrex-value')) ? 'active' : '' }}"><a href="{{route('member.bitrex-money.bitrex-cash')}}">Bitrex Value</a> </li>
                    <li class="{{ (request()->is('member/income-and-expenses/pv')) ? 'active' : '' }}"><a href="{{route('member.bitrex-money.pv')}}">Personal PV</a> </li>
                    <li class="{{ (request()->is('member/income-and-expenses/pv-pairing')) ? 'active' : '' }}"><a href="{{route('member.bitrex-money.pv-pairing')}}">PV Pairing</a> </li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2))=='transaction' ? 'active' : '' }}"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shopping-cart col-orange"></i><span>Transaction</span> </a>
                <ul class="ml-menu">
                    <li class="{{ (request()->is('member/transaction/my-transaction')) ? 'active' : '' }}"><a href="{{route('member.transaction.my-transaction')}}">My Transactions</a></li>
                    <li class="{{ (request()->is('member/transaction/prospected-member-transaction')) ? 'active' : '' }}"><a href="{{route('member.transaction.prospected-member-transaction')}}">Prospected Member Transactions</a></li>
                </ul>
            </li>
            <li class="{{ (request()->segment(2))=='team-report' ? 'active' : '' }}"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-group-work col-purple"></i><span>Team Report</span> </a>
                <ul class="ml-menu">
                    <li class="{{ (request()->is('member/team-report/my-sponsor')) ? 'active' : '' }}"><a href="{{route('member.team-report.my-sponsor')}}">My Sponsor</a></li>
                    <li class="{{ (request()->is('member/team-report/my-analizer')) ? 'active' : '' }}"><a href="{{route('member.team-report.my-analizer')}}">Team Analizer</a></li>
                    <!--<li class="{{ (request()->is('member/team-report/team-analizer')) ? 'active' : '' }}"><a href="{{route('member.team-report.team-analizer')}}">Team Analizer</a></li>-->
                </ul>
            </li>
            <li class="{{ (request()->is('member/prospected-member')) ? 'active' : '' }}"> <a href="{{ route('member.prospected-member') }}"><i class="zmdi zmdi-accounts col-purple"></i><span>Prospected Member</span> </a> </li>
            <li class="header">Profile</li>
            <li class="{{ (request()->is('member/profile')) ? 'active' : '' }}"> <a href="{{route('member.profile.index')}}"><i class="zmdi zmdi-account col-purple"></i><span>My Profile</span> </a> </li>
            <li> <a data-toggle="modal" data-target="#change-password"><i class="zmdi zmdi-key col-red"></i><span>Change Password</span> </a> </li>
        </ul>
    </div>
</aside>
