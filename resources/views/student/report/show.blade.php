<!doctype html>
<html lang="ar" class="mx-auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

    <link href="{{ asset("assets/bootstrap/css/bootstrap.rtl.min.css") }}" rel="stylesheet" type="text/css"/>

    <style>
        body {
            background: url({{ URL::asset('assets/img/report.jpg') }}) no-repeat center center;
            background-size: contain;
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
        }

        html, body {
            height: 297mm;
            width: 210mm;
        }

        @page {
            size: A4;
            margin: 15mm 0 15mm 0;
        }

        html {
            background-color: #212529;
        }

        @media print {
            html {
                background-color: #FFFFFF;
            }
        }


    </style>
</head>
<body>
<div>
    <div style="position: absolute;top:20%;right: 50%;transform: translateX(50%);">
        <div><h1>{{$studentReport->subject}}</h1></div>
    </div>

    <div style="position: absolute; top:30%;right: 50%;transform: translateX(50%);width: 80%;text-align: center">
        <div><p>{!! $content !!}</p></div>
    </div>
</div>

<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script>
    window.onload = function () {
        window.print();
        setTimeout(window.close, 0);
    }
</script>
</body>

</html>
