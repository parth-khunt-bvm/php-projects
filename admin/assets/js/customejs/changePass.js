$(document).ready(function(){
    $('#changePass').validate({
            rules: {
                oldPass: {
                    required: true,
                    minlength:5,
                },
                newPass: {
                    required: true,
                    minlength:5,
                },
                conPass: {
                    required: true,
                    minlength:5,
                    equalTo : "#newPass"
                }
            },
            messages: {
                oldPass: {
                    required: "Please enter your current password.",
                    minlength: "Your password must be at least 5 characters long.",
                },
                newPass: {
                    required: "Please enter a new password.",
                    minlength: "Your new password must be at least 5 characters long.",
                },
                conPass: {
                    required: "Please confirm your new password.",
                    minlength: "Your confirmation password must be at least 5 characters long.",
                    equalTo: "The confirmation password does not match the new password."
                }
                
            },
            focusInvalid: true,
            errorElement: "span",
            errorClass: "help-block help-block-error",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback text-danger");
                var icon  = element.parent().children("i");
                icon.removeClass("fa-check").addClass("fa-warning");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            success: function (element) {
                var icon  = element.parent().children("i");
                icon.removeClass("fa-warning").addClass("fa-check");                
                
            },
        });
});
