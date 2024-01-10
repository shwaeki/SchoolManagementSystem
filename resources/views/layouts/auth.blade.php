<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="icon" type="image/x-icon" href="{{ asset("assets/img/favicon.ico") }}"/>
    <link href="{{ asset("assets/css/light/loader.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/loader.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <link href="{{ asset("assets/plugins/src/font-icons/fontawesome/css/fontawesome.css")  }}" rel="stylesheet"
          type="text/css"/>


    <link href="{{ asset("assets/bootstrap/css/bootstrap.rtl.min.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/light/main.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/perfect-scrollbar/perfect-scrollbar.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/css/light/structure.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/light/elements/alert.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/light/authentication/auth-boxed.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/dark/main.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/perfect-scrollbar/perfect-scrollbar.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/css/dark/structure.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/elements/alert.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/authentication/auth-boxed.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/src/jquery-ui/jquery-ui.min.css")  }}" rel="stylesheet" type="text/css"/>


</head>
<body class="form">

<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<div class="auth-container d-flex">
    @yield('content')
</div>

<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/global/vendors.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/jquery-ui/jquery-ui.min.js")  }}"></script>
<script src="{{ asset("assets/loader.js")  }}"></script>
<script src="{{ asset("assets/js/custom.js")  }}"></script>
@stack('scripts')
</body>
</html>
