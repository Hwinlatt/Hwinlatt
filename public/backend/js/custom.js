
let alertRemoveTime = (e) => {
    let textGroup = e.split(' ');
    return Math.ceil(textGroup.length / 2);
}

let alertBox = (message, color) => {
    let colors = ['alert-primary', 'alert-secondary', 'alert-success', 'alert-danger', 'alert-warning', 'alert-info', 'alert-light', 'alert-dark'];
    for (let i = 0; i < colors.length; i++) {
        if ($('.alertBox > div').hasClass(colors[i])) {
            $('.alertBox > div').removeClass(colors[i]);
        }
    }
    $('.alertBox > div').addClass(`alert-`+color);
    $('.alertBox').removeClass('d-none');
    $('.alertBox p').html(message);
    $('.alertBox span').html(alertRemoveTime(message));

    let timer = setInterval(() => {
        $('.alertBox span').html(parseInt($('.alertBox span').html()) - 1);
        if ($('.alertBox span').html() == '0') {
            $('.alertBox').addClass('d-none');
            clearInterval(timer);
        }
    }, 1000);
    let closeTime = setTimeout(() => {
        $('.alertBox').addClass('d-none');
    }, alertRemoveTime(message) * 1000);
        $('.alertBox button').click(function () {
        if ($(this).hasClass('closeBtn')) {
            $('.alertBox').addClass('d-none');
            clearTimeout(closeTime);
            clearInterval(timer);
        }
    })
}

$(document).ready(function () {
    $('.sideBar li').removeClass('active');
});
