<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/font-awesome.css">

    <title>Document</title>
</head>
<body>

<div class="login">

    <div class="login__content">

        <div class="login__img">
            <img src="./images/undraw_online_wishes_dlmr.svg">
        </div>

        <div class="login__forms">
            <form action="" class="login__registre" id="login-in">
                <h1 class="login__title">Sign In</h1>

                <div class="login__box">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input id="usernameL" type="text" placeholder="Username" class="login__input">
                </div>

                <div class="login__box">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input id="passwordL" type="password" placeholder="Password" class="login__input">
                </div>

                <a href="#" class="login__button">Sign In</a>

                <div>
                    <span class="login__account">Don't have an Account ?</span>
                    <span class="login__signin" id="sign-up">Sign Up</span>
                </div>
            </form>

            <form class="login__create none" id="login-up">
                <h1 class="login__title">Create Account</h1>

                <div class="login__box">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <input id="firstName" type="text" placeholder="First Name" class="login__input">
                </div>
                <div class="login__box">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <input id="lastName" type="text" placeholder="Last Name" class="login__input">
                </div>
                <div class="login__box">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input id="username" type="text" placeholder="Username" class="login__input">
                </div>

                <div class="login__box" style="margin-bottom:15px;">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input id="password" type="password" placeholder="Password" class="login__input">
                </div>
                <label id="error">There is username with that name</label>
                <a href="javascript:void(0);" class="login__button" id="signUpButton">Sign Up</a>

                <div>
                    <span class="login__account">Already have an Account ?</span>
                    <span class="login__signup" id="sign-in">Sign In</span>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./js/loginSignup.js"></script>

</body>
</html>