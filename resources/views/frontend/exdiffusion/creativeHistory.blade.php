@extends('layouts.app')
@section('content')
<div class="creativeHistoryMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 title">
            <img src="{{asset('img/icons/myasset.png')}}"> My Assets
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 navigation">

            <a href="#" class="active"> Creative History</a>
            <select name="" id="">
                <option value="">Favorite</option>
                <option value="">Images</option>
                <option value="">Base Models</option>
                <option value="">Lora Models</option>
                <option value="">Embedding Models</option>
            </select>
            <select name="" id="">
                <option value="">Custom Model</option>
                <option value="">Base Models</option>
                <option value="">Lora Models</option>
                <option value="">Embedding Models</option>
            </select>
            <a href="#"> Trained Model</a>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 filters">
            <div class="input-group">

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                    <select name="filterlist" id="filterlist" class="form-control dark-grey border-radius-7">
                        <option value="" selected></option>
                        <option value="">Add to Favorite</option>
                        <option value="">Delete</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7" id="apply_filters">Apply</button>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="masonry">
                <div class="grid">
                    <img src="https://source.unsplash.com/random/1">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">

                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/2">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">


                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/3">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/4">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/5">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/6">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/7">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/8">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/9">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/10">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/11">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/12">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/19">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/20">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/13">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/14">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/15">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/16">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/17">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <img src="https://source.unsplash.com/random/18">
                    <div class="grid__body">
                        <div class="relative">
                            <a class="grid__link" href="#"></a>
                            <input type="checkbox" name="">

                        </div>
                        <div class="mt-auto masonry-btn-generate ">
                            <button class="btn purple-col-bg form-control text-white border-radius-7">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>