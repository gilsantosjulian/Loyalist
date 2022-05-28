<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Project 2-1: USD/EUR Currency Conversion</title>
  </head>

  <body>
    <h2>Project 2-1: USD/EUR Currency Conversion</h2>
    <form name="form" action="" method="get">
      <input
        placeholder="Please Input the USD Amount"
        type="number"
        name="usd"
        id="usd"
      />
    </form>
    <?php
    //Define API URL to get exchange rate.
    define("API_URL", "https://api.currencyfreaks.com/latest?apikey=f35fcd5c00d84cb588b4fef82634af8&symbols=EUR");

    //initializes a new cURL session to handle calling api.
    $curl = curl_init(API_URL);

    //set opt RETURNTRANSFER is true to transfer response of the return value from api to string.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //execute the cURL session, call api server to get value.
    $response = curl_exec($curl);

    // close the cURL session and free all resources the cURL handle is also deleted.
    curl_close($curl);

    // decode string to JSON format
    $data = json_decode($response, true);

    //Define RATE that get from API, RATE base on USD to EUR
    define("RATE", (float) $data["rates"]["EUR"]);

    //GET USD value from Input from user.
    $usdValue = $_GET["usd"];

    //Perform the conversion by calculate USD value multiply with the Rate getting from API
    $eurValue = $usdValue * RATE;
    
    //print the result
    echo "<br/>
    <b>$usdValue USD</b> is equivalent to: <b>$eurValue EUR</b>.lol" ?>;
  </body>
</html>
