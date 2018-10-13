<!DOCTYPE html>
<html>
<head>
	<title>Rush00</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<body>
    <?php
		include_once('header.php');
	?>
    <div class="fruit-image"> 
        <div class="fruit-text"> 
            <h1>I want fruit</h1>
        </div>
    </div>
    <div class = "cats" style="float: left;">
        test
    </div>
    <div style="float: right; margin: 10px;">
        <?php
            $file = file("../private/items.csv");
            foreach ($file as $line)
            {
                $items = explode(';', $line);
                echo '<div style="border: 2px solid black;">';
                echo $items[0].' : '.$items[1].'';
                echo '<img style="width:100px;height:100px;" src='.'"'.$items[4].'"'.'/><br />';
                echo '</div><br />';
            }
        ?>
    </div>    
</body>
