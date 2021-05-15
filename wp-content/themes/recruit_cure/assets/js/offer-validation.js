jQuery(document).ready(function() {
    jQuery("#post").validate({

        errorPlacement: function(error, element) {},

        debug: false,
        rules: {
            offer_pr: {required: true},
        },

        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                jQuery("#error-message").show().text("Please make sure that all required fields have been filled out.");
            } else {
                jQuery("#error-message").hide();
            }
        },

        submitHandler: function(form) {
            tinyMCE.triggerSave();
            var serialized = jQuery(form).serialize();
            console.log(serialized);
            jQuery(form).ajaxSubmit();
        }

    })
});