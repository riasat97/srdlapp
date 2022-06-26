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
                            <th>Team Chunaa-{{$t1pt}}</th>
                            <th>T1</th>
                            <th></th>
                            <th>T2</th>
                            <th>Team Oppo-{{$t2pt}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($finalPlayers as $player)
                            @if($player['t1c']!=$player['t2c'])
                                <tr>
                                    <td>{{ $player['name']}}-{{$player['t1c']}}</td>
                                    <td>{{ $player['t1cwonBy'] }}</td>
                                    <td>-</td>
                                    <td>{{ $player['t2cwonBy'] }}</td>
                                    <td>{{ $player['name'] }}-{{$player['t2c']}}</td>
                                </tr>
                            @endif
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

