<!-- resources/views/login-modal.blade.php -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <!-- <form method="POST" action="#"> -->
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                    </div>

                    <div class="form-group forgetPassdiv">
                        <div class="form-check">
                            
                          <a href="#" class="forgetPassword" data-bs-toggle="modal" data-bs-target="#forgetPasswordModal"> Forget Password?</a> 
                        </div>
                    </div>

                    <div class="form-group signinPopupBtn">
                        <button  class="btn btn-primary">Sign in</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
