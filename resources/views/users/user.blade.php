<!-- User Name Field -->
<div class="form-row">
    <div class="form-group col-sm-6">
        {!! Form::label('username', 'ইউজারনেম:') !!}
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Role -->
    <div class="form-group col-sm-6">
        {{Form::label('role', 'ভূমিকা নির্ধারণ:') }}
        {{Form::select('role', array('0' => 'নির্বাচন করুন','super admin' => 'সুপার অ্যাডমিন', 'district admin' => 'জেলা অ্যাডমিন','upazila admin'=>'উপজেলা অ্যাডমিন'), null,['class'=>'form-control', 'id'=>'designation'])}}
    </div>
</div>
<!-- User Name Field -->
<div class="form-row">
    <!-- Passcode Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', 'পাসওয়ার্ড:') !!}
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <!-- Passcode Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('confirm-password', 'কন্ফার্ম পাসওয়ার্ড:') !!}
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
    </div>
</div>
