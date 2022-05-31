<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Car Choosing</title>
</head>

<body>
    <!-- Call to car.php successfully-->
    <h2>Checking Car Stock Successfully!</h2>
    <?php
    //get value from form input
    //assign to $carName from select with name = selType
    $carName = $_POST['selType'];
    ////assign to $carName from input with name = txtColor
    $color = $_POST['txtColor'];

    //find car from cars.json and assign to $car
    $car = findCarAndColor($carName, $color);

    //check $car and show message to user interface.
    // check $car is false, that means car is not existed in the system.
    if ($car === false) {
        echo "The " . $carName . "doesn't exist in our system.";

        // In case $car is existed
    } else {
        //Split $car string into array and assign to $splitCar
        $splitCar = explode(',', $car);

        //check second element of $splitCar (quantity of car is available)
        //In case the second element is null or 0, return message not avaible to user interface
        if ($splitCar[1] === null || $splitCar[1] === '' || $splitCar[1] == 0) {
            echo 'The <b>' . ucfirst($color) . ' ' . $carName . '</b> is not avaible at the moment, please another car!';
            echo '<br/><a href="/car-choosing/choose.html">Back to choose another car.</a>';

            //In case the second element >= 0, display message car is ready to user inteface.
        } else {
            echo 'The <b>' . ucfirst($color) . ' ' . $carName . '</b> is ready to go. Safe Driving!';
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
        //Read the cars.json file and assign to $json
        $json = file_get_contents('cars.json');

        //Decode the json that is read from cars.json file and assign to $cars
        $cars = json_decode($json, true)["cars"];

        //define $car found from cars json is null
        $car = null;

        //looping the array $car to find the $name is equal name element in $cars
        foreach ($cars as $element) {
            //check if $element['name'] is equal $name then assign $car to $element
            if ($name == $element['name']) {
                //assign $car to $element
                $car = $element;
            }
        }

        //check if $car is null then return false
        if (!$car) return false;

        //define $name and assign it to $car['name]: name of the car
        $name = $car['name'];

        //define $stocks and assign it to $car['stocks]: car stocks
        $stocks = $car['stocks'];

        //define $quantity of car with $color and assign it to null
        $quantity = null;

        //looping $stocks to find the $color then assign the quanity to $quantity
        for ($i = 0; $i < count($stocks); $i++) {

            //check element color is equal to string lower case of $color
            if ($stocks[$i]['color'] === strtolower($color)) {
                //In case element color is equal is $color
                //Then assign element color to $quantity 
                $quantity = $stocks[$i]['quantity'];
            }
        }

        //return the $carname with the quanity avaiable
        return $name . ',' . $quantity;
    }
    ?>
</body>

</html>