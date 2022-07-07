<div class="table-responsive">
    <table class="table" id="stocks-table">
        <thead>
            <tr>
        <th>Institution</th>
        <th>Contract</th>
        <th>Renovation</th>
        <th>Networking</th>
        <th>Furniture</th>
        <th>Laptop</th>

        <th>Printer</th>
        <th>Scanner</th>
        <th>LedTv</th>

        <th>Router</th>
        <th>Network-Switch</th>
        <th>Web-Camera</th>

        <th>Smart-Board</th>
        <th>Desktop-Computer</th>
        <th>Industrial-Router</th>
        <th>Attendance-Reader</th>
        <th>DigitalID-Card</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
            <td></td>
            <td>{!! $stock->contract!!}</td>
            <td>{!! $stock->renovation!!}</td>
            <td>{!! $stock->networking!!}</td>
            <td>{!! $stock->furniture!!}</td>
            <td>{!! $stock->laptop!!}</td>
            <td>{!! $stock->printer!!}</td>
            <td>{!! $stock->scanner!!}</td>
            <td>{!! $stock->led_tv!!}</td>
            <td>{!! $stock->router!!}</td>
            <td>{!! $stock->network_switch!!}</td>
            <td>{!! $stock->webcam!!}</td>
            <td>{!! $stock->smart_board!!}</td>
            <td>{!! $stock->desktop!!}</td>
            <td>{!! $stock->industrial_router!!}</td>
            <td>{!! $stock->attendance_reader!!}</td>
            <td>{!! $stock->digital_id_card!!}</td>
                <td>
                    <div class='btn-group'>
                      {{--  <a href="{{ route('labs.stocks.show', [$stock->lab_id,$stock->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                        <a href="{{ route('labs.stocks.edit', [$stock->lab_id,$stock->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
