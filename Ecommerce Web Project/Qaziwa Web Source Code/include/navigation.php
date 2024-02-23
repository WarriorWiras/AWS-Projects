<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
		body{
		overflow-x: hidden;
		}

		header{
		top: 0;
		left: 0;
		right: 0;
		width: 100%;
		height: 70px;
		}


            .img-responsive {
                height: auto;
                width: auto;
                max-height: 72px;
                max-width: 250px;
            }

	    .topnav div{
		float: right;
	    }
            
             
            .topnav {
                overflow: hidden;
		
            }
            
            .topnav > a {
              float: left;
              text-align: center;
              padding: 14px 16px;
              font-size: 17px;
              position: relative;
              color: #000;
              text-decoration: none;
            }
              
            .topnav > a:hover {
                color: #000;
              }
              
            .topnav > a::before {
                content: "";
                position: absolute;
                width: 100%;
                height: 2px;
                bottom: 0;
                left: 0;
                background-color: #000;
                visibility: hidden;
                transform: scaleX(0);
                transition: all 0.3s ease-in-out 0s;
              }

            .topnav > a:hover::before {
                visibility: visible;
                transform: scaleX(1);
            }
            
            
            .topnav a.active {
            color: grey;
            }
            
            .footer{
                text-align: center;
            }
            
            .maincontent{
                padding: 20px 50px 20px 50px;
            }
        </style>
    </head>
    <body>
        <div class="topnav">
        <a <?php if ($activePage =="index") {?>
        class="active" <?php } ?> href="index.php"><img src="pictures/download.png" class="img-responsive"/></a> 
        
        <?php //THIS WILL SHOW IF THE USER IS LOGGED IN ?> 
        <?php if (isset($_SESSION['user_id'])) { ?>
            <a <?php if ($activePage =="forum") {?>
            class="active" <?php } ?> href="forum.php">Forum</a>
            <a <?php if ($activePage =="logoff") {?>
            class="active" <?php } ?> href="logoff.php">Logoff</a>
            
            <?php //THIS WILL SHOW IF THE USER IS ADMIN ?>
            <?php if ($_SESSION['user_id'] == 1) { ?>
		<a <?php if ($activePage =="UploadFile") {?>
                class="active" <?php } ?> href="UploadFile.php" class="topnav-right">Upload File</a>
            <?php } ?>
        <?php } else { ?>
	    <a <?php if ($activePage =="register") {?>
            class="active" <?php } ?> href="register.php">Register</a>
            <a <?php if ($activePage =="login") {?>
            class="active" <?php } ?> href="login.php">Login</a>
        <?php } ?>
        
    </body>
</html>
