
<!doctype html>
<html lang="en" class="mx-auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

    <style>

/*        @font-face {
            font-family: 'cairo';
            src: url({{ storage_path("assets/cairo.ttf") }}) format("truetype");
            font-weight: 700;
            font-style: normal;
        }*/
        body {
            /*  background: url({{ URL::asset('assets/img/report.jpg') }});*/
            background: url({{ public_path('assets/img/report.jpg') }});
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            background-image-resize: 6;
            position: relative;
 /*           font-family: 'examplefont', sans-serif;
*/
        }


        html, body {
            height: 297mm;
            width: 210mm;
        }


    </style>
</head>
<body>
<div style="padding: 20px">
    <div style="position: absolute;top:20%;right: 50%;transform: translateX(50%);">
        <div><h1>{{$studentReport->subject}}</h1></div>
    </div>

    <div style="position: absolute; top:45%;right: 50%;transform: translateX(50%);width: 80%;text-align: center">
        <div><p>{{$content}}</p></div>
    </div>
</div>
</body>

</html>
