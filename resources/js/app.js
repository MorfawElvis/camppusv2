import './bootstrap';

var url = window.location;
$("ul.nav-treeview  a")
    .filter(function () {
        return this.href == url;
    })
    .parentsUntil(".sidebar-menu > .nav-treeview ")
    .siblings()
    .removeClass("active")
    .end()
    .addClass("menu-open");

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
$(document).ready(function () {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
});
document.querySelectorAll('.number-separator').forEach((item) => {
    item.addEventListener('input', (e) => {
        if (/^[0-9.,]+$/.test(e.target.value)) {
        e.target.value = parseFloat(
            e.target.value.replace(/,/g, '')
        ).toLocaleString('en');
        } else {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
        }
    });
});
window.setTimeout(function() {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 2000);
window.setTimeout(function() {
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 4000);
const loader = document.querySelector('.loader');
        const main = document.querySelector('.main');

        function init() {
            setTimeout(() => {
                loader.style.opacity = 0;
                loader.style.display = 'none';

                main.style.display = 'block';
                setTimeout(() => (main.style.opacity = 1), 50);
            }, 2000);
        }
init();