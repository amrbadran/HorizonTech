const signUp = document.getElementById('sign-up'),
    signIn = document.getElementById('sign-in'),
    loginIn = document.getElementById('login-in'),
    loginUp = document.getElementById('login-up')


signUp.addEventListener('click', ()=>{
    // Remove classes first if they exist
    loginIn.classList.remove('block')
    loginUp.classList.remove('none')

    // Add classes
    loginIn.classList.toggle('none')
    loginUp.classList.toggle('block')
})

signIn.addEventListener('click', ()=>{
    // Remove classes first if they exist
    loginIn.classList.remove('none')
    loginUp.classList.remove('block')

    // Add classes
    loginIn.classList.toggle('block')
    loginUp.classList.toggle('none')
})

$(document).ready(function (){
    $('#signUpButton').on('click', function() {
        // Trigger form submission
        $('#signupForm').submit();
    });

$('#login-up').on('submit', function(e) {
    e.preventDefault();

    // Clear previous error messages
    $('#error').text('');

    var firstName = $('#firstName').val().trim();
    var lastName = $('#lastName').val().trim();
    var username = $('#username').val().trim();
    var password = $('#password').val().trim();

    var nameRegex = /^[a-zA-Z]{2,50}$/;
    var usernameRegex = /^[a-zA-Z0-9_]{3,50}$/;
    var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if (!nameRegex.test(firstName)) {
        $('#error').text('Invalid first name');
        return;
    }
    if (!nameRegex.test(lastName)) {
        $('#error').text('Invalid last name');
        return;
    }
    if (!usernameRegex.test(username)) {
        $('#error').text('Invalid username');
        return;
    }
    if (!passwordRegex.test(password)) {
        $('#error').text('Password must be at least 8 characters long and contain at least one letter and one number');
        return;
    }

    $.ajax({
        url: './php/ajax/ajax_sign_up.php',
        type: 'POST',
        data: {
            firstName: firstName,
            lastName: lastName,
            username: username,
            password: password
        },
        success: function(response) {
            if (response == 'success') {
                $('#error').css('color', 'green');
                $('#error').text("Your Account has been created");
                window.location.href = 'login.php';
            } else {

                console.log(response);
                $('#error').text(response);
            }
        }
    })
})

    $('#login-in').on('submit',function(e) {
        e.preventDefault();
        var username = $('#usernameL').val();
        var password = $('#passwordL').val();

        $.ajax({
            url: './php/ajax/ajax_sign_in.php',
            type: 'POST',
            data: {username: username, password: password},
            success: function(response) {
                if (response == 'success') {
                    window.location.href = 'index.php';
                } else {
                    console.log(response);
                    $('#error-message').text('Invalid username or password');
                }
            }
        });
    });
});


