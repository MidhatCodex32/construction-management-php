


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            color: green;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            margin-bottom: 20px;
        }
        .grid label {
            font-weight: bold;
        }
        .grid input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .payment-options {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .payment-options img {
            width: 60px;
            height: auto;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Secure Payment</h2>
        <div class="grid">
            <label for="cardholder-name">Cardholder Name:</label>
            <input type="text" id="cardholder-name" placeholder="{{cardholderName}}">

            <label for="amount">Amount:</label>
            <input type="text" id="amount" placeholder="Enter Amount">
        </div>

        <div class="payment-options">
            <div>
                <input type="radio" id="visa" name="payment-method" value="Visa">
                <label for="visa">
                    <img src="visa-logo.png" alt="Visa">
                </label>
            </div>
            <div>
                <input type="radio" id="mastercard" name="payment-method" value="MasterCard">
                <label for="mastercard">
                    <img src="mastercard-logo.png" alt="MasterCard">
                </label>
            </div>
            <div>
                <input type="radio" id="paypal" name="payment-method" value="PayPal">
                <label for="paypal">
                    <img src="paypal-logo.png" alt="PayPal">
                </label>
            </div>
        </div>

        <button class="submit-btn" onclick="submitPayment()">Submit Payment</button>
    </div>

    <script>
        function submitPayment() {
            const paymentData = {
                cardholderName: document.getElementById('cardholder-name').value,
                amount: document.getElementById('amount').value,
                paymentMethod: document.querySelector('input[name="payment-method"]:checked')?.value
            };

            console.log('Payment Data:', paymentData);
            // Pass this data to the next page dynamically, e.g., via query parameters or an API call.
        }
    </script>
</body>
</html>