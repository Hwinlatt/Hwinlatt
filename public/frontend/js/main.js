(function ($) {
    "use strict";

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
        $('.input-text').attr('readonly',true);
        $('.input-text').attr('size','9')

    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        let remain = parseInt(button.parent().parent().find('.rmNumber').html());
        if (button.hasClass('btn-plus')) {
            if (remain == 1 && oldValue==1) {
                $('.addMoreBtn').hide();
                return;
            }
            var newVal = parseFloat(oldValue) + 1;
            if (remain == newVal) {
                $('.addMoreBtn').hide();
            }
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                if (remain != newVal) {
                    ($('.addMoreBtn')).show();
                }
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

})(jQuery);

let alertRemoveTime = (e)=>{
    let textGroup = e.split(' ');
    return  Math.ceil(textGroup.length / 2);
}


let alertColor = (rmColor,add_Color) => {
    if ($('.alertBox > div').hasClass('alert-'+rmColor)) {
        $('.alertBox > div').removeClass('alert-'+rmColor);
    }
    $('.alertBox > div').addClass('alert-'+add_Color);
}
let checkInternet = (error) =>{
    Swal.fire({
        icon: 'question',
        title: 'The Internet?',
        text: error,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fa-solid fa-arrow-rotate-right"></i> Refresh'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.reload();
        }
    })
}
let totalBill = (input,to) => {
    let bill = 0;
    $(input).each(function(index,element){
        bill += parseInt(element.value);
    })
    $(to).html(bill);
}




