<!-- resources/views/signup-modal.blade.php -->

<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                   
                </button>
            </div>
            <div class="modal-body">
                <!-- <form method="POST" action="#"> -->
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="user_email" id="user_email" class="form-control" >
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" >
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="user_password_confirmation" id="user_password_confirmation" class="form-control" >
                    </div>

                    <div class="form-group signupPopupBtn">
                        <button  class="btn btn-primary" id="signUpBtn">Sign Up</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                    </div>

                    <div class="form-group donthaveaccount">
                     
                            
                    Already have an account?   &nbsp; <a href="#" class="donthaveaccount" data-bs-toggle="modal" data-bs-target="#loginModal">  Sign in </a>  
                          
                       
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
