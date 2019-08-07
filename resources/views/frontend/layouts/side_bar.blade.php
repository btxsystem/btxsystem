<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info" style="background:#55ACEE;">
        <div class="image">
            <img src="assets/images/xs/avatar1.jpg" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown">{{isset($profile->username) ? $profile->username : $profile['username'] }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                <ul class="dropdown-menu slideUp">
                    <li><a href="{{route('member.profile.index')}}"><i class="material-icons">person</i>Profile</a></li>
                    <li><a href="/logout"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
            <div class="email">{{isset($profile->email) ? $profile->email : $profile['email'] }}</div>
        </div>
    </div>
    <!-- #User Info --> 
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">Menu</li>
            <li> <a href="{{route('member.dashboard')}}"><i class="zmdi zmdi-view-dashboard"></i><span>Dashboard</span> </a> </li>
            <li><a href="mail-inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span> </a></li>
            <li><a href="blog-dashboard.html"><i class="zmdi zmdi-blogger"></i><span>Blogger</span> </a></li>          
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Forms</span> </a>
                <ul class="ml-menu">
                    <li><a href="basic-form-elements.html">Basic Form Elements</a> </li>
                    <li><a href="advanced-form-elements.html">Advanced Form Elements</a> </li>
                    <li><a href="form-examples.html">Form Examples</a> </li>
                    <li><a href="form-validation.html">Form Validation</a> </li>
                    <li><a href="form-wizard.html">Form Wizard</a> </li>
                    <li><a href="form-editors.html">Editors</a> </li>
                    <li><a href="form-upload.html">File Upload</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- #Menu --> 
</aside>    
