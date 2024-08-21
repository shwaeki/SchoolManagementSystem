<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">



    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-header">
                <div class="w-info">
                    @if ($checkInTime)
                        <button wire:click="checkOut" class="btn btn-danger">تسجيل المغادرة</button>
                    @else
                        <button wire:click="checkIn" class="btn btn-success">تسجيل الوصول</button>
                    @endif
                </div>
            </div>
            <div class="w-content" style="    margin-top: 10px;">
                <div class="w-info">
                    <p class="value fs-5">
                        @if ($checkInTime)
                            تم تسجيل الوصول في: <span>{{ $checkInTime }}</span>
                        @else
                            يرجى تسجيل الوصول
                        @endif
                    </p>
                </div>

            </div>
            @if( session('error'))
                <p class="text-danger small mb-0" >{{ session('error') }}</p>
            @endif
        </div>
    </div>


    <input type="hidden" wire:model="location" id="location">

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Fetch location name using reverse geocoding
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.address) {
                                const locationName = data.display_name;
                            @this.set('location', locationName)
                                ;
                            } else {
                                alert("Unable to determine location name.");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("Failed to get location name.");
                        });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        document.addEventListener("livewire:load", function () {
            getLocation();
        });
    </script>

</div>
