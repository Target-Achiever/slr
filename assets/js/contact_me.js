$(function() {



    $('.playpause').parent().click(function() {
        if($('.video').get(0).paused)
        {
            $('.video').get(0).play();
            $('.playpause').fadeOut();
        }
        else {
            $('.video').get(0).pause();
            $('.playpause').fadeIn();
        }
    });



    $('.send').on('click',function() {
        $('#subscribers_form').submit();
    });

    $('.numeric').on('keypress',function(e) {
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('.cost').on('blur',function(e) {
        if($(this).val().length == 2) {
            $(this).val('');
        }
    });

    $('#subscribers_form').on('submit',function(e) {
        e.preventDefault();
        var this_email = $(this).find('#email').val();
        var this_msg = $(this).find('.error_msg');
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if(this_email != '' && filter.test(this_email)) {

            $.ajax({
                url: "ajax_process.php",
                type: "POST",
                data: {
                    email: this_email,
                    type: 'subscribe'
                },
                dataType: "json",
                cache: false,
                success: function(res) {
                    if(res.status == "true") {
                        this_msg.text('You have subscribed successfully').addClass('suc');
                    }
                    else {
                        this_msg.text(res.message).removeClass('suc').show();
                    }
                },
                error: function() {
                   this_msg.text('Technical error. Please try again later.').removeClass('suc').show();
                },
            });
        }
        else {
            this_msg.text('Enter valid email id').removeClass('suc').show();
        }
    });

    $("#contactForm input,#contactForm select,#contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {

            var this_form = $('#contactForm').data('form');

            if(this_form == "appointment") {

                event.preventDefault();
                var phone = $("input#phone").val();
                var fname = $("input#fname").val();
                var lname = $("input#lname").val();
                var date = $("input#date").val();
                var time = $("select#time").val();
                var user_loans_id = $("input#user_loans_id").val();

                $.ajax({
                    url: "ajax_process.php",
                    type: "POST",
                    data: {
                        phone: phone,
                        fname: fname,
                        lname: lname,
                        date: date,
                        time: time,
                        user_loans_id: user_loans_id,
                        type : 'appointment'
                    },
                    dataType: "json",
                    cache: false,
                    success: function(res) {
                        if(res.status == "true") {
                            alert('Your appointment has been submitted. We will contact you soon.');
                            window.location.href = "index.php";    
                        }
                        else{
                            alert(res.message);
                            window.location.href = "index.php";
                        }
                    },
                    error: function() {
                       alert('Technical error. Please try again later.');
                       window.location.href = "index.php";
                    },
                });
            }
            
            // event.preventDefault(); // prevent default submit behaviour
            // // get values from FORM
            // var name = $("input#name").val();
            // var email = $("input#email").val();
            // var phone = $("input#phone").val();
            // var message = $("textarea#message").val();
            // var firstName = name; // For Success/Failure Message
            // // Check for white space in name for Success/Fail message
            // if (firstName.indexOf(' ') >= 0) {
            //     firstName = name.split(' ').slice(0, -1).join(' ');
            // }
            // $.ajax({
            //     url: "././mail/contact_me.php",
            //     type: "POST",
            //     data: {
            //         name: name,
            //         phone: phone,
            //         email: email,
            //         message: message
            //     },
            //     cache: false,
            //     success: function() {
            //         // Success message
            //         $('#success').html("<div class='alert alert-success'>");
            //         $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            //             .append("</button>");
            //         $('#success > .alert-success')
            //             .append("<strong>Your message has been sent. </strong>");
            //         $('#success > .alert-success')
            //             .append('</div>');

            //         //clear all fields
            //         $('#contactForm').trigger("reset");
            //     },
            //     error: function() {
            //         // Fail message
            //         $('#success').html("<div class='alert alert-danger'>");
            //         $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            //             .append("</button>");
            //         $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
            //         $('#success > .alert-danger').append('</div>');
            //         //clear all fields
            //         $('#contactForm').trigger("reset");
            //     },
            // })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });

    // $(window).on('load',function() {
        if (/Mobi/.test(navigator.userAgent)) {
            $('video').removeAttr("autoplay");
            $('video').attr('controls',true);
        }
    // }); 

});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});
