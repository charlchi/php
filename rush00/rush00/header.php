<?php
    echo
    '<div class="header">
        <div class = "left">
            <div class="dropdown">
                <button class="dropbtn">Dropdown</button>
                <div class="dropdown-content">
                    <a href="index.php">Uno</a>
                    <a href="index.php">Dos</a>
                    <a href="index.php">Tres</a>
                </div>
            </div>
        </div>
        <div class="right">
        <div class="right">';
        session_start();
        if ($_SESSION['logged_on_user'])
            echo '<a href="index.php">'.$_SESSION['logged_on_user'].'</a>
                  <a href="logout.php">Sign out</a>';
        else
            echo '<a href="login.php">Login</a>
                  <a href="create.php">Register</a>';
        echo '
            <a href="cart.html">
                <img src="resources/cart.png" alt="" style="width:30px;height:30px;border:0;">
            </a>
        </div>
        <div class="clear"></div>
    </div>
    </div>';

?>
