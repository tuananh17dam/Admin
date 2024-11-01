@extends('layouts.master')

@section('title') @lang('translation.Lightbox') @endsection

@section('css')

    <!-- glightbox css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}">

@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Extended @endslot
        @slot('title') Lightbox @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Single Image Lightbox</h5>
                    <p class="card-title-desc">Glightbox Single Image Lightbox Example</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="mt-4">
                                <a href="build/images/small/img-1.jpg" class="image-popup">
                                    <img src="build/images/small/img-1.jpg" class="img-fluid" alt="work-thumbnail">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="mt-4">
                                <a href="build/images/small/img-2.jpg" class="image-popup">
                                    <img src="build/images/small/img-2.jpg" class="img-fluid" alt="work-thumbnail">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Images with Description</h5>
                    <p class="card-title-desc">Glightbox Images with Description Example</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="mt-4">
                                <a href="build/images/small/img-4.jpg" class="image-popup-desc" data-title="Project 01"
                                    data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                    <img src="build/images/small/img-4.jpg" class="img-fluid" alt="work-thumbnail">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="mt-4">
                                <a href="build/images/small/img-5.jpg" class="image-popup-desc" data-title="Project 02"
                                    data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                    <img src="build/images/small/img-5.jpg" class="img-fluid" alt="work-thumbnail">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="mt-4">
                                <a href="build/images/small/img-1.jpg" class="image-popup-desc" data-title="Project 03"
                                    data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                    <img src="build/images/small/img-1.jpg" class="img-fluid" alt="work-thumbnail">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Popup with Video or Map</h5>
                    <p class="card-title-desc">Glightbox Popup with Video or Map Example</p>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3 flex">
                        <a href="https://www.youtube.com/watch?v=0O2aH4XLbto" class="btn btn-light image-popup-video-map"
                            data-title="YouTube Video" data-description="YouTube Video Popup">
                            Open YouTube Video
                        </a>

                        <a href="https://vimeo.com/45830194" class="btn btn-light image-popup-video-map"
                            data-title="Vimeo Video" data-description="Vimeo Video Popup">
                            Open Vimeo Video
                        </a>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')

    <!-- glightbox js -->
    <script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- lightbox init -->
    <script src="{{ URL::asset('build/js/pages/lightbox.init.js') }}"></script>

@endsection
