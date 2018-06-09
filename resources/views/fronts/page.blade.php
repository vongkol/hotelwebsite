@extends('layouts.front')
@section('content')
    <div class="container-fluit">
        <h2 class="text-white title-page">
            <div class="container text-center">
                <b style="text-shadow:2px 3px 5px #fff;"> {{$page->title}}</b>
            </div>
        </h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                    <div class="page-by-cat back">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border-custom">
                                    <aside>{!!$page->description!!}</aside>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection