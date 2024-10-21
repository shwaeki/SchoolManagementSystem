/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}

checkall('checkbox_parent_all', 'checkbox_child');
/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function () {
        var e = $(this).closest("table").find("td:first-child .child-chk"), a = $(this).is(":checked");
        $(e).each(function () {
            a ? ($(this).prop("checked", !0), $(this).closest("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
        tb_var.on("change", "tbody tr .new-control", function () {
            $(this).parents("tr").toggleClass("active")
        })
}


var $activeIndex = -1;
$("#search").focus(function () {
    Livewire.dispatch('changeStatus', { status: true });
    $activeIndex = -1;
});

$("#search").focusout(function () {
    Livewire.dispatch('changeStatus', { status: false });
    $activeIndex = -1;
});




$('#search').on('keydown', function (e) {
    if (e.which === 40) {
        $activeIndex++;
        if ($(".search-item[data-search='" + $activeIndex + "']").length > 0) {
            $(".search-item").removeClass('highlight');
            $(".search-item[data-search='" + $activeIndex + "']").addClass('highlight');
        }
    } else if (e.which === 38) { // ArrowUp
        if ($activeIndex > 0) {
            $activeIndex--;
            $(".search-item").removeClass('highlight');
            $(".search-item[data-search='" + $activeIndex + "']").addClass('highlight');
        }
    } else if (e.which === 13) { // Enter
        if ($(".search-item[data-search='" + $activeIndex + "']").length > 0) {
            $(".search-item[data-search='" + $activeIndex + "']").get(0).click();
        }
    } else {
        $activeIndex = -1;
    }

    if ($(".search-item[data-search='" + $activeIndex + "']").length > 0) {
        $(".search-item[data-search='" + $activeIndex + "']")[0].scrollIntoView({
            behavior: 'instant',
            block: 'nearest'
        });
    }

    console.log($activeIndex);
});


$(document).on("input", ".only-integer", function () {
    this.value = this.value.replace(/\D/g, '');
});

$('input[required], select[required],textarea[required]').parent('div').find('label').addClass("required");

function deleteItem(e) {
    Swal.fire({
        title: 'هل انت متأكد؟',
        text: "لن تستطيع استرجاع البانات!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم',
        cancelButtonText: 'الغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = $(e).data('item');
            $('#delete-form').attr('action', url).submit();
        }
    })
}

function restoreItem(e) {
    Swal.fire({
        title: 'هل انت متأكد؟',
        text: "سوف يتم استرجاع البيانات من الارشيف!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم',
        cancelButtonText: 'الغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = $(e).data('item');
            $('#put-form').attr('action', url).submit();
        }
    })
}

function archiveItem(e) {
    Swal.fire({
        title: 'هل انت متأكد؟',
        text: "سوف يتم نققل العنصر و كل ما يخصه الى الارشيف!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم',
        cancelButtonText: 'الغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = $(e).data('item');
            $('#put-form').attr('action', url).submit();
        }
    })
}

if (jQuery().dataTable) {
    $('.dataTableConfigNoData').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section text-center'<'dt--pages-count  mb-sm-0 mb-3'><'dt--pagination'p>>",
        "language": {"url": "../assets/datatable_arabic.json"},
        'buttons': [],
        "pageLength": 20
    }).on('init', function () {
        $('*[type="search"]').css({'width': '100%',});
        $('.dataTables_filter').css({'width': '100%',});
        $('label').css({'width': '100%',});
        $('.dataTables_wrapper').css({'margin-top': '1em', 'width': '100%'});
    });


    $('.dataTableConfig').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'B><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "language": {"url": "../assets/datatable_arabic.json"},

        'buttons': ["excel", 'print'],

        "pageLength": 25
    });
}

$('button[data-bs-toggle="tab"]').on('click', function (e) {
    e.preventDefault();
    var href = $(this).attr('href');
    window.location.hash = href;
    localStorage.setItem('selectedTabHash', href);
    localStorage.setItem('currentPageUrl', $("#current_url").val());
});


function showTabFromHash(hash) {
    var tab = $('.nav-pills button[href="' + hash + '"]');
    if (tab.length > 0) {
        new bootstrap.Tab(tab[0]).show();
    }
}


$(document).ready(function () {
    var hash = window.location.hash;
    if (hash) {
        showTabFromHash(hash);
    } else {
        var savedHash = localStorage.getItem('selectedTabHash');
        var currentPageUrl = localStorage.getItem('currentPageUrl');
        if (savedHash && currentPageUrl == $("#current_url").val()) {
            showTabFromHash(savedHash);
            window.location.hash = savedHash;
        }
    }
});


$(window).on('hashchange', function () {
    var hash = window.location.hash;
    if (hash) {
        var savedHash = localStorage.getItem('selectedTabHash');
        var currentPageUrl = hash;
        var currentUrl = $("#current_url").val();

        if (savedHash && currentPageUrl === currentUrl) {
            showTabFromHash(savedHash);
        } else {
            showTabFromHash(hash);
        }
    }
});


$('.select2').select2({
    language: "ar",
    dir: "rtl",
    theme: 'bootstrap-5',
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
});


flatpickr($('input[type="date"]:not(.custom-date)'), {
    static: true
})

flatpickr($('input[type="time"]:not(.custom-time)'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: false,
    static: true
});
