@extends('layouts.app')
<style>
        .masonry {
    columns: 7;
    column-gap: 16px;
    }

    @media (max-width: 1200px) {
    .masonry {
        columns: 4;
    }
    }

    @media (max-width: 992px) {
    .masonry {
        columns: 2;
    }
    }

    .masonry .grid {
    display: inline-block;
    margin-bottom: 16px;
    position: relative;
    }

    .masonry .grid:before {
    border-radius: 5px;
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, .2);
    }

    .masonry .grid img {
    width: 100%;
    border-radius: 5px;
    }

    .masonry .grid__title {
    font-size: 28px;
    font-weight: bold;
    margin: 0 0 10px 0;
    }

    .masonry .grid__author {
    font-size: 14px;
    font-weight: 300;
    }

    .masonry .grid__link {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    }

    .masonry .grid__body {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    padding: 30px 30px;
    color: #fff;
    display: flex;
    flex-direction: column;
    }

    .masonry .grid__tag {
    background-color: rgba(255, 255, 255, .8);
    color: #333;
    border-radius: 5px;
    padding: 5px 15px;
    margin-bottom: 5px;
    }

    .mt-auto {
    margin-top: auto;
    }

</style>
@section('content')
<div class="publishCreationMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 title"> 
            <img src="{{asset('img/icons/myasset.png')}}"> Published Creations
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 navigation">
               
                    <a href="#" class="active"> Images</a>
                    <a href="#"> Base Model</a>
                    <a href="#"> Lora</a>
                    <a href="#"> Embedding</a>
               
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 filters">
        <div class="input-group">

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                
            <select name="filterlist" id="filterlist" class="form-control dark-grey border-radius-7">
                    <option value="" selected></option>
                    <option value="">Add to Favorite</option>
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
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                    
                    <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/2">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                    
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/3">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/4">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/5">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/6">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/7">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/8">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/9">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/10">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/11">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/12">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/19">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/20">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/13">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div> <div class="grid">
                <img src="https://source.unsplash.com/random/14">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/15">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/16">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/17">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
                </div>
                </div>
            </div>
            <div class="grid">
                <img src="https://source.unsplash.com/random/18">
                <div class="grid__body">
                <div class="relative">
                    <a class="grid__link"  href="#" ></a>
                   <input type="checkbox" name="" >
                   
                </div>
                <div class="mt-auto" >
                <button class="btn purple-col-bg form-control text-white border-radius-7" >Generate</button>
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