<div class="modal fade" id="invitationUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Please register on our waiting list for invitations via this form. We will be sending invitation emails sequentially to those who register.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <!-- <form method="POST" action="#" enctype="multipart/form-data"> -->
                    @csrf

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="invite_firstname">First Name</label>
                        <input type="text" name="invite_firstname" id="invite_firstname" class="form-control" >
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="invite_lastname">Last Name</label>
                        <input type="text" name="invite_lastname" id="invite_lastname" class="form-control" >
                    </div>

                     <!-- Email -->
                     <div class="form-group">
                        <label for="invite_email">Email</label>
                        <input type="text" name="invite_email" id="invite_email" class="form-control" >
                    </div>

                    <!-- Base Model Type -->
                    <div class="form-group">
                        <label for="invite_country">Country</label>
                        <select name="invite_country" id="invite_country" class="form-control" >
                            <option value="Usa">Usa</option>
                            <option value="Japan">Japan</option>
                        </select>
                    </div>

                    <!-- Model Kind -->
                    <div class="form-group">
                        <label for="invite_occupation">Occupation</label>
                        <select name="invite_occupation" id="invite_occupation" class="form-control" >
                            <option value="ABC">ABC</option>
                            <option value="XYZ">XYZ</option>
                            <option value="ABC">ABC</option>
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