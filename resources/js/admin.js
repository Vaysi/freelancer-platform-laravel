let Swal = require('sweetalert2/dist/sweetalert2.all.min');
window.persianDate = require('persian-date/dist/persian-date.min');
window.persianDatepicker = require('persian-datepicker/dist/js/persian-datepicker.min');
$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        placement:'top'
    });

    $('.datepicker').persianDatepicker({
        formatter: function(unix){
            return unix;
        },
        initialValueType: 'gregorian'
    });

    // Check if User Sure To Delete
    $(".btn-ask").click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'آیا از درخواست خود اطمینان دارد ؟',
            text: "تغیرات مورد نظر شما توسط کاربران قابل نمایش خواهد بود",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله !',
            cancelButtonText: 'خیر'
        }).then((result) => {
            if (result.value) {
                if(e.target.tagName.toLowerCase() == "button"){
                    $(this).parents('form').first().submit();
                }else {
                    window.location.href = $(this).attr('href');
                }
            }
        });
    });
});
