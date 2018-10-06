<!DOCTYPE html>
<html>
<head>
	<title>Rush00</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<body>
    <div class="header">
        <div class = "left">
            <div class="dropdown">
                <button class="dropbtn">Dropdown</button>
                <div class="dropdown-content">
                    <a href="#">iaosjdioa</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
        </div>
         <div class="right">

            <div class="right">
            <?php session_start();
            if ($_SESSION['logged_on_user'])
                echo '<a href="index.html">'.$_SESSION['logged_on_user'].'</a>';
            else
                echo '<a href="index.html">Login</a>
                      <a href="create.html">Register</a>';
            ?>
                <a href="cart.html">
                    <img src="resources/cart.png" alt="" style="width:30px;height:30px;border:0;">
                </a>
            </div>
        <div class="clear"></div>
        </div>
    </div>
    <div class="fruit-image"> 
        <div class="fruit-text"> 
            <h1>I want fruit</h1>
        </div>
    </div>
    <div class = "cats">

    </div>


</body>

