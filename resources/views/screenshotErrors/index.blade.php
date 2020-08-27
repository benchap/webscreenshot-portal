@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.screenshotErrors.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>URL</th>
                <th>Image</th>
                <th>Header</th>
                <th>HTML Code</th>
                <th>Console</th>
                
            </tr>
            </thead>
            <tbody>
                @foreach ($screenshots as $screenshot)
                <tr>
                    <td>
                        {{ $screenshot->date_format }}
                    </td>
                    <td>{{ $screenshot->url }}</td>
                    <td align='center'>
                        @if($screenshot->image_path)
                        <a href='http://screenshots.webtools.network/{{ $screenshot->image_path }}'>
                            <img width='32' src='/images/icon-photo.png'>
                        </a>
                        @endif
                    </td>
                    <td  align='center'>
                        @if($screenshot->header_path)
                        <a href='http://screenshots.webtools.network/{{ $screenshot->header_path }}'>
                            <img width='32' src='/images/icon-header.png'>
                        </a>
                        @endif
                    </td>
                    <td  align='center'>
                        @if($screenshot->html_path)
                        <a href='http://screenshots.webtools.network/{{ $screenshot->html_path }}'>
                            <img width='32' src='/images/icon-code.png'>
                        </a>
                        @endif
                    </td>
                    <td  align='center'>
                        @if($screenshot->console_path)
                        <a href='http://screenshots.webtools.network/{{ $screenshot->console_path }}'>
                            <img width='32' src='/images/icon-console.png'>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection