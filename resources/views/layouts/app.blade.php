<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="icon" type="image/x-icon" href="{{ asset("assets/img/favicon.ico") }}"/>
    <link href="{{ asset("assets/css/light/loader.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/loader.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/plugins/src/waves/waves.min.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/src/highlight/styles/monokai-sublime.css")  }}" rel="stylesheet"
          type="text/css"/>

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


    <link href="{{ asset("assets/css/dark/main.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/perfect-scrollbar/perfect-scrollbar.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/css/dark/structure.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/elements/alert.css")  }}" rel="stylesheet" type="text/css"/>


    <link href="{{ asset("assets/plugins/src/table/datatable/datatables.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/table/datatable/dt-global_style.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/table/datatable/custom_dt_miscellaneous.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/table/datatable/custom_dt_custom.css")  }}" rel="stylesheet"
          type="text/css"/>

    <link href="{{ asset("assets/plugins/css/dark/table/datatable/dt-global_style.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/table/datatable/custom_dt_custom.css")  }}" rel="stylesheet"
          type="text/css"/>

    <link href="{{ asset("assets/plugins/src/jquery-ui/jquery-ui.min.css")  }}" rel="stylesheet" type="text/css"/>


    <link href="{{ asset("assets/plugins/src/sweetalerts2/sweetalerts2.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/sweetalerts2/custom-sweetalert.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/sweetalerts2/custom-sweetalert.css")  }}" rel="stylesheet"
          type="text/css"/>


    <link href="{{ asset("assets/plugins/src/flatpickr/flatpickr.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/plugins/css/light/flatpickr/custom-flatpickr.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/flatpickr/custom-flatpickr.css")  }}" rel="stylesheet"
          type="text/css"/>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css"/>


    <link href="{{ asset("assets/css/style.css?v=1.0")  }}" rel="stylesheet" type="text/css"/>


    @livewireStyles

    @stack('styles')

    <style>
        body.dark .layout-px-spacing, .layout-px-spacing {
            min-height: calc(100vh - 155px) !important;
        }

    </style>

</head>
<body class="layout-boxed">


<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>


