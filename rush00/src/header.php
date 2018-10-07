<?php
    echo
    '<div class="header">
        <div class = "left">
            
        </div>
        <div class="right">';
        session_start();
        if ($_SESSION['logged_on_user'])
            echo '
            <div class= "left">
            <div class="dropdown">
                <button class="dropbtn">'.$_SESSION['logged_on_user'].'</button>
                <div class="dropdown-content">
                    <a href="profile.php">My Profile</a>
                    <a href="page_modif.php">Modify</a>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
            </div>';
        else
            echo '<a href="page_login.php">Login</a>
                  <a href="page_create.php">Register</a>';
        echo '
            <a href="cart.html">
                <img src="resources/cart.png" alt="" style="width:30px;height:30px;border:0;">
            </a>
        </div>
        <div class="clear"></div>
    </div>
    </div>';

?>
