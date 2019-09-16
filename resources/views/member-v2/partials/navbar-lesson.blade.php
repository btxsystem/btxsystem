<nav class=" navbar navbar-inverse" style="background-color:#ffb320;">
         <div class="container-fluid">
            <div class="navbar-header">
               <a class="navbar-brand" href="{{ url()->previous() }}">
               <button type="button" class="btn btn-transparent-border border text-white bit-btn1s d-none d-sm-block">
                  <img src="{{asset('assetsebook/assets/img/close-icon.png')}}"> CLOSE
               </button>
               <button type="button" class="btn btn-transparent-border bit-btn1 d-sm-none">
                  <img src="{{asset('assetsebook/assets/img/close-icon.png')}}">
               </button>
               </a>
            </div>
            <div class="col-md-5 col-7" style="padding: 0px;">
               <div class="progress d-none" id="percentage-wrapper" style="height:20px!important">
                  <div class="progress-bar bg-danger" id="percentage-bar" style="width:50%"></div>
               </div>
            </div>
            <ul class="nav navbar-nav navbar-right">
               <!-- <li>
                  <a href="#">
                  <button class="btn btn-sm btn-transparent d-none d-sm-block">
                     <img src="assets/img/flag.png" class="pr10"> REPORT
                  </button>
                  <button        <li>
                  <a href="#">
                  <button class="btn btn-sm btn-transparent d-none d-sm-block">
                     <img src="assets/img/flag.png" class="pr10"> REPORT
                  </button>
                  <button class="btn btn-sm btn-transparent d-sm-none">
                     <img src="assets/img/flag.png">
                  </button>
                  </a>
               </li> class="btn btn-sm btn-transparent d-sm-none">
                     <img src="assets/img/flag.png">
                  </button>
                  </a>
               </li>  -->
            </ul>
         </div>
      </nav>