$(document).ready(function(){
    $('#update-profile').validate({
            rules: {
                name: "required",
                username: "required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: "Please enter your full name",
                username: "Please enter your username",
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
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
