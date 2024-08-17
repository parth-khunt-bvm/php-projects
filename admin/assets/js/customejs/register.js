$("#register-form").validate({
    rules: {
        fullname: "required",
        username: "required",
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 6
        },
        rpassword: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        },
    },
    messages: {
        fullname: "Please enter your full name",
        username: "Please enter your username",
        email: {
            required: "Please enter a valid email address",
            email: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
        },
        rpassword: {
            required: "Please confirm your password",
            minlength: "Your password must be at least 6 characters long",
            equalTo: "Passwords do not match"
        },
        
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.addClass("invalid-feedback text-danger");
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
    }
});