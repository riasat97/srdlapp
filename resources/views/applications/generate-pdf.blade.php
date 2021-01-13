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
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">অক্ষাংশ</th>
            <th scope="col">দ্রাঘিমাংশ</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>

    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>

