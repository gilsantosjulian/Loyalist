<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Project 2-2: An Interactive HTML Color Sampler</title>
  <!--Stylesheet-->
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
</head>

<body class="container p-5">
  <h2 class="text-secondary">Project 2-2: An Interactive HTML Color Sampler</h2>
  <?php
  // Get input value from form in color.html
  // Define $red and assign to input name red
  $red = $_GET['red'];

  // Define $green and assign to input name green
  $green = $_GET['green'];

  // Define $blue and assign to input name blue
  $blue = $_GET['blue'];

  // Define $rgb and assign RGB string from values in color.html
  $rgb = $red . ',' . $green . ',' . $blue;
  ?>
  <div class="color-change" style="background-color: rgb(<?php echo $rgb; // Display value of $rgb 
                                                          ?>)" id="output">
    Color: rgb(<?php echo $red; // Display value of $red 
                ?>, <?php echo $green; // Display value of $green 
                    ?>, <?php echo $blue; // Display value of $green 
                        ?>)
  </div>
  <br />
  <div style="width:150px; height: 150px;background-color: rgb(<?php echo $rgb; // Display value of $rgb 
                                                                ?>)"></div>
  <a href="color.html" class="color-change" style="text-decoration:none;background-color: rgb(<?php echo $rgb; //display value of $rgb
                                                                                              ?>)">
    Choose Another Color
  </a>
</body>

</html>