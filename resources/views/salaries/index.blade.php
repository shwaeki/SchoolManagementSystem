@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة ملفات قسائم الرواتب</h4>
                </div>

                <div class="col-4 text-end align-self-center">
                    <a href="{{route('salaries.create')}}" class="btn btn-primary"> اضافة </a>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

<form action="" id="updateSalariesFileStatusForm" method="POST">
    @method('PUT')
    @csrf
</form>
@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        function updateSalaryFile(e) {
            Swal.fire({
                title: 'هل انت متأكد؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(e).data('item');
                    $('#updateSalariesFileStatusForm').attr('action', url).submit();
                }
            })
        }
    </script>
@endpush
