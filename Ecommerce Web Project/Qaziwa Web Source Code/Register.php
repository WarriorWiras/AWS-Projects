<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <style>
            input, select, textarea {
                width: 100%; /* Full width */
                padding: 12px; /* Some padding */ 
                border: 1px solid lightgrey; /* Gray border */
                border-radius: 4px; /* Rounded borders */
                box-sizing: border-box; /* Make sure that padding and width stays in place */
                margin-bottom: 16px; /* Bottom margin */
                margin-top: 6px;
            }

            input[type=submit] {
                background-color: white;
                color: black;
                width: 110px;
            }

            h1, h3 {
                text-align: center;
            }
            .container{
                background-color: #f1f1f1;
                padding: 20px;
            }

            #message {
                display:none;
                background: #f1f1f1;
                color: #000;
                position: relative;
                padding: 20px;
                margin-top: 10px;
            }

            #message p {
                padding: 10px 35px;
                font-size: 18px;
            }

            /* Add a green text color and a checkmark when the requirements are right */
            .valid {
                color: green;
            }

            .valid:before {
                position: relative;
                left: -35px;
                content: "✔";
            }

            /* Add a red text color and an "x" when the requirements are wrong */
            .invalid {
                color: red;
            }

            .invalid:before {
                position: relative;
                left: -35px;
                content: "✖";
            }




            img {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            .BackToLogin{
                text-align: center;
                color: black;
            }
            .BackToLogin{
                background: #B9DFFF;

                color: #fff;

                border: 1px solid #eee;

                border-radius: 20px;

                box-shadow: 5px 5px 5px #eee;

                text-shadow:none;

                text-align: center;

                color: black;

                width: 200px;  
                margin:  0px auto;
            }
            .BackToLogin:hover{
                background: #016ABC;

                color: #fff;

                border: 1px solid #eee;

                border-radius: 20px;

                box-shadow: 5px 5px 5px #eee;

                text-shadow:none;
            }

        </style>
    </head>
    <body>
        <h1>QaZiWa Bookshop</h1>
        <img src="WebDesign/C300_Logo.jpg" alt="QaZiWa logo" height="100" width="150"/>
        <h3>Create an account. It's free!</h3><br/>
        <div class="BackToLogin"><a style="text-decoration: none" href="Login.php">Back to Login Page</a></div>
        <div class="container">
            <form action="doRegister.php" method="post">

                <br/>
                <label for="firstnameID">First Name: </label>
                <input id="idFName" type="text" name="fname" required/>
                <br/><br/>

                <label for="lastnameID">Last Name: </label>
                <input id="idLName" type="text" name="lname" required/>
                <br/><br/>


                <label for="emailID">Email Address: </label>
                <input id="idEmail" type="text" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" name="emailaddr" placeholder="someone@email.com/someone@email.com.sg" required/>
                <br/><br/>

                <label for="psw">Password</label>
                <input type="password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*?['%@#$%^&*;:?]).{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <br/><br/>

                <input type ="submit" value ="Register Now">

            </form>
        </div>
        <div id="message">
            <h3>Password must contain the following:</h3>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            <p id="character" class="valid">A <b>Quotation</b> Character</p>
        </div>


        <script>
            var myInput = document.getElementById("psw");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");

            // When the user clicks on the password field, show the message box
            myInput.onfocus = function () {
                document.getElementById("message").style.display = "block";
            }

            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function () {
                document.getElementById("message").style.display = "none";
            }

            // When the user starts to type something inside the password field
            myInput.onkeyup = function () {
                // Validate lowercase letters
                var lowerCaseLetters = /[a-z]/g;
                if (myInput.value.match(lowerCaseLetters)) {
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }

                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if (myInput.value.match(upperCaseLetters)) {
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }

                // Validate numbers
                var numbers = /[0-9]/g;
                if (myInput.value.match(numbers)) {
                    number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }

                // Validate length
                if (myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
                //Validate Quotation
                
                var value = /['|| % || ! || @ || # || $ || % || ^ || & || * || ; || : || ?]/g;
                if(myInput.value.match(value)){
                    character.classList.remove("valid");
                    character.classList.add("invalid");                
                } else{
                    character.classList.remove("invalid");
                    character.classList.add("valid");
                }
                
            }
        </script>

    </body>
    <?php include("include/footer.php"); ?>
</html>
