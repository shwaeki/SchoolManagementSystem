@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> قائمة المنتجات</h4>
                </div>

                <div class="col-4 text-end align-self-center">
                    <a href="{{route('products.create')}}" class="btn btn-primary"> اضافة </a>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>

        $(document).on("click", '.download_barcode', function () {
            var targetDiv = $(this).find('div.align-items-md-center')[0];
            var product_name = $(this).data('name');
            console.log(product_name);
            html2canvas(targetDiv, {
                scale: 2,
            }).then(function (canvas) {
                CanvasRenderingContext2D.direction = "rtl";
                var link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = product_name + '.png';
                link.click();
            });
        });

    </script>

@endpush
