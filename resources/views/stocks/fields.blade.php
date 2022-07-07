<!-- Contract Field -->
{{--<div class="form-group">
    {!! Form::label('contract', 'Contract:') !!}
   --}}{{-- {!! Form::radio('contract', 1,false, ['class' => 'form-control']) !!}
    {!! Form::radio('contract', 0,false, ['class' => 'form-control']) !!}--}}{{--
    <input type="radio" value="1"  name="contract"
        @if(!empty($lab->stock)) {{$lab->stock == 1 ? 'checked' : ''}} @endif  >

    <input type="radio" value="0"  name="contract"
    @if(!empty($lab->stock)) {{$lab->stock == 0 ? 'checked' : ''}} @endif  >

</div>--}}

{{--<form action="/store-absence" method="POST">--}}
<div class="table-responsive">
    <table class="table table-hover">
        {{ csrf_field() }}
        <thead>
        @if($lab->lab_type!="sof")
        <tr role="row">
            <th>IT Equipments: SRDL</th>
            <th>Received</th>
            <th>Not Received/ Problematic</th>
        </tr>
        @endif
        </thead>
        <tbody>
        @if( in_array($lab->lab_type,['srdl','srdl_sof']))
            <tr>
                <td class="lb">Contract:</td>
                <td> <input type="radio" value="1"  name="contract"
                   {{$lab->stock->contract == 1 ? 'checked' : ''}}  >
                </td>
                <td>
                    <input type="radio" value="0"  name="contract"
                    {{$lab->stock->contract == 0 ? 'checked' : ''}}  >
                </td>
            </tr>
            <tr>
                <td class="lb">Lab Renovation & Interior Design:</td>
                <td> <input type="radio" value="1"  name="renovation"
                    {{$lab->stock->renovation == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="renovation"
                    {{$lab->stock->renovation  == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Laptop:</td>
                <td> <input type="radio" value="1"  name="laptop"
                   {{$lab->stock->laptop == 1 ? 'checked' : ''}}  >
                </td>
                <td>
                    <input type="radio" value="0"  name="laptop"
                   {{$lab->stock->laptop == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Printer:</td>
                <td> <input type="radio" value="1"  name="printer"
                        {{$lab->stock->printer == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="printer"
                        {{$lab->stock->printer == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Scanner:</td>
                <td> <input type="radio" value="1"  name="scanner"
                  {{$lab->stock->scanner == 1 ? 'checked' : ''}}  >
                </td>
                <td>
                    <input type="radio" value="0"  name="scanner"
                    {{$lab->stock->scanner == 0 ? 'checked' : ''}} >
                </td>
            </tr>
            <tr>
                <td class="lb">Router:</td>
                <td> <input type="radio" value="1"  name="router"
                   {{$lab->stock->router == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="router"
                  {{$lab->stock->router == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Network Switch:</td>
                <td> <input type="radio" value="1"  name="network_switch"
                     {{$lab->stock->network_switch == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="network_switch"
                    {{$lab->stock->network_switch == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Led Smart TV:</td>
                <td> <input type="radio" value="1"  name="led_tv"
                   {{$lab->stock->led_tv == 1 ? 'checked' : ''}}  >
                </td>
                <td>
                    <input type="radio" value="0"  name="led_tv"
                     {{$lab->stock->led_tv == 0 ? 'checked' : ''}} >
                </td>
            </tr>
            <tr>
                <td class="lb">Web Camera:</td>
                <td> <input type="radio" value="1"  name="webcam"
                    {{$lab->stock->webcam == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="webcam"
                   {{$lab->stock->webcam == 0 ? 'checked' : ''}} >
                </td>
            </tr>
            <tr>
                <td class="lb">Networking & LAN Connection:</td>
                <td> <input type="radio" value="1"  name="networking"
                   {{$lab->stock->networking == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="networking"
                    {{$lab->stock->networking == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Furniture:</td>
                <td> <input type="radio" value="1"  name="furniture"
                   {{$lab->stock->furniture == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="furniture"
                    {{$lab->stock->furniture == 0 ? 'checked' : ''}}  >
                </td>
            </tr>
            @endif
            @if(in_array($lab->lab_type,['sof','srdl_sof']))
            <tr>
                <td class="lb"><b>IT Equipments: SOF</b></td>
                <td><b>Received</b></td>
                <td><b>Not Received/ Problematic</b></td>
            </tr>
                <tr>
                    <td class="lb">SoF Contract:</td>
                    <td> <input type="radio" value="1"  name="sof_contract"
                        {{$lab->stock->sof_contract == 1 ? 'checked' : ''}}   >
                    </td>
                    <td>
                        <input type="radio" value="0"  name="sof_contract"
                        {{$lab->stock->sof_contract == 0 ? 'checked' : ''}}   >
                    </td>
                </tr>
            <tr>
                <td class="lb">Smart Board:</td>
                <td> <input type="radio" value="1"  name="smart_board"
                    {{$lab->stock->smart_board == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="smart_board"
                    {{$lab->stock->smart_board == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Desktop:</td>
                <td> <input type="radio" value="1"  name="desktop"
                    {{$lab->stock->desktop == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="desktop"
                    {{$lab->stock->desktop == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Industrial Router:</td>
                <td> <input type="radio" value="1"  name="industrial_router"
                   {{$lab->stock->industrial_router == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="industrial_router"
                  {{$lab->stock->industrial_router == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Attendance Reader:</td>
                <td> <input type="radio" value="1"  name="attendance_reader"
                  {{$lab->stock->attendance_reader == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="attendance_reader"
                {{$lab->stock->attendance_reader == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            <tr>
                <td class="lb">Digital ID Card:</td>
                <td> <input type="radio" value="1"  name="digital_id_card"
                    {{$lab->stock->digital_id_card == 1 ? 'checked' : ''}}   >
                </td>
                <td>
                    <input type="radio" value="0"  name="digital_id_card"
                  {{$lab->stock->digital_id_card == 0 ? 'checked' : ''}}   >
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('labs.stocks.index') }}" class="btn btn-default">Cancel</a>
</div>

{{--

    <button type="submit" class="btn btn-block btn-primary btn-lg">
        Submit
    </button>
--}}
{{--

<!-- Renovation Field -->
<div class="form-group">
    {!! Form::label('renovation', 'Lab Renovation & Interior Design:') !!}
    <p>{{ $stock->renovation }}</p>
</div>

<!-- Laptop Field -->
<div class="form-group">
    {!! Form::label('laptop', 'Laptops:') !!}
    <p>{{ $stock->laptop }}</p>
</div>

<!-- Printer Field -->
<div class="form-group">
    {!! Form::label('printer', 'Printer:') !!}
    <p>{{ $stock->printer }}</p>
</div>

<!-- Scanner Field -->
<div class="form-group">
    {!! Form::label('scanner', 'Scanner:') !!}
    <p>{{ $stock->scanner }}</p>
</div>

<!-- Router Field -->
<div class="form-group">
    {!! Form::label('router', 'Router:') !!}
    <p>{{ $stock->router }}</p>
</div>

<!-- Network Field -->
<div class="form-group">
    {!! Form::label('network_switch', 'Network Switch:') !!}
    <p>{{ $stock->network_switch }}</p>
</div>

<!-- Led Field -->
<div class="form-group">
    {!! Form::label('led_tv', 'Led Smart TV:') !!}
    <p>{{ $stock->led_tv }}</p>
</div>

<!-- Web Field -->
<div class="form-group">
    {!! Form::label('webcam', 'Web Camera:') !!}
    <p>{{ $stock->webcam }}</p>
</div>

<!-- Networking Field -->
<div class="form-group">
    {!! Form::label('networking', 'Networking & LAN Connection:') !!}
    <p>{{ $stock->networking }}</p>
</div>

<!-- Furniture Field -->
<div class="form-group">
    {!! Form::label('furniture', 'Furniture:') !!}
    <p>{{ $stock->furniture }}</p>
</div>

<!-- Smart Field -->
<div class="form-group">
    {!! Form::label('smart_board', 'Smart Board:') !!}
    <p>{{ $stock->smart_board }}</p>
</div>

<!-- Desktop Field -->
<div class="form-group">
    {!! Form::label('desktop', 'Desktops:') !!}
    <p>{{ $stock->desktop }}</p>
</div>

<!-- Industrial Field -->
<div class="form-group">
    {!! Form::label('industrial_router', 'Industrial Router:') !!}
    <p>{{ $stock->industrial_router }}</p>
</div>

<!-- Attendance Field -->
<div class="form-group">
    {!! Form::label('attendance_reader', 'Attendance Reader:') !!}
    <p>{{ $stock->attendance_reader }}</p>
</div>

<!-- Digital Field -->
<div class="form-group">
    {!! Form::label('digital_id_card', 'Digital ID Card:') !!}
    <p>{{ $stock->digital_id_card }}</p>
</div>
--}}


