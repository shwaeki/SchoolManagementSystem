@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات الدور - {{$role->name}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('roles.update',['role'=>$role])}}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label"> الاسم </label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name',$role->name)}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <hr>
                            @foreach ($permissions as $key => $permission)
                                <div class="col-3">
                                    <div class="d-inline-block mb-1">
                                        <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                               class="form-check-input" id="{{ $permission['name'] }}"
                                               @foreach ($role->permissions as $perm)
                                                   @if ($perm->id == $key)
                                                       checked
                                               @endif
                                               @endforeach
                                               @if($role->name == 'super-admin')
                                                   disabled
                                            @endif>
                                        <label for="{{$permission['name']}}"
                                               class="form-check-label"> {{$permission['display_name']}} </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ml-3">تعديل</button>
            </form>
        </div>
    </div>
@endsection
