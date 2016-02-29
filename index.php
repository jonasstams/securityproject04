<!DOCTYPE html>
<?php
include("authorize.php");
echo "johnson";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>EncryptionMaster</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="container">
    <div class="header">
    </div>
    <div id="middle">
        <div id="middle1"></div>
        <div id="middle2">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" class="logintabs" href="#login">Login</a></li>
                <li><a data-toggle="tab" class="logintabs" href="#register">Register</a></li>
            </ul>
            <div class="fieldmenu">
            <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                    <h3>Login</h3>
                    <p>Please login with your account.</p>
                    <form action="" method="post">
                        <table width="400">
                            <tr><td><strong>Username: </strong></td>
                                <td><input type="text" name="userlogin" required="required" style="color:black;"/></td>
                            </tr>
                            <tr>
                                <td><strong>Password: </strong></td>
                                <td><input type="password" name="passlogin" required="required" style="color:black;"></td>
                            </tr>
                        </table>
                        <span style="color:red;"><strong><?php echo $error; ?></strong></span><br>

                        <span><strong>No account? Please register.</strong></span><br><br>

                        <input type="submit" name="login" class="loginbutton" value="Login"/>

                    </form>
                </div>
                <div id="register" class="tab-pane fade tabs">
                    <h3>Register</h3>
                    <p>If you don't have an account, you can register here.</p>
                    <form action="" method="post">
                        <table width="350">
                            <tr>
                                <td><b>Username:</b></td>
                                <td><input type="text" name="userregister" required="required" style="color:black;" /></td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><input type="text" name="email" required="required" style="color:black;" /></td>
                            </tr>
                            <tr>
                                <td><b>Password:</b></td>
                                <td><input type="password" name="pass" required="required" style="color:black;" ></td>
                            </tr>
                            <tr>
                                <td><b>Confirm Password:</b></td>
                                <td><input type="password" name="pass2" required="required" style="color:black;" ></td>
                            </tr>
                            <tr>
                                <td><b>Voornaam:</b></td>
                                <td><input type="text" name="voornaam" required="required" style="color:black;" ></td>
                            </tr>
                            <tr>
                                <td><b>Achternaam:</b></td>
                                <td><input type="text" name="achternaam" required="required" style="color:black;" ></td>
                            </tr>
							<tr>
								<td><input name="accept" type="checkbox" value="1" />By clicking this, I aggree with the terms.</td>
							</tr>
                        </table>
                        <span style="color:red;"><strong><?php echo $error; ?></strong></span>
                        <input type="submit" name="signup" class="loginbutton" value="signup"/>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <div id="middle3"></div>

    </div>
    <div id="footer">
    </div>
</div>
</body>
</html>

