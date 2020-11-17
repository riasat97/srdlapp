<!DOCTYPE html>
<html>
<head>
    <title>Generate Pdf</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        {{--@font-face {--}}
        {{--    font-family: "Nikosh";--}}
        {{--    font-style: normal;--}}
        {{--    font-weight: normal;--}}
        {{--    src: url('{{asset("fonts/Nikosh.ttf")}}') format('truetype');--}}
        {{--}--}}
        body {
            font-family: 'bangla', sans-serif;
        }
        /*body {*/
        /*    font-family: DejaVu Sans;*/
        /*}*/
    </style>
</head>
<body>
<h1 >{{ $heading }}</h1>
<div>
    <p style="font-family: bangla, DejaVu Sans, sans-serif;">{{$content}}</p>

</div>
</body>
</html>
