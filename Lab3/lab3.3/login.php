<?php
require_once('Page.php');
//Nova instanca za login
$page = new Page('Login Page');

$page->description('Login to your account');
$page->keywords('login, account, authentication');
$page->robots(true);

///jquery inicijalizacija
$page->link('http://code.jquery.com/jquery-1.9.1.js');
$page->link('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js');
//jquery od lab2
$page->jquery('
    $(function() {
        $("#login-form").validate({
            rules: {
                username: "required",
                password: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                username: "Please enter your username",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
');
echo $page->display('
    <div id="output">' . $output . '</div>
    <form action="" method="post" id="login-form" novalidate="novalidate">
        <div class="label">Username</div><input type="text" id="username" name="username" value="' . $username . '" /><br />
        <div class="label">Password</div><input type="password" id="password" name="password" /><br />
        <div style="margin-left:140px;"><input type="submit" name="submit" value="Login" /></div>
    </form>
');
?>
