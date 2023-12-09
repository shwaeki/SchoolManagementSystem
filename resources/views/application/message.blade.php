@extends('layouts.auth')

@section('content')
    <div class="container mx-auto align-self-center">

        <div class="row">

            <div class="col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                <div class="card bg-white mt-3 mb-3">
                    <div class="card-body text-center my-5">
                        <img src="{{ asset("assets/img/logo.png") }}" width="200px" class="mb-3">

                        <h3>تم تقديم الطلب بنجاح سوف نقوم بالتواصل معك عما قريب</h3>
                        <p>مع تحيات - رياض المجد</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
