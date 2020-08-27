@extends('layouts.admin')
@section('content')
<style>
    .full-circle {
        background-color:#72a555;
        height:100px;
        width:100px;
        -webkit-border-radius:50px;
        -moz-border-radius:50px;
        text-align:center;
        line-height: 100px;
        font-size:3em;
        color:#fff;
        margin-left:35px;
    }
    .warning {
        background-color: #ffae19;
    }

    .error {
        background-color: #ff2500;
    }

    a, a:hover {
        text-decoration: none;
        color: #fff;
    }

 

</style>
<div class="content">
    <div class="row">
        <div class="col-lg-2" STYLE='text-align:center;'>
            <p>Active Website<br>Screenshots</p>
            <p class="full-circle">
                <a href="{{ route('screenshots.config.index') }}">{{ $screenshot->activeScreenshots }}</a>
            </p>
        </div>
        <div class="col-lg-2" STYLE='text-align:center;'>
            <p><br>Daily Screenshots</p>
            <p class="full-circle">
                <a href="">{{ $screenshot->dailyScreenshots }}</a>
            </p>
        </div>
        <div class="col-lg-2" STYLE='text-align:center;'>
            <p><br>Unusual Events</p>
            <p class="full-circle warning">
                <a href="">0</a>
            </p>
        </div>
        <div class="col-lg-2" STYLE='text-align:center;'>
            <p><br>Console Errors</p>
            <p class="full-circle error">
                <a href="{{ route('screenshots.errors.index') }}">{{ $screenshot->dailyConsoleErrors }}</a>
            </p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection