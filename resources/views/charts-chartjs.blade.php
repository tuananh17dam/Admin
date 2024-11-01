@extends('layouts.master')

@section('title') @lang('translation.Chartjs') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Charts @endslot
@slot('title') Chartjs @endslot
@endcomponent

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Line Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="lineChart" class="chartjs-chart" data-colors='["rgba(81, 86, 190, 0.2)", "#5156be", "rgba(235, 239, 242, 0.2)", "#ebeff2"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Bar Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="bar" class="chartjs-chart" data-colors='["rgba(41, 181, 125, 0.8)", "rgba(41, 181, 125, 0.9)"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Pie Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="pieChart"  class="chartjs-chart" data-colors='["#2ab57d", "#ebeff2"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Donut Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="doughnut"  class="chartjs-chart" data-colors='["#5156be", "#ebeff2"]'></canvas>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Polar Chart</h4>
            </div>
            <div class="card-body">

                <canvas id="polarArea" class="chartjs-chart" data-colors='["#fd625e", "#2ab57d", "#ffbf53", "#5156be"]'> </canvas>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Radar Chart</h4>
            </div>
            <div class="card-body">
                <canvas id="radar" class="chartjs-chart" data-colors='["rgba(42, 181, 125, 0.2)", "#2ab57d", "rgba(81, 86, 190, 0.2)", "#5156be"]'></canvas>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection

@section('script')
<!-- Chart JS -->
<script src="{{ URL::asset('build/libs/chart.js/chart.umd.js') }}"></script>
<!-- chartjs init -->
<script src="{{ URL::asset('build/js/pages/chartjs.init.js') }}"></script>

@endsection
