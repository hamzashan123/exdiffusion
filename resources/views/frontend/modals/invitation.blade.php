<div class="modal fade" id="invitationUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Please register on our waiting list for invitations via this form. We will be sending invitation emails sequentially to those who register.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <h5 id="invitationError" style="color:red"></h5>
            <div class="modal-body">
                <!-- <form method="POST" action="#" enctype="multipart/form-data"> -->
                    @csrf

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="invite_firstname">First Name</label>
                        <input type="text" name="invite_firstname" id="invite_firstname" class="form-control" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="invite_lastname">Last Name</label>
                        <input type="text" name="invite_lastname" id="invite_lastname" class="form-control" required>
                    </div>

                     <!-- Email -->
                     <div class="form-group">
                        <label for="invite_email">Email</label>
                        <input type="email" name="invite_email" id="invite_email" class="form-control" required>
                    </div>

                    <!-- Base Model Type -->
                    <div class="form-group">
                        <label for="invite_country">Country</label>
                        <select name="invite_country" id="invite_country" class="form-control" >
                            @include('frontend.pages.countries')
                        </select>
                    </div>

                    <!-- Model Kind -->
                    <div class="form-group">
                        <label for="invite_occupation">Occupation</label>
                        <select name="invite_occupation" id="invite_occupation" class="form-control" >
                            <option value="">Select Occupation</option>
                            <option value="Accounting & Finance">Accounting & Finance</option>
                            <option value="Arts & Design">Arts & Design</option>
                            <option value="Education & Training">Education & Training</option>
                            <option value="Engineering & Architecture">Engineering & Architecture</option>
                            <option value="Healthcare & Medical">Healthcare & Medical</option>
                            <option value="Human Resources">Human Resources</option>
                            <option value="IT & Software">IT & Software</option>
                            <option value="Legal">Legal</option>
                            <option value="Marketing & Sales">Marketing & Sales</option>
                            <option value="Media & Communication">Media & Communication</option>
                            <option value="Retail & Customer Service">Retail & Customer Service</option>
                            <option value="Science & Research">Science & Research</option>
                            <option value="Skilled Trades">Skilled Trades</option>
                            <option value="Transportation & Logistics">Transportation & Logistics</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                 
                   

                   
                
                    <div class="form-group invite-model-button-div">
                        <button  class="btn btn-primary" id="inviteSendBtn">Send</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
  </div>