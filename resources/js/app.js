require("./bootstrap");
require("./custom.js");

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
$(function() {
    $('button[data-bs-toggle="pill"]').on('click', function(e) {
        window.localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
        $('#custom-pill button[data-bs-target="' + activeTab + '"]').tab('show');
        window.localStorage.removeItem("activeTab");
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
    }
});
//Import button animation
const button   = document.getElementById('import');
const save   = document.getElementById('save-button');
const btn_text = document.getElementById('button-text');
const spinner  = document.getElementById("spinner");
button.addEventListener('click', () => {
    btn_text.innerText = "Importing"
    spinner.classList.remove("hide");
});
save.addEventListener('click', () => {
    btn_text.innerText = "Saving"
    spinner.classList.remove("hide");
});




