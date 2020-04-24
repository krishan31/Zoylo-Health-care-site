/* ==============================================
Flexslider
=============================================== */

$(window).load(function() {

    $('.flexslider').flexslider({
    	pauseOnHover: true,
    	directionNav: false
    });
    
});

$(document).ready(function() {

    /* ==============================================
    Checkboxes
    =============================================== */
    $('.checkbox-container').on('click', function() {
        setupLabel();
    });

    function setupLabel() {
        if ($('.checkbox-container input').length) {
            $('.checkbox-container').each(function(){ 
                $(this).removeClass('checkbox-on');
            });
            $('.checkbox-container input:checked').each(function(){ 
                $(this).parent('.checkbox-container').addClass('checkbox-on');
            });                
        };
    };

    /* ==============================================
    Smooth Scrolling
    =============================================== */
    $('ul.nav li a, .logo a, .featured a, .hero-section a, .prices a').on('click', function(e){
        el = $(this).attr('href');
        $('html, body').animate({scrollTop: $(el).offset().top - 74}, 750);
        e.preventDefault();
    });

    /* ==============================================
    Mobile Menu
    =============================================== */
    var mobileActiveClass = 'nav-active';
    if ($('.mobile-nav').length && $('.mobile-nav').attr('data-autogenerate') == 'true') {
        var mobileMenu = $('.mobile-nav');
        $('ul.nav li a').each(function(index, elem) {
            if($(this).hasClass(mobileActiveClass)) {
                mobileMenu.append($('<option selected="selected"></option>').val($(elem).attr('href')).html($(elem).html()));
            } else {
                mobileMenu.append($('<option></option>').val($(elem).attr('href')).html($(elem).html()));
            }
        });
    }

    $('.mobile-nav').on('change', function() {
        link = $(this).val();
        if (!link) {
            return;
        }

        if (link.substring(0,1) == '#') {
            $('html, body').animate({scrollTop: $(link).offset().top - 74}, 750);
        } else {
            document.location.href = link;
        }
    });

    /* ==============================================
    Fancybox
    =============================================== */
    $("a.fancybox").fancybox({
        'overlayShow'   : false,
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic'
    });

    /* ==============================================
    Contact Form
    =============================================== */


});

$('#mobile').on('keyup', function() {
     if($('#mobile').val().match('[0-9]{10}'))  {
        $('#otpLink').click();
     }
});

  $('#otpLink').on('click', function() {
       var mobile = $('#mobile').val();
        if($('#mobile').val().length!=10)  {
         $('#mobile').addClass("input-error");
                alert("Please put 10 digit mobile number");
             }
             else{  
                $('#otpLink').html('Sending OTP...');
                $.ajax({  
                     type: "POST",  
                     url: 'sendotp.php',
                     dataType: 'json',
                     data: "mobile="+mobile,
                     success: function(data){ 

                        if(data.Status=="Success") { 
                            $('#otpLink').html('Resend OTP');
                            $('#OTPmsg').html('OTP has been sent to '+mobile);
                        } else {
                            $('#OTPmsg').html(data.Details);
                         }
                    }, error: function(error, xhr){
                        alert('Error is: '+xhr);
                    }
                 });
             }
    });


  $('#contactForm').submit(function(){
    var form = $(this),
        action = form.attr('action'),
        dataString = form.serialize();
    if(validate()){
        $('#submitButton').html('<i class="fa fa-spinner fa-spin"></i> Submiting');
        $.ajax({  
            type: "POST",  
            url: action,        
            data: dataString,
            dataType: "json",
            cache: false,
            success: function(data){ 
                if(data.success==1) { 
                    window.location.href="http://business2business.co.in/zoylo/thankyou.php";
                    $('#submitButton').html('Submit');
                } 
                else if(data.success==2){
                    $('#otp').addClass("input-error");
                    $('#OTPmsg').html(data.msg);
                    $('#submitButton').html('Submit');
                }
                else {
                    $('#OTPmsg').html(data.msg);
                    $('#submitButton').html('Submit');
                }

           }, error: function(error, xhr){
               alert('Error: '+xhr);
           }
        });
    }
    return false;
});



function validate(){
    var requiredFields = $('#contactForm').find('.required');

        requiredFields.each(function() {
            inputType = $(this).attr('type');
            if( $(this).val() == "" ) {
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }  
        });

        function validateEmail(email) { 
            var exp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return exp.test(email);
        }
        var emailField = $('.contact-form-email');
        if( !validateEmail(emailField.val()) ) {
                emailField.addClass("input-error");
            }
          if($('#mobile').val().length!=10){
                $('#mobile').addClass("input-error");
            }
            if ($(".contact-form :input").hasClass("input-error")) {
                return false;
            }
            return true;

}

