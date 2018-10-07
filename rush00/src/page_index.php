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
			<h1>Sample text</h1>
		</div>
	</div>
	<div style="display: inline-block; margin:10px;">
		<?php
        $stock = unserialize(file_get_contents('resources/stock'));
        
        $genre = 'All';
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            $genre = $_POST['genre'];
        $genres = array();
		if (file_exists('resources/stock'))
		{
            $stock = unserialize(file_get_contents('resources/stock'));
            foreach ($stock as $item)
            {
                $itemgenres = $item['genre'];
                foreach ($itemgenres as $addgenre)
                {
                    if (!in_array(ucfirst($addgenre), $genres))
                        array_push($genres, ucfirst($addgenre));
                }
            } 
			$i = 1;
			foreach ($stock as $item)
			{
                if ($genre == 'All' || in_array(lcfirst($genre), $item['genre']))
                {
				    echo '<div style="
                        display: inline-block;
				    	box-shadow: 3px 4px 50px seagreen;
				    	overflow:hidden;
                        margin:10px;
                        width:70vw;
                        height:80px;
				    	border-radius: 5px;
				    	background-color: white;
				    ">';
				    echo "<img align='middle' style='width:80px;height:80px;' src='".$item['path']."' />";
				    echo '<div style="display: inline-block; width:50%; text-align:center;">';
				    echo $item['artist']." - ".$item['name']."</div>";
				    echo '</div>';
                    echo '<br />';
				    $i++;
                }
			}
		} else { echo "There are no items available<br/>"; }
		?>
	</div>

    <div style="float: right; border-right:1px solid black; padding:10px;" class = "cats">
        <h1>Genre:</h1>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <input type="radio" name="genre" <?php if (isset($genre) && $genre=="All") echo "checked";?> value="All">All<br>
        <?php
        foreach ($genres as $curr)
        {
            echo '<input type="radio" name="genre" ';
            if (isset($genre) && $genre==$curr) echo "checked";
            echo ' value="'.$curr.'">'.$curr.'<br>';
        }
        ?>
        <br>
        <input type="submit" name="submit" value="Show">  
        </form>
    </div>  

</body>

