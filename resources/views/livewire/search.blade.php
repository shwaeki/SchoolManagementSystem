<div>
    <div class="search-animated toggle-search" wire:ignore>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-search">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>

        <div class="form-inline search-full form-inline search  bg-light rounded-3" role="search">
            <div class="search-bar">
                <input type="text" class="form-control search-form-control  ml-lg-auto"
                       placeholder="بحث ..."
                       aria-label="Search"
                       id="search"
                       autocomplete="off"
                       name="q"
                       wire:model.live="query"
                       wire:keydown.tab="resetAll"
                       wire:keydown.escape="resetAll">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x search-close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

            </div>
        </div>
        <span class="badge badge-secondary">Ctrl + /</span>

    </div>


    @if(!empty($query) && $searchStatus && strlen($query) >= 3  )
        <div
            class="bg-white list-group p-3 position-absolute shadow search-result">
            @php($loopIndex = 0)

            <div class="list-group">
                @if(count($data['students']) > 0)
                    <h5 class="mb-0 text-black-50">الطلاب</h5>
                    @foreach($data['students'] as $i => $item)
                        <a href="{{route('students.show',$item['id'])}}" data-search="{{$loopIndex}}"
                           class="list-item search-item px-3 py-2 text-dark">
                            <img src="{{ $item['photo'] }}" class="me-2 rounded-circle border border-primary" style="object-fit: contain;" width="30px" height="30px"> {{ $item['name'] }}
                        </a>
                        @php($loopIndex++)
                    @endforeach
                    @if(count($data['teachers']) > 0)
                        <div class="mt-3"></div>
                    @endif
                @endif

                    @if(count($data['students-request']) > 0)
                    <h5 class="mb-0 text-black-50">طلبات الطلاب</h5>
                    @foreach($data['students-request'] as $i => $item)
                        <a href="{{route('students-request.show',$item['id'])}}" data-search="{{$loopIndex}}"
                           class="list-item search-item px-3 py-2 text-dark">
                           {{ $item['name'] }}
                        </a>
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

                @if(count($data['students']) == 0 && count($data['students-request']) == 0 && count($data['teachers']) == 0 )
                    <div class="list-item text-center p-2 mb-0">لم يتم العثور على نتيجة لـ "{{$query}}" !</div>
                @endif
            </div>
        </div>
    @endif
</div>