<div class="header-container container-xxl">
    <header class="header navbar navbar-expand-sm expand-header">

        <input type="hidden" id="current_url" value="{{url()->current()}}">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </a>
        @auth("web")
            <livewire:search/>
        @endauth

        <ul class="navbar-item flex-row ms-lg-auto ms-0 action-area">

            <li class="nav-item dropdown year-dropdown ms-2">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="year-dropdown"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $activeAcademicYear->name}}
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="year-dropdown">
                    @foreach($academicYears as $year)
                        <a class="dropdown-item d-flex" href="{{route('academic-year.select',['year'=> $year->id])}}">
                            <span class="align-self-center">{{$year->name}}</span>
                        </a>
                    @endforeach

                </div>
            </li>

            <li class="nav-item dropdown language-dropdown d-none d-sm-block">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset("assets/img/flags/ar.svg") }}" class="flag-width" alt="flag">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">

                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="{{ asset("assets/img/flags/ar.svg") }}" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;العربية</span>
                    </a>

                </div>
            </li>

            <li class="nav-item theme-toggle-item">
                <a href="javascript:void(0);" class="nav-link theme-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-moon dark-mode">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-sun light-mode">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </a>
            </li>

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-container">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="https://ui-avatars.com/api/?bold=true&name={{ Auth::user()->name }}"
                                 class="rounded-circle">
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <div class="emoji me-2">
                                &#x1F44B;
                            </div>
                            <div class="media-body">
                                <h5>  {{ Auth::user()->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{route('profile.edit')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>الملف الشخصي</span>
                        </a>
                    </div>

                    <div class="dropdown-item">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>تسجيل الخروج </span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>

            </li>
        </ul>
    </header>
</div>


<div class="main-container " id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <div class="sidebar-wrapper sidebar-theme">
        <nav id="sidebar">

            <div class="navbar-nav theme-brand flex-row  text-center">
                <div class="nav-logo">
                    <div class="nav-item theme-logo">
                        <a href="{{route('home')}}" class="d-none">
                            <img src="{{ asset("assets/img/logo.png") }}" class="navbar-logo" alt="logo">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="{{route('home')}}" class="nav-link"> رياض المجد </a>
                    </div>
                </div>
                <div class="nav-item sidebar-toggle">
                    <div class="btn-toggle sidebarCollapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevrons-left">
                            <polyline points="11 17 6 12 11 7"></polyline>
                            <polyline points="18 17 13 12 18 7"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
            <ul class="list-unstyled menu-categories" id="accordionExample">

                <li class="menu active">
                    <a href="/" aria-expanded="{{ Route::is('home') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>الرئيسية</span>
                        </div>
                    </a>
                </li>


                @auth("web")

                    <li class="menu">
                        <a href="{{route('school-classes.index')}}"
                           aria-expanded="{{ Route::is('school-classes.index','school-classes.edit','school-classes.create','school-classes.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-zap">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                                <span>الفصول الدراسية</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="#students" data-bs-toggle="collapse"
                           aria-expanded="{{ Route::is('students.index','students.edit','students.create','students-request.index','students.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>الطلاب</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled  {{ Route::is('students.index','students.edit','students.create','students-request.index','students.show') ? 'show' : 'collapse' }}"
                            id="students"
                            data-bs-parent="#accordionExample">
                            <li class="{{ Route::is('students.index') ? 'active' : '' }}">
                                <a href="{{route('students.index')}}"> قائمة الطلاب </a>
                            </li>
                            <li class="{{ Route::is('students.create') ? 'active' : '' }}">
                                <a href="{{route('students.create')}}"> اضافة </a>
                            </li>
                            <li class="{{ Route::is('students-request.index') ? 'active' : '' }}">
                                <a href="{{route('students-request.index')}}"> طلبات الطلاب </a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu menu-heading">
                        <div class="heading"><span>الموظفين و المستخدمين</span></div>
                    </li>

                    <li class="menu">
                        <a href="{{route('teachers.index')}}"
                           aria-expanded="{{ Route::is('teachers.index','teachers.edit','teachers.create','teachers.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span> قائمة الموظفين</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="#users" data-bs-toggle="collapse"
                           aria-expanded="{{ Route::is('users.index','users.edit','users.create','users.show','roles.create') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>مستخدمي النظام</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled  {{ Route::is('users.index','users.edit','users.create','users.show','roles.create') ? 'show' : 'collapse' }}"
                            id="users"
                            data-bs-parent="#accordionExample">
                            <li class="{{ Route::is('users.index') ? 'active' : '' }}">
                                <a href="{{route('users.index')}}"> مستخدمي النظام </a>
                            </li>
                            <li class="{{ Route::is('roles.create') ? 'active' : '' }}">
                                <a href="{{route('roles.create')}}"> قائمة الادوار </a>
                            </li>
                            <li class="{{ Route::is('users.create') ? 'active' : '' }}">
                                <a href="{{route('users.create')}}"> مستخدم جديد </a>
                            </li>
                        </ul>
                    </li>


                    <li class="menu menu-heading">
                        <div class="heading"><span> إعدادات </span></div>
                    </li>
                    <li class="menu">
                        <a href="{{route('academic-years.index')}}"
                           aria-expanded="{{ Route::is('academic-years.index','academic-years.edit','academic-years.create','academic-years.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>السنوات الدراسية</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{route('reports.index')}}"
                           aria-expanded="{{ Route::is('reports.index','reports.edit','reports.create','reports.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>التقارير</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{route('messages.index')}}"
                           aria-expanded="{{ Route::is('messages.index','messages.edit','messages.create','messages.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>ارسال رسالة </span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{route('certificates.index')}}"
                           aria-expanded="{{ Route::is('certificates.index','certificates.edit','certificates.create','certificates.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span> انوع الشهادات</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{route('salaries.index')}}"
                           aria-expanded="{{ Route::is('salaries.index','salaries.edit','salaries.create','salaries.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>قسيمة الراتب</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="{{route('products.index')}}"
                           aria-expanded="{{ Route::is('products.index','products.edit','products.create','products.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>المنتجات</span>
                            </div>
                        </a>
                    </li>
                @endauth
                <li class="menu">
                    <a href="{{route('teacher-plan.index')}}"
                       aria-expanded="{{ Route::is('teacher-plan.index') ? 'true' : 'false' }}"
                       class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-cpu">
                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                <rect x="9" y="9" width="6" height="6"></rect>
                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                <line x1="1" y1="14" x2="4" y2="14"></line>
                            </svg>
                            <span>الخطة الشهرية</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="{{route('chats.index')}}"
                       aria-expanded="{{ Route::is('chats.index','chats.edit','chats.create','chats.show') ? 'true' : 'false' }}"
                       class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-cpu">
                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                <rect x="9" y="9" width="6" height="6"></rect>
                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                <line x1="1" y1="14" x2="4" y2="14"></line>
                            </svg>
                            <span>الدردشات</span>
                        </div>
                    </a>
                </li>

                @auth("web")
                    <li class="menu">
                        <a href="{{route('advertises.index')}}"
                           aria-expanded="{{ Route::is('advertises.index','advertises.edit','advertises.create','advertises.show') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>الاعلانات</span>
                            </div>
                        </a>
                    </li>

                    @if(auth()->id() == 1 || auth()->id() == 5)
                        <li class="menu menu-heading">
                            <div class="heading"><span> قيد التطوير</span></div>
                        </li>

                    @endif

                @endauth

                @auth("teacher")

                    @if(auth()->user()->show_salary_slip == true)
                        <li class="menu">
                            <a href="{{route('mysalries')}}"
                               aria-expanded="{{ Route::is('mysalries') ? 'true' : 'false' }}" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-cpu">
                                        <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                        <rect x="9" y="9" width="6" height="6"></rect>
                                        <line x1="9" y1="1" x2="9" y2="4"></line>
                                        <line x1="15" y1="1" x2="15" y2="4"></line>
                                        <line x1="9" y1="20" x2="9" y2="23"></line>
                                        <line x1="15" y1="20" x2="15" y2="23"></line>
                                        <line x1="20" y1="9" x2="23" y2="9"></line>
                                        <line x1="20" y1="14" x2="23" y2="14"></line>
                                        <line x1="1" y1="9" x2="4" y2="9"></line>
                                        <line x1="1" y1="14" x2="4" y2="14"></line>
                                    </svg>
                                    <span>قسائم الراتب </span>
                                </div>
                            </a>
                        </li>
                    @endif

                    <li class="menu">
                        <a href="{{route('myfiles')}}" aria-expanded="{{ Route::is('myfiles') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>ملفاتي الخاصة </span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{route('myreports')}}" aria-expanded="{{ Route::is('myreports') ? 'true' : 'false' }}"
                           class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
                                </svg>
                                <span>تقاريري الخاصة </span>
                            </div>
                        </a>
                    </li>

                    <li class="menu menu-heading">
                        <div class="heading"><span> فصولي الدراسية </span></div>
                    </li>

                    @foreach(auth()->user()->supervisorYearClasses()->where('academic_year_id',$activeAcademicYear->id)->get() ?? [] as $yearClass)
                        @if($yearClass->schoolClass && $yearClass->schoolClass->archived == false)
                            <li class="menu">
                                <a href="{{route('school-classes.show', $yearClass->schoolClass)  }}"
                                   aria-expanded="{{ Route::is('school-classes.show', $yearClass->schoolClass) ? 'true' : 'false' }}"
                                   class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                        </svg>
                                        <span>{{$yearClass->schoolClass?->name}}</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach


                        <li class="menu menu-heading">
                            <div class="heading"><span>  فصولي الدراسية للمساعدة</span></div>
                        </li>

                        @foreach(auth()->user()->supervisorYearClasses()->where('academic_year_id',$activeAcademicYear->id)->get() ?? [] as $yearClass)
                            @if($yearClass->schoolClass && $yearClass->schoolClass->archived == false)
                                <li class="menu">
                                    <a href="{{route('school-classes.show', $yearClass->schoolClass)  }}"
                                       aria-expanded="{{ Route::is('school-classes.show', $yearClass->schoolClass) ? 'true' : 'false' }}"
                                       class="dropdown-toggle">
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-cpu">
                                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                                <rect x="9" y="9" width="6" height="6"></rect>
                                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                                <line x1="1" y1="14" x2="4" y2="14"></line>
                                            </svg>
                                            <span>{{$yearClass->schoolClass?->name}}</span>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach

                @endauth

            </ul>
        </nav>
    </div>


    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">

                <div class="row layout-top-spacing">

                    <div class="col-12">
                        @if (session('message'))
                            <div
                                class="alert alert-icon-left alert-light-success alert-dismissible fade show mb-4  d-print-none"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-x close">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                {{ session('message') }}
                            </div>
                        @endif

                        @if ($adminActiveAcademicYear->id != $activeAcademicYear->id)
                            <div
                                class="alert alert-dismissible alert-icon-left alert-light-warning fade mb-4 show  d-print-none"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-x close">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-alert-triangle">
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12" y2="17"></line>
                                </svg>
                                انت تتصفح سنة دراسية غير مفعلة!
                                <a href="{{route('academic-year.select',['year'=> $adminActiveAcademicYear->id])}}"
                                   class="alert-link">اضغط هنا للانتقال إلى السنة الدراسية الحالية.</a>.
                            </div>
                        @endif

                        <div class="d-print-none">
                            @stack('warnings')
                        </div>

                        @error('ActiveAcademicYear')
                        <div class="alert alert-light--danger d-print-none" role="alert">
                            انت تتصفح سنة دراسية غير مفعلة! لا يمكن تعديل أو أصافة بيانات في الوقت الحالي.
                        </div>
                        @enderror

                        @yield('content')
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>


<form method="post" id="delete-form" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<form method="post" id="put-form" style="display: none;">
    @csrf
    @method('PUT')
</form>

@livewireScripts
<script src="{{ asset("assets/plugins/src/global/vendors.min.js") }}"></script>
<script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/mousetrap/mousetrap.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/waves/waves.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/sweetalerts2/sweetalerts2.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/table/datatable/datatables.js") }}"></script>
<script src="{{ asset("assets/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/table/datatable/button-ext/buttons.html5.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/table/datatable/button-ext/buttons.print.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/table/datatable/button-ext/jszip.min.js") }}"></script>
<script src="{{ asset("assets/plugins/src/jquery-ui/jquery-ui.min.js")  }}"></script>
<script src="{{ asset("assets/plugins/src/flatpickr/flatpickr.js")  }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset("assets/js/custom.js")  }}"></script>
<script src="{{ asset("assets/loader.js")  }}"></script>
<script src="{{ asset("assets/app.js")}}"></script>
<script>
    setTimeout(function () {
        var $loadScreen = $("#load_screen");
        if ($loadScreen.length) {
            $loadScreen.remove();
        }
    }, 3000);
</script>
@stack('scripts')

</body>
</html>
