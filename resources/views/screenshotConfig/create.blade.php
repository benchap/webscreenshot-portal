@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Screenshot <!--{{ trans('global.product.title_singular') }}-->
    </div>

    <div class="card-body">
        <form action="{{ route("screenshots.config.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                <label for="name">
                    <!--{{ trans('global.product.fields.name') }}*'-->
                    URL
                </label>
                <input type="text" id="url" name="url" class="form-control" value="">
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('schedule') ? 'has-error' : '' }}">
                <label for="description">
                    <!--{{ trans('global.product.fields.description') }}-->
                    Schedule
                </label>
                <select id='schedule' name='schedule'>
                    <option value='hourly'>Hourly</option>
                    <option value='daily'>Daily</option>
                </select>
            </div>
            <div><input class="btn btn-danger" type="submit" value="Save without Alert"></div>
            

            <div>
               
            </div>
            
            <h5 STYLE='margin-top:40px;'>Alerts (optional)</h5>
            <div class="form-group {{ $errors->has('schedule') ? 'has-error' : '' }}">
                <label for="alertType">
                    Alert Type  
                </label>
                <select id='alertType' name='alertType'>
                    <option value='email'>Email</option>
                </select> 
            </div>
            <div class="form-group {{ $errors->has('schedule') ? 'has-error' : '' }}">
                <label for="emailAddress">
                    Email Address
                </label>
                <input type="text" id="emailAddress" name="emailAddress" class="form-control" value="">
            </div>


            <div class="form-group {{ $errors->has('schedule') ? 'has-error' : '' }}">
                <label for="type">
                    when HTTP response
                </label>
                <select id='operation' name='operation'>
                    <option value='notequals'>Not Equals</option>
                    <option value='equal'>Equals</option>
                </select> 
            </div>

            <div class="form-group {{ $errors->has('schedule') ? 'has-error' : '' }}">
                <label for="type">
                    Http Response Code (comma separate multiple http codes)
                </label>
                <input type="text" id="respCode" name="respCode" class="form-control" value="" placeholder='200'>
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>


@endsection