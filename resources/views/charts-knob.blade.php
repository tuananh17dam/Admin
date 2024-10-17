@extends('layouts.master')

@section('title') @lang('translation.Jquery_Knob') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Charts @endslot
        @slot('title') Jquery Knob @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Examples</h4>
                    <p class="card-title-desc">Nice, downward compatible, touchable, jQuery dial</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3">Disable display input</h5>
                                <input class="knob" data-width="150" data-fgcolor="#5156be" data-displayinput="false"
                                    value="35">
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3">Cursor mode</h5>
                                <input class="knob" data-width="150" data-cursor="true" data-fgcolor="#2ab57d" value="29">
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3">Display previous value</h5>
                                <input class="knob" data-width="150" data-min="-100" data-fgcolor="#4ba6ef"
                                    data-displayprevious="true" value="44">
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3">Angle offset</h5>
                                <input class="knob" data-width="150" data-angleoffset="90" data-linecap="round"
                                    data-fgcolor="#f1734f" value="35">
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3"> 5-digit values, step 1000</h5>
                                <input class="knob" data-width="150" data-min="-15000" data-displayprevious="true"
                                    data-max="15000" data-step="1000" value="-11000" data-fgcolor="#ffbf53">
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3">Angle offset and arc</h5>
                                <input class="knob" data-width="150" data-cursor="true" data-fgcolor="#fd625e" value="29">
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3">Readonly</h5>
                                <input class="knob" data-width="150" data-height="150" data-linecap=round
                                    data-fgColor="#f06292" value="80" data-skin="tron" data-angleOffset="180"
                                    data-readOnly=true data-thickness=".1" />
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="text-center" dir="ltr">
                                <h5 class="font-size-14 mb-3"> Angle offset and arc</h5>
                                <input class="knob" data-width="150" data-height="150" data-displayPrevious=true
                                    data-fgColor="#8d6e63" data-skin="tron" data-cursor=true value="75" data-thickness=".2"
                                    data-angleOffset=-125 data-angleArc=250 value="44" />
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('script')
    <!-- jquery-knob plugin  -->
    <script src="{{ URL::asset('build/libs/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- jquery-knob init -->
    <script src="{{ URL::asset('build/js/pages/jquery-knob.init.js') }}"></script>

@endsection
