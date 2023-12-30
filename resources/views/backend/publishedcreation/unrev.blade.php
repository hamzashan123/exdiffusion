@extends('layouts.admin')
@section('content')
<!-- Page Heading -->

<style>
    .adminPublishMain {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #1f2937;
        border-bottom: 1px solid #e3e6f0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }

    .adminPublishMain .row {
        align-items: center;
    }

    .adminPublishMain input {
        height: auto;
    }

    .adminPublishMain .form-group {
        margin-bottom: 0px;
    }

    .adminPublishMain button#adminPublishSearch {
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }

    .adminPublishMainBody {
        padding: 40px;

        background: white;
        box-shadow: 0 3px 10px rgb(0 0 0 / 2%);
    }

    .adminPublishMainBodyInner .model_name {
        display: block;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        color: black;
    }

    .content_body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }


    .content_body .input-group {
        display: block;
        text-align: center;
        margin-top: 5px;
    }

    .content_body .input-group input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 6px;
        accent-color: #a157dc;
    }

    .content_body .input-group span {
        font-weight: 700;
        color: black;
    }

    .content_body button.btn.btn-secondary {
        display: block;
        width: 100%;
        padding: 5px 10px;
        font-weight: 500;
        font-size: 13px;
        border-radius: 7px !important;
        margin-top: 10px;
        background-color: #444f5e !important;
        border-color: #444f5e !important;
    }

    .content_body button.btn.btn-primary {
        display: block;
        width: 100%;
        padding: 5px 10px;
        font-weight: 500;
        font-size: 13px;
        border-radius: 7px !important;
        margin-top: 10px;
    }

    .adminPublishMainBodyInner {
        padding: 8px;
        background: #1f2937;
        border-radius: 7px;
        margin: 10px 0px;
    }

    .adminPublishMainBodyInner img {
        height: 220px !important;
        object-fit: cover;
        width: 100%;
    }
</style>

<div class="adminPublishMain">
    <div class="row">
        <div class="col-8">
            <h5 class="m-0 font-weight-bold text-white">
                Published Images ( Unreviewed )
            </h5>
        </div>
        <div class="col-4">
            <div class="form-group input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Search here" value="{{ old('keyword'), request()->input('keyword') }}">
                <button class="adminPublishSearch btn btn-primary" id="adminPublishSearch"> Search </button>
            </div>
        </div>


    </div>


</div>

<div class="adminPublishMainBody" id="adminPublishMainBody">
    <div class="row">



        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/31-6572926570d1c.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-658a76204aad0.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/1-6589b503c069f.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-658b984105756.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-657a9818aa037.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/1-6589a95b50f07.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/31-6572926570d1c.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-658a76204aad0.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/1-6589b503c069f.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-658b984105756.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-657a9818aa037.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/1-6589a95b50f07.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/31-6572926570d1c.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-658a76204aad0.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/1-6589b503c069f.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-658b984105756.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/27-657a9818aa037.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
            <div class="adminPublishMainBodyInner">
                <img src="https://exdiffusion.com/newproject/public/storage/images/creativehistory/1-6589a95b50f07.png" alt="No image" class="img-fluid mb-3">
                <div class="content_body">
                    <span class="model_name text-white"> meinamixv11</span>
                    <div class="input-group">
                        <input checked type="checkbox" class="adminPublishMain_is_nsfw" name="adminPublishMain_is_nsfw" id="adminPublishMain_is_nsfw" /> <span class="text-white"> nsfw </span>
                    </div>
                    <button class="btn btn-primary"> Approve </button>
                    <button class="btn btn-secondary"> Decline </button>
                </div>

            </div>
        </div>


    </div>

</div>







@endsection