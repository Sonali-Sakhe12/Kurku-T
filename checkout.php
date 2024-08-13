<?php
require 'razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

$keyId = 'rzp_test_U69zpSNmMVKSaT';
$keySecret = 'h61iFO2YT2aeVEvAhZVrXIWs';
$api = new Api($keyId, $keySecret);

// Predefined plans and their prices (in INR)
$plans = [
    '1 month' => 1800,
    '3 months' => 4500,
    '6 months' => 7200,
    '12 months' => 12000
];

// Get plan ID from URL parameters
if (isset($_GET["Plan"])) {
    $planId = $_GET["Plan"];
    if (array_key_exists($planId, $plans)) {
        $totalValue = $plans[$planId];
    } else {
        die("Invalid plan ID specified.");
    }
} else {
    die("Invalid plan ID specified.");
}

if ($totalValue <= 0) {
    die("Invalid amount specified.");
}

$orderData = [
    'amount' => $totalValue * 100, // Amount in paise
    'currency' => 'INR',
    'receipt' => 'order_rcptid_' . time(),
    'payment_capture' => 1
];

$order = $api->order->create($orderData);
$orderId = $order['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurku-T - Checkout</title>
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>
    <div class="logo">Kurku-T</div>
    <div class="container">
        <form id="address-form" method="post" action="handleOrder.php">
            <h2>Shipping address</h2>
            <label for="country">Country/region</label>
            <select id="country" name="country">
                <option value="India">India</option>
            </select>

            <div class="input-group">
                <div>
                    <label for="firstName">First name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div>
                    <label for="lastName">Last name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
            </div>

            <label for="address">Address Line 1</label>
            <input type="text" id="address" name="address" required>

            <label for="apartment">Address Line 2(optional)</label>
            <input type="text" id="apartment" name="apartment">

            <div class="input-group">
                <div>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div>
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" required>
                </div>
                <div>
                    <label for="pinCode">PIN code</label>
                    <input type="text" id="pinCode" name="pinCode" required>
                </div>
            </div>

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="email">E-Mail</label>
            <input type="email" id="email" name="email" required>

            <button type="button" onclick="startPayment()">Continue to shipping</button>
            <a href="index.html#subscribeNow" class="return-link">&#8592; Return</a>

            <input type="hidden" id="pai" name="pai">
            <input type="hidden" id="roi" name="roi">
            <input type="hidden" id="total" name="total">
        </form>

        <div class="bill">
            <div class="item">
                <img src="img/products/img4.jpg" alt="Kurku-t Subscription">
                <div class="item-details">
                    <div class="item-title">Kurku-t Subscription</div>
                    <div class="item-description"></div>
                </div>
                <div class="item-price"></div>
            </div>

            <div class="discount">
                <input type="text" placeholder="Discount code or gift card">
                <button>Apply</button>
            </div>

            <div class="summary">
                <div class="item">
                    <div class="item-details">Subtotal</div>
                    <div class="item-price">₹<?php echo $totalValue ?> </div>
                </div>
                <div class="item">
                    <div class="item-details">Shipping</div>
                    <div class="item-price">Calculated at next step</div>
                </div>
                <hr>
                <div class="item total">
                    <div class="item-details">Total</div>
                    <div class="item-price">₹<?php echo $totalValue ?></div>
                </div>
                <div class="item">
                    <div class="item-details">Recurring total <span>?</span></div>
                    <div class="item-price">Calculated at next step</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectedPlan = JSON.parse(localStorage.getItem('selectedPlan'));
            if (selectedPlan) {
                document.querySelector('.item-description').textContent = `Delivery every ${selectedPlan.plan}`;
                document.querySelector('.item-price').textContent = selectedPlan.price;
            }
        });

        function startPayment() {
            var form = document.getElementById('address-form');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            var totalValue = <?php echo $totalValue; ?>;
            var options = {
                "key": "<?php echo $keyId; ?>",
                "amount": totalValue * 100, // Amount in paise
                "currency": "INR",
                "name": "Kurku-T",
                "description": "Test Payment",
                "order_id": "<?php echo $orderId; ?>",
                "handler": function (response) {
                    document.getElementById('roi').value = response.razorpay_order_id;
                    document.getElementById('pai').value = response.razorpay_payment_id;
                    document.getElementById('total').value = totalValue;
                    document.getElementById('address-form').submit();
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
</body>
</html>
