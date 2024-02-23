<!DOCTYPE html>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

        <style>
            fieldset{
                width: 500px;  
                margin:  0px auto;
            }

            h1{
                text-align: center;
            }
            .C300_Logo{
                display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
            .Sign_UP{
                background: #B9DFFF;

                color: #fff;

                border: 1px solid #eee;

                border-radius: 20px;

                box-shadow: 5px 5px 5px #eee;

                text-shadow:none;

                text-align: center;

                color: black;
            }
            .Sign_UP:hover{
                background: #016ABC;

                color: #fff;

                border: 1px solid #eee;

                border-radius: 20px;

                box-shadow: 5px 5px 5px #eee;

                text-shadow:none;
            }

        </style>
    </head>
    <header>
    </header>
    <body>
        <!-- <img src="" alt="" height="100" width="998"/> -->
        <br><br><br><br><br><br><br>
        <h1>QaZiWa Books - Login</h1>
        <!-- Username and Password will be posted to doLogin.php -->
        <div class="C300_Logo">
            <img src="WebDesign/C300_Logo.jpg" alt="QaZiWa logo" height="100" width="150"/>
        </div>
        <form method="post" action="doLogin.php">
            <fieldset>
                <legend>Login</legend>
                <table>
                    <tr>

                        <td><label for="username">Email Address:</label></td>
                        <td><input id="username" type="text" name="username"/></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input id="password" type="password" name="password"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" Value="Login" name="Login"/>
                            <input type="submit" value="Guest" name="Guest"/>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td colspan="3"><div class="Sign_UP"><a style="text-decoration: none" href="Register.php">Sign-up for free!!</a></div></td>


                    </tr>
                </table>
            </fieldset>
        </form>


    </body>
    <?php include("include/footer.php"); ?>
</html>