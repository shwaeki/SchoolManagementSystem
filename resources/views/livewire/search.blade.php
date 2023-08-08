{{--<div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">--}}
<div class="">
    <div class="search-animated toggle-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-search">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>

        <div class="form-inline search-full form-inline search" role="search">
            <div class="search-bar">
                <input type="text" class="form-control search-form-control  ml-lg-auto"
                       placeholder="بحث ..."
                       aria-label="Search"
                       id="search"
                       autocomplete="off"
                       name="q"
                       wire:model="query"
                       wire:keydown.tab="resetAll"
                       wire:keydown.escape="resetAll">
            </div>
        </div>

    </div>


    @if(!empty($query) && $searchStatus && strlen($query) >= 3  )
        <div
            class="bg-white list-group p-3 position-absolute shadow"
            style="z-index: 999999; max-height: 300px; width: 370px; overflow: auto;margin-top: 5px;">
{{--            <div wire:loading class="text-center p-3">
                <p><i class="fas fa-spinner fa-spin"></i> يبحث ... </p>
            </div>--}}
            @php($loopIndex = 0)

            <div class="list-group">
                @if(count($data['students']) > 0)
                    <h5 class="mb-0 text-black-50">الطلاب</h5>
                    @foreach($data['students'] as $i => $item)
                        <a href="{{route('students.show',$item['id'])}}" data-search="{{$loopIndex}}"
                           class="list-item search-item px-3 py-2 text-dark">{{ $item['name'] }}</a>
                        @php($loopIndex++)
                    @endforeach
                    @if(count($data['teachers']) > 0)
                        <div class="mt-3"></div>
                    @endif
                @endif

                @if(count($data['teachers']) > 0)
                    <h5 class="mb-0 text-black-50"> المعلمين </h5>
                    @foreach($data['teachers'] as $i => $item)
                        <a href="{{route('teachers.show',$item['id'])}}" data-search="{{$loopIndex}}"
                           class="list-item search-item px-3 py-2 text-dark ">{{ $item['name'] }}</a>
                        @php($loopIndex++)
                    @endforeach
                @endif

                @if(count($data['students']) == 0 && count($data['teachers']) == 0 )
                    <div class="list-item text-center p-2 mb-0">لم يتم العثور على نتيجة لـ "{{$query}}" !</div>
                @endif
            </div>
        </div>
    @endif
</div>
