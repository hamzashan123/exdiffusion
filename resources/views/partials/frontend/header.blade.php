
<header class="header" style="display: none;">
   
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="{{route('index')}}" class="logoAnchor">
          <img src="{{asset('img/logo.png')}}" class="HeaderLogo">
        </a>

        
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          @if(Auth::user()) 
          <li><a href="#" class="nav-link px-3 text-light-grey">Home</a></li>
          <li><a href="{{route('home')}}" class="nav-link px-3 text-light-grey">Playground</a></li>
          @endif
          <li><a href="{{route('publishcreation')}}" class="nav-link px-3 text-light-grey">Published Creations</a></li>
          @if(Auth::user())
          <li><a href="{{route('myasset')}}" class="nav-link px-3 text-light-grey">My Assets</a></li>
          <li><a href="#" class="nav-link px-3 text-light-grey" id="openUploadModal" data-bs-toggle="modal" data-bs-target="#uploadModels">Upload Models</a></li>
          <li><a href="#" class="nav-link px-3 text-light-grey" id="openUploadVaeModal" data-bs-toggle="modal" data-bs-target="#uploadVae">Upload Vae</a></li>
          <li><a href="#" class="nav-link px-3 text-light-grey" data-bs-toggle="modal" data-bs-target="#invitationUser" >Invitation Request</a></li>
          <li><a href="#" class="nav-link px-3 text-light-grey" id="restart_server">Restart Server</a></li>
          @endif
          @if(Auth::user())
          <li class="logoutNav"><form action="{{ route('logout') }}" method="POST" class="nav-link px-3 text-light-grey">
                @csrf
                <button type="submit"> Logout</button>
            </form>
          </li>
          @endif
          <!-- <li><a href="#" class="nav-link px-3 text-light-grey signInBtn" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a></li> -->
          <!-- <li><a href="#" class="nav-link px-3 text-light-grey signUpBtn" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a></li> -->
        </ul>
        
        
      </div>
  
  </header>
  