<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍳 SilogHub Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php

    /**
     * Displays the order summary, including customer details, silog order details, jokes, and passwords if applicable.
     * Generates a receipt content based on the order details and saves it to a text file.
     */
    function displayOrderSummary()
    {
        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Display the order summary section
            echo "<div class='summary'>";
            echo "<h2>📝 Order Summary</h2>";

            // Define the prices for different silog types, and extras
            $silog_prices = [
                "tapsilog" => 185,
                "longsilog" => 155,
                "tocilog" => 155,
                "chicksilog" => 195,
                "daingsilog" => 220,
            ];



            $extras_prices = [
                "extra garlic rice" => 30.00,
                "extra plain rice" => 10.50,
                "extra soup" => 5.00,
                "bottled water" => 15.00,
                "softdrink" => 18.00
            ];

            // Sanitize the input values
            $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : "";
            $silogType = isset($_POST["silog"]) ? htmlspecialchars($_POST["silog"]) : "";
            $instructions = isset($_POST["instructions"]) ? htmlspecialchars($_POST["instructions"]) : "";

            // Extract the user input details
            $silog_type = isset($_POST["silog"]) ? $_POST["silog"] : "";
            $extras = isset($_POST["extras"]) ? $_POST["extras"] : [];

            // Calculate the total price
            $total_price = calculateTotalPrice($silog_prices, $extras_prices, $silog_type, $extras);

            // Display the detailed order information
            displayOrderDetails($name, $silog_prices,$extras_prices, $silog_type, $extras, $total_price);

            // Display jokes and passwords based on the total price
            displayJokeAndPassword($silog_type, $_POST["name"], $total_price);

            // Generate the receipt content based on the order details
            $receiptContent = generateReceiptContent($name, $silogType, $silog_prices, $extras, $extras_prices, $total_price, $instructions);

            // Save the receipt content to a text file
            saveReceiptToFile($receiptContent);

            // Close the order summary section
            echo "</div>";
        }
    }



    function calculateTotalPrice($silog_prices, $extras_prices, $silog_type, $extras){
        $total_price = $silog_prices[$silog_type];
        // Using Foreach
        foreach ($extras as $extra) {
            $total_price += $extras_prices[$extra];
        }

        // // Using for loop
        // for ($i = 0; $i < count($extras); $i++) {
        //     $total_price += $extras_prices[$extras[$i]];
        // }

        // Using while loop
        // $index = 0;
        // while ($index < count($extras)) {
        //     $total_price += $extras_prices[$extras[$index]];
        //     $index++;
        // }

        // // Using do-while loop
        // $index = 0;
        // do {
        //     $total_price += $extras_prices[$extras[$index]];
        //     $index++;
        // } while ($index < count($extras));

        return $total_price;
    }


    function displayOrderDetails($name, $silog_prices,  $extras_prices, $silog_type,$extras, $total_price){
        echo "<table>";

        // Display the customer's name
        echo "<tr><td>Name</td><td>" . htmlspecialchars($name) . "</td></tr>";

        // Display the type of silog ordered along with its price
        echo "<tr><td>Silog Meal </td><td>" . htmlspecialchars($silog_type) . " (₱" . number_format($silog_prices[$silog_type], 2) . ")</td></tr>";

        // Display the size of the silog ordered along with its price
     

        // Check if any extras were selected and display them along with their total price
        if (!empty($extras)) {
            echo "<tr><td>Extras:</td><td>" . implode(", ", $extras) . " (₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")</td></tr>";
        }

        // Display the total price of the order
        echo "<tr><td>Total Price</td><td>₱" . number_format($total_price, 2) . "</td></tr>";

        // Display any special instructions provided by the customer
        echo "<tr><td>Special Instructions</td><td>" . htmlspecialchars($_POST["instructions"]) . "</td></tr>";

        echo "</table>";
    }

    /**
     * Displays a joke and password based on the coffee type and total price.
     * 
     * @param string $coffee_type The type of coffee ordered
     * @param string $name The name of the customer
     * @param float $total_price The total price of the order
     */
    function displayJokeAndPassword($silog_type, $name, $total_price)
    {
        // Check if the coffee type is not espresso
        if ($silog_type !== "espresso") {
            // Display a greeting with the customer's name
            echo "Hey, " . htmlspecialchars($name) . "!";
            // Display a coffee-related joke
            echo "<p>Why do you have to watch what you say around egg whites? They can't take a yolk.</p>";
        }

        // Check the total price to determine the password to be displayed
        if ($total_price > 250 && $total_price < 350) {
            // Display the password for the CR
            echo "<p>Password for the CR: silog123</p>";
        } elseif ($total_price >= 350) {
            // Display the password for Wi-Fi
            echo "<p>Password for Wi-Fi: silog456</p>";
        }
    }


    function generateReceiptContent($name, $silogType, $silog_prices,$extras, $extras_prices, $total_price, $instructions){
        // Initialize the receipt content with a title and separator
        $receiptContent = "Order Summary\n";
        $receiptContent .= "-----------------\n";

        // Add customer name to the receipt content
        $receiptContent .= "Name: " . $name . "\n";

        // Add coffee type with its price to the receipt content
        $receiptContent .= "Silog Meal " . $silogType . " (₱" . number_format($silog_prices[$silogType], 2) . ")\n";

        // Add coffee size with its price to the receipt content


        // Check if any extras were selected and add them to the receipt content
        if (!empty($extras)) {
            $receiptContent .= "Extras: " . implode(", ", $extras) . " (₱" . number_format(array_sum(array_intersect_key($extras_prices, array_flip($extras))), 2) . ")\n";
        }

        // Add the total price to the receipt content
        $receiptContent .= "Total Price: ₱" . number_format($total_price, 2) . "\n";

        // Add any special instructions to the receipt content
        $receiptContent .= "Special Instructions: " . $instructions . "\n";

        // Add a thank you message to the receipt content
        $receiptContent .= "\n";
        $receiptContent .= "Thank you for your order!";

        // Return the complete receipt content
        return $receiptContent;
    }


    /**
     * Saves the receipt content to a text file.
     * 
     * @param string $receiptContent The content of the receipt to be saved
     */
    function saveReceiptToFile($receiptContent){
        // Open a file for writing. If the file does not exist, it will be created.
        // If the file cannot be opened, display an error message and terminate the script.
        $file = fopen("Silog Hub Order Summary.txt", "w") or die("Unable to open file!");

        // Write the receipt content to the file.
        fwrite($file, $receiptContent);

        // Close the file after writing is complete.
        fclose($file);

        // Display a success message indicating that the receipt was created.
        echo "Receipt created successfully as Silog Hub Order Summary.txt!";
    }

    // Call the displayOrderSummary function
    displayOrderSummary();

    ?>

</body>

</html>
