<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Project 2-2: An Interactive HTML Color Sampler</title>
    <!--Stylesheet-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Project 2-2: An Interactive HTML Color Sampler</h2>
    <?php
    //get input value from form in color.html
    //define $red and assign to input name red
    $red = $_GET['red'];

    //define $green and assign to input name green
    $green = $_GET['green'];

    //define $blue and assign to input name blue
    $blue = $_GET['blue'];

    //define $rgb and assign RGB string from values in color.html
    $rgb = $red . ',' . $green . ',' . $blue;
    ?>
    <div 
        class="color-change" 
        style="background-color: rgb(<?php echo $rgb; //display value of $rgb ?>)" 
        id="output">
            Color: rgb(<?php echo $red; //display value of $red ?>, <?php echo $green; //display value of $green ?>, <?php echo $blue; //display value of $green ?>)
    </div>
    <br />
    <div style="width:150px; height: 150px;background-color: rgb(<?php echo $rgb; //display value of $rgb ?>)"></div>
    <a 
        href="/color-sampler/color.html" 
        class="color-change" 
        style="text-decoration:none;background-color: rgb(<?php echo $rgb; //display value of $rgb?>)">
            Choose Another Color
    </a>
</body>

</html>