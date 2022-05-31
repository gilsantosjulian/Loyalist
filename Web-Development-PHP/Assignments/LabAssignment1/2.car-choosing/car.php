<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Car Choosing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>

<body class="container p-5">
  <!-- Call to car.php successfully-->
  <h2 class="text-secondary mb-4">Checking Car Stock Successfully!</h2>
  <?php
  // Get value from form input
  // Assign to $carName from select with name = selType
  $carName = $_POST['selType'];
  // Assign to $carName from input with name = txtColor
  $color = $_POST['txtColor'];

  // Find car from cars.json and assign to $car
  $car = findCarAndColor($carName, $color);

  // Check $car and show message to user interface.
  // Check $car is false, that means car is not existed in the system.
  if ($car === false) {
    echo "
        <div class='alert text-danger p-0'>
          The '$carName' doesn't exist in our system.
        </div>
      ";
    echo "
      <a href='choose.html' class='link-primary'>Back to choose another car.</a>
    ";

    // In case $car is existed
  } else {
    // Split $car string into array and assign to $splitCar
    $splitCar = explode(',', $car);

    // Assign to $carColorUpperCase car color with uppercase format
    $carColorUpperCase = ucfirst($color);

    // Check second element of $splitCar (quantity of car is available)
    // In case the second element is null or 0, return message not avaible to user interface
    if ($splitCar[1] === null || $splitCar[1] === '' || $splitCar[1] == 0) {

      echo "
        <div class='alert alert-danger' role='alert'>
          The <b>'$carColorUpperCase' '$carName'</b> is not avaible at the moment, please another car!
        </div>
      ";
      echo "
        <a href='choose.html' class='link-primary'>Back to choose another car.</a>
      ";

      // In case the second element >= 0, display message car is ready to user inteface.
    } else {
      echo "
        <div class='alert alert-success' role='alert'>
          The <b>'$carColorUpperCase' '$carName'</b> is ready to go. Safe Driving!
        </div>
      ";
      echo "
        <a href='choose.html' class='link-primary'>Back to choose another car.</a>
      ";
    }
  }

  /**
   * Find car from cars.json follow by name and color, 
   * @param string $name : name of the car
   * @param string $color : car color
   * @return string $name,$quantity name of car with the quantity of car color - (example: Porsche 911,0)
   */
  function findCarAndColor($name, $color)
  {
    // Read the cars.json file and assign to $json
    $json = file_get_contents('cars.json');

    // Decode the json that is read from cars.json file and assign to $cars
    $cars = json_decode($json, true)["cars"];

    // Define $car found from cars json is null
    $car = null;

    // Looping the array $car to find the $name is equal name element in $cars
    foreach ($cars as $element) {
      // Check if $element['name'] is equal $name then assign $car to $element
      if ($name == $element['name']) {
        // Assign $car to $element
        $car = $element;
      }
    }

    // Check if $car is null then return false
    if (!$car) return false;

    // Define $name and assign it to $car['name]: name of the car
    $name = $car['name'];

    // Define $stocks and assign it to $car['stocks]: car stocks
    $stocks = $car['stocks'];

    // Define $quantity of car with $color and assign it to null
    $quantity = null;

    // Looping $stocks to find the $color then assign the quanity to $quantity
    for ($i = 0; $i < count($stocks); $i++) {

      // Check element color is equal to string lower case of $color
      if ($stocks[$i]['color'] === strtolower($color)) {
        // In case element color is equal is $color
        // Then assign element color to $quantity 
        $quantity = $stocks[$i]['quantity'];
      }
    }

    // Return the $carname with the quanity avaiable
    return $name . ',' . $quantity;
  }
  ?>
</body>

</html>