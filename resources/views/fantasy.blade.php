@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Fantasy</h1>
        <h1 class="pull-right">
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="permissions-table">
                        <thead>
                        <tr>
                            <th>Position</th>
                            <th>Entry</th>
                            <th>Name</th>
                            <th>Pts</th>
                            <th>Captain</th>
                            <th>Vice-captain</th>
                            <th>Active Chip</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entrys as $key=>$entry)
                            @foreach($entry as $player)
                            <tr>
                                <td>{{ $player['position'] }}</td>
                                <td>{{ $player['entry']  }}</td>
                                <td>{{ $player['web_name'] }}</td>
                                <td>{{ $player['pts'] }}</td>
                                <td>{{ $player['captain'] }}</td>
                                <td>{{ $player['vice_captain'] }}</td>
                                <td>{{ $player['active_chip'] }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

