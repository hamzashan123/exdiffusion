
<div class="modal fade" id="uploadModels"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Upload Models</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#"  enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="model_url">URL<span class="required">*</span></label>
                        <input type="text" name="model_url" id="model_url" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="model_id">Model ID<span class="required">*</span></label>
                        <input type="text" name="model_id" id="model_id" class="form-control" required>
                    </div>

                     <div class="form-group">
                        <label for="model_type">Model Type<span class="required">*</span></label>
                        <select name="model_type" id="model_type" class="form-control" >
                                <option value="huggingface">huggingface</option>
                                <option value="api_trained">api_trained</option>
                                <option value="custom_ckpt">custom_ckpt</option>
                                <option value="lora">lora</option>
                                <option value="embeddings">embeddings</option>
                                <option value="controlnet">controlnet</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="from_safetensors">From Safetensors<span class="required">*</span></label>
                        <select name="from_safetensors" id="from_safetensors" class="form-control" >
                                <option value="yes">yes</option>
                                <option value="no" selected>no</option>
                        </select>
                        <label >Set this to "yes" if you are loading a .safetensor file; otherwise pass "no".</label>
                    </div>

                    <div class="form-group">
                        <label for="model_webhook">Webhook<span class="required">*</span></label>
                        <input type="text" name="model_webhook" id="model_webhook" value="https://stablediffusionapi.com" disabled readonly class="form-control" required>
                    </div>


                    <div class="form-group">
                        <label for="model_revision">Revision<span class="required">*</span></label>
                        <select name="model_revision" id="model_revision" class="form-control" >
                                <option value="fp16">fp16</option>
                                <option value="fp32" selected>fp32</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="model_upcast_attention">Upcast Attention<span class="required">*</span></label>
                        <select name="model_upcast_attention" id="model_upcast_attention" class="form-control" >
                                <option value="yes">yes</option>
                                <option value="no" selected>no</option>
                        </select>
                        <label >Set this to "yes" only when you are loading a stable diffusion 2.1 model; otherwise keep it "no".</label>
                    </div>



                  
                
                    <div class="form-group upload-model-btn-div">
                        <button  class="btn btn-primary" id="uploadModelBtn">Upload Model</button>
                    </div>
                    <p id="uploadModelErros"></p>
                </form>
            </div>
        </div>
    </div>
  </div>