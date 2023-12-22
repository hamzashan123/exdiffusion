<div class="modal fade" id="uploadVae"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Upload Vae Models</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#"  enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="vae_webhook">Webhook<span class="required">*</span></label>
                        <input type="text" name="vae_webhook" id="model_webhook" value="https://stablediffusionapi.com" disabled readonly class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="vae_id">Vae ID<span class="required">*</span></label>
                        <input type="text" name="vae_id" id="vae_id" class="form-control" required>
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="vae_url">Vae Url<span class="required">*</span></label>
                        <input type="text" name="vae_url" id="vae_url" class="form-control" required>
                    </div>

                    

                     <div class="form-group">
                        <label for="model_type">Vae Type<span class="required">*</span></label>
                        <select name="model_type" id="model_type" class="form-control" >
                                <option value="diffusers">diffusers</option>
                        </select>
                    </div>
                
                    <div class="form-group upload-model-btn-div">
                        <button  class="btn btn-primary" id="uploadVaeModelBtn">Upload Vae Model</button>
                    </div>
                    <p id="uploadvaeErros"></p>
                </form>
            </div>
        </div>
    </div>
  </div>