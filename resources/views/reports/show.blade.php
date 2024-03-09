<!doctype html>
<html lang="ar" class="mx-auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

    <link href="{{ asset("assets/bootstrap/css/bootstrap.rtl.min.css") }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/editors/quill/quill.snow.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/editors/quill/quill.snow.css")  }}" rel="stylesheet" type="text/css"/>
    <style>

        .ql-editor p, .ql-editor ol, .ql-editor ul, .ql-editor pre, .ql-editor blockquote, .ql-editor h1, .ql-editor h2, .ql-editor h3, .ql-editor h4, .ql-editor h5, .ql-editor h6 {
            margin: 10px;
        }

        .ql-editor {
            height: auto;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
        }

        .content {
            background: url({{ URL::asset('assets/img/report.jpg') }}) no-repeat top center;
            background-size: cover;
            height: 100%;
        }

        html, body {
            height: 297mm;
            width: 210mm;
        }

        @page {
            size: A4 portrait;
            margin: 0;
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
        <h1 class="">{{$report->subject}}</h1>
    </div>
    <div class=" ql-editor text-start px-5"><p>{!! $content !!}</p></div>
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
