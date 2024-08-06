<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="icon" type="image/x-icon" href="{{ asset("assets/img/favicon.ico") }}"/>
    <link href="{{ asset("assets/css/light/loader.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/loader.css")  }}" rel="stylesheet" type="text/css"/>




    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
          rel="stylesheet">

    <link href="{{ asset("assets/bootstrap/css/bootstrap.rtl.min.css") }}" rel="stylesheet" type="text/css"/>


    <link href="{{ asset("assets/css/light/structure.css")  }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ asset("assets/css/dark/structure.css")  }}" rel="stylesheet" type="text/css"/>--}}



    <link href="{{ asset("assets/css/light/main.css")  }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ asset("assets/css/dark/main.css")  }}" rel="stylesheet" type="text/css"/>--}}

    <link href="{{ asset("assets/css/light/structure.css")  }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ asset("assets/css/dark/structure.css")  }}" rel="stylesheet" type="text/css"/>--}}


    <link href="{{ asset("assets/css/light/pages/error/error.css")  }}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ asset("assets/css/dark/pages/error/error.css")  }}" rel="stylesheet" type="text/css"/>--}}
    <style>
        body.dark .theme-logo.dark-element {
            display: inline-block;
        }
        .theme-logo.dark-element {
            display: none;
        }
        body.dark .theme-logo.light-element {
            display: none;
        }
        .theme-logo.light-element {
            display: inline-block;
        }
    </style>

</head>
<body class="error text-center">

<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>


<div class="container-fluid error-content">
    <div class="bg-white px-5 py-3 rounded shadow">
        <img src="{{ asset('assets/img/logo.png') }}" alt="cork-admin-404" class="error-img">

        <h1 class="error-number mt-3">@yield('code')</h1>
        <p class="error-text mb-5 mt-1">@yield('message')</p>
        <a href="{{url('/')}}" class="btn btn-primary mt-5">العودة الى الصفحة الرئيسية</a>
    </div>
</div>

<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/loader.js")  }}"></script>

</body>
</html>
