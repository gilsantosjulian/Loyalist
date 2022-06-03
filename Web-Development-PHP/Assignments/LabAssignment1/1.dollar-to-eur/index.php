<!DOCTYPE html>
<html>

<head>
  <title>
    Project 2.1: USD Currency Conversion
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>

<body class="container p-5">
  <h2 class="text-secondary">Project 2-1: USD Currency Conversion</h2>
  <!-- Display the input to allow user to type USD value that want to exchange to EUR -->
  <form class="container px-0 mb-5" name="form" action="" method="get">
    <div class="input-group-lg mb-3 w-50">
      <label for="exampleInputEmail1" class="form-label text-secondary">USD Amount</label>
      <input class="form-control" placeholder="Please Input the USD Amount" type="number" name="usd" id="usd">
      <label class="form-label text-secondary" for="destCurrency">Choose a currency to convert to:</label>
          <select class="form-select" name="currency" id="currency">
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="AUD">AUD</option>
            <option value="CAD">CAD</option>
          </select>
</div>

    <button type="submit" class="btn btn-primary">Convert now!</button>
  </form>

  <?php
  // Define Default rate in case calling API is failed from any reason.
  define("DEFAULT_RATE", 0.93);

  // GET destination currency from user
  $destinationCurrency = $_GET["currency"];

  // Build API URL
  $apiURL = "https://api.currencyfreaks.com/latest?apikey=f35fcd5c00d84cb588bd4fef82634af8&symbols=" . $destinationCurrency;

  // Define API URL to get exchange rate.
  //define("API_URL", "https://api.currencyfreaks.com/latest?apikey=f35fcd5c00d84cb588bd4fef82634af8&symbols=EUR");
  define("API_URL", $apiURL);

  // Initializes a new cURL session to handle calling api.
  $curl = curl_init(API_URL);

  // Set opt RETURNTRANSFER is true to transfer response of the return value from api to string.
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  // Assign response from excecuting the cURL session, call api server to get value.
  $response = curl_exec($curl);

  // Close the cURL session and free all resources the cURL handle is also deleted.
  curl_close($curl);

  // Assign data from decoding string to JSON format
  $data = json_decode($response, true);

  // Set the rate is equal DEFAULT_RATE
  $rate = DEFAULT_RATE;

  // Check if calling API is failed, print error into screen and use the default rate as 0.93
  if ($data == null || ($data["success"] === false && $data["error"]["message"])) {
    // Define error message geting from api
    $errorMessage = $data['error']['message'];

    // Display the error message to UI
    echo "
      <div class='alert alert-danger role='alert'>
        $errorMessage
      </div>
    ";

    // In case call API success, continue the process of conversion    
  }

  //set rate that get from API based on USD to EUR
  $rate = number_format((float) $data["rates"][$destinationCurrency], 2, '.', '');

  // Display the rate to UI
  echo "
    <div class='alert alert-light w-50 p-0'>
      USD to $destinationCurrency exchange rate is: <b>$rate</b>
    </div>
  ";

  // GET USD value from Input from user. 
  $usdValue = $_GET["usd"];

  // Perform the conversion by calculate USD value multiply with the Rate getting from API
  // Format result to use just two decimals
  $convertedValue = number_format((float) $usdValue * $rate, 2, '.', '');

  // Print the result
  echo "
    <div class='alert alert-success w-50'>
      <b>$usdValue USD</b> is equivalent to: <b>$convertedValue $destinationCurrency</b>
    </div>
  ";
  ?>
</body>

</html>