<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍳 SilogHub</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1> 🍳 SilogHub </h1>
        <form method="POST" action="order.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="silog">Silog Meals:</label>
            <select id="silog" name="silog" required>
                <option value="tapsilog">Tapsilog - ₱185</option>
                <option value="longsilog">Longsilog - ₱155</option>
                <option value="tocilog">Tocilog- ₱155</option>
                <option value="hotsilog">Hotsilog - ₱155</option>
                <option value="chicksilog">Chicksilog - ₱195</option>
                <option value="daingsilog">Daingsilog - ₱220</option>
            </select>

            <div class="input-group">
             
            </div>

            <div class="input-group">
                <label for="extras">Extras:</label>
                <input type="checkbox" id="extra garlic rice" name="extras[]" value="extra garlic rice">
                <label for="extra garlic rice">Extra Garlic Rice : +₱30.00</label>

                <input type="checkbox" id="extra plain rice" name="extras[]" value="extra plain rice">
                <label for="extra plain rice">Extra Plain Rice: +₱20.00</label>

                <input type="checkbox" id="extra soup" name="extras[]" value="extra soup">
                <label for="extra soup">Extra Soup: +₱5.00</label>
                
                <input type="checkbox" id="bottled water" name="extras[]" value="bottled water">
                <label for="bottled water" >Bottled Water +₱15.00</label>

                <input type="checkbox" id="softdrink" name="extras[]" value="softdrink">
                <label for="softdrink" >Softdrink +₱18.00</label>
                
                
            </div>

            <label for="instructions">Special Instructions:</label>
            <textarea id="instructions" name="instructions" rows="4"></textarea>

            <button type="submit">Place Order</button>
        </form>
    </div>
    
</body>

</html>