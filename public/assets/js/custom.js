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
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}


var $activeIndex = -1;
$("#search").focus(function () {
    window.livewire.emit('changeStatus', true);
    $activeIndex = -1;
});

$("#search").focusout(function () {
    window.livewire.emit('changeStatus', false);
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
