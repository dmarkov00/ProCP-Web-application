$(document).ready(function () {
    $(".navbar-nav li a").click(function(event) {
        $(".navbar-collapse").collapse('hide');
    });
});

$(document).ready(function () {
    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
    $(".downloadbtn").on('click', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();
    });

});


function check_empty() {
    if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
        alert("Fill All Fields !");
    } else {
        document.getElementById('form').submit();
        alert("Form Submitted Successfully...");
    }
}

//login and reg popup v1
// $(document).ready(function(){
//     $('#login-trigger').click(function(){
//         $(this).next('#login-content').slideToggle();
//         $(this).toggleClass('active');
//
//         if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
//         else $(this).find('span').html('&#x25BC;')
//     })
// });

//login and reg popup v2
$(function () {
    // Calling Login Form
    $("#login_form").click(function () {
        $(".social_login").hide();
        $(".user_login").show();
        return false;
    });

    // Calling Register Form
    $("#register_form").click(function () {
        $(".social_login").hide();
        $(".user_register").show();
        $(".header_title").text('Register');
        return false;
    });

    // Going back to Social Forms
    $(".back_btn").click(function () {
        $(".user_login").hide();
        $(".user_register").hide();
        $(".social_login").show();
        $(".header_title").text('Login');
        return false;
    });

});

//closes the modal after download starts TO BE DONE
$(".downloadbtn").on('click', function(event){
    event.stopPropagation();
    event.stopImmediatePropagation();
});