<div>
    @if ($checkInTime)
        <h4>Checked in at: {{ $checkInTime }}</h4>
    @else
        <button wire:click="checkIn">Check In</button>
    @endif

    @if ($checkOutTime)
        <h4>Checked out at: {{ $checkOutTime }}</h4>
    @elseif ($checkInTime)
        <button wire:click="checkOut">Check Out</button>
    @endif

    <input type="hidden" wire:model="location" id="location">

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                @this.set('location', position.coords.latitude + ',' + position.coords.longitude);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        document.addEventListener("livewire:load", function() {
            getLocation();
        });
    </script>
</div>
