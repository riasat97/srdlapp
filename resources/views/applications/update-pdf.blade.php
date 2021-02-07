<!DOCTYPE html>
<html>
<head>
    <title>Create Pdf</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        {{--@font-face {--}}
        {{--    font-family: "Nikosh";--}}
        {{--    font-style: normal;--}}
        {{--    font-weight: normal;--}}
        {{--    src: url('{{asset("fonts/Nikosh.ttf")}}') format('truetype');--}}
        {{--}--}}
        @page {
            header: page-header;
            footer: page-footer;
        }
        body {
            font-family: 'bangla', sans-serif;
        }

        .container {
            margin-top: 0px;
        }

        .main-content {
            /*margin-top: 10px;*/
            border: 1px solid #999;
            padding: 10px;
        }

        .heading {
            /*border-bottom: 1px solid #999;*/
            color: #fff;
            background-color: #08A753;
            border-color: #08A753;
        }

        .heading-text {
            text-align: center;
            margin: 0px;
            color: #fff;
            padding: 10px;
        }

        .block-heading {
            background: #C9DAED;
            border: 1px solid #C9DAED;
            padding: 8px;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
        }

        .table1 {
            margin-top: 4px;
        }

        .text-center {
            text-align: center;
        }

        .lab-type-box {
            border: 1px solid #ccc;
            border-top: none;
        }

        .padding010 {
            padding: 0px 10px;
        }

        .td-box {
            border: 1px solid #ccc;
            border-top: none;
        }

        .border-right {
            border-right: 1px solid #ccc;
        }

        .padding5_10 {
            padding: 5px 10px;
        }

        table .tr-box td {
            font-size: 16px;;
        }

        .footer {
            margin-top: 160px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
@include('applications.show-pdf')

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

