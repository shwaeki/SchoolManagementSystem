<!doctype html>
<html lang="ar" class="mx-auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

    <link href="{{ asset("assets/bootstrap/css/bootstrap.rtl.min.css") }}" rel="stylesheet" type="text/css"/>

    <style>

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
        }

        .content {
            background: url({{ URL::asset('assets/img/report.jpg') }}) repeat top center;
            background-size: contain;
        }

        html, body {
            height: 297mm;
            width: 210mm;
        }

        @page {
            size: A4 portrait;
            margin: 20mm;
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
<div class="content">
    <div class="text-center" style="padding-top: 60mm;">
        <h1 class="">{{$studentReport->subject}}</h1>
    </div>
    <div class="text-center"><p>{!! $content !!}</p></div>
</div>

<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script>
    /*    window.onload = function () {
            window.print();
            setTimeout(window.close, 0);
        }*/
</script>
</body>

</html>
