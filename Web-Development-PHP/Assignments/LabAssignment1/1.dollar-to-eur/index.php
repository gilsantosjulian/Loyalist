<!DOCTYPE html>
<html>

<head>
    <title>
        Project 2.1: USD/EUR Currency Conversion
    </title>
</head>

<body>
    <h2>Project 2-1: USD/EUR Currency Conversion</h2>
    <!-- Display the input to allow user to type USD value that want to exchange to EUR -->
    <form name="form" action="" method="get">
        <input placeholder="Please Input the USD Amount" type="number" name="usd" id="usd">
        <button type="submit">Convert from USD to EUR</button>
    </form>
    <?php
    // define Default rate in case calling API is failed from any reason.
    define("DEFAULT_RATE", 0.93);

    //Define API URL to get exchange rate.
    define("API_URL", "https://api.currencyfreaks.com/latest?apikey=f35fcd5c00d84cb588bd4fef82634af8&symbols=EUR");

    //initializes a new cURL session to handle calling api.
    $curl = curl_init(API_URL);

    //set opt RETURNTRANSFER is true to transfer response of the return value from api to string.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //assign response from excecuting the cURL session, call api server to get value.
    $response = curl_exec($curl);

    // close the cURL session and free all resources the cURL handle is also deleted.
    curl_close($curl);

    // assign data from decoding string to JSON format
    $data = json_decode($response, true);

    //set the rate is equal DEFAULT_RATE
    $rate = DEFAULT_RATE;
    // check if calling API is failed, print error into screen and use the default rate as 0.93
    if ($data == null || ($data["success"] === false && $data["error"]["message"]) ) {
        //define error message geting from api
        $errorMessage = $data['error']['message'];

        //display the error message to UI
        echo "</br> $$errorMessage <br/>";
        echo "USD to EUR exchange rate is Default rate as <b>$$rate</b></br>";

        // in case call API success, continue the process of conversion    
    } else {
        //set rate that get from API based on USD to EUR
        $rate = (float) $data["rates"]["EUR"];
        
        // display the rate to UI
        echo "USD to EUR exchange rate is <b>$$rate</b>";
    }
    //GET USD value from Input from user. 
    $usdValue = $_GET["usd"];

    //Perform the conversion by calculate USD value multiply with the Rate getting from API
    $eurValue = $usdValue * $rate;

    //print the result
    echo "<br/>
        <b>$usdValue USD</b> is equivalent to: <b>$eurValue EUR</b>.
    ";
    ?>
</body>

</html>