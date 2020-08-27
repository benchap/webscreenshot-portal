@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.screenshot.showConfig') }}
    </div>

    <div class="card-body">

        <p>
            <a class="btn btn-success" href="/screenshots/create">
                    Add Screenshot
            </a>
        </p>
            
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>URL</th>
                <th>Schedule</th>
                <th>Status</th>
                <th>Last Event</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($screenshots as $screenshot)
                <tr>
                    <td>
                        <a href='/screenshots/{{ $screenshot->id }}'>{{ $screenshot->url }}</a>
                    </td>
                    <td>
                        {{ $screenshot->schedule }}
                    </td>
                    <td>
                        {{ $screenshot->status }}
                    </td>
                    <td>
                        @if($screenshot->lastEventDate)
                            {{ $screenshot->minutesAgo }} min ago
                        @else   
                            none
                        @endif
                    </td>
                    <td>
                        @if($screenshot->status=='active')
                            <a href='/screenshots/{{ $screenshot->id }}/pause'><img src='/images/pause.svg' width='20'></a>
                        @elseif($screenshot->status=='paused')
                            <a href='/screenshots/{{ $screenshot->id }}/play'><img src='/images/play.svg' width='20'></a>
                        @endif
                        <a href='/screenshots/{{ $screenshot->id }}/delete'><img src='/images/delete.svg' width='20'></a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection