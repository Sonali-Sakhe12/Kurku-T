<?php
$host = "localhost";
$dbName = "hemppmft_kurkut";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$orderData = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (
    empty($orderData['total']) || empty($orderData['roi']) || empty($orderData['pai']) ||
    empty($orderData['firstName']) || empty($orderData['lastName']) ||
    empty($orderData['phone']) || empty($orderData['address']) ||
    empty($orderData['pinCode']) || empty($orderData['city']) ||
    empty($orderData['state']) || empty($orderData['country'])
) {
    echo json_encode(array("success" => false, "message" => "Required fields are missing."));
    exit();
}

$total = intval($orderData['total']);
$razorpayOrderId = $orderData['roi'];
$razorpayPaymentId = $orderData['pai'];
$firstName = $orderData['firstName'];
$lastName = $orderData['lastName'];
$phone = $orderData['phone'];
$email = $orderData['email'];
$address = $orderData['address'];
$apartment = isset($orderData['apartment']) ? $orderData['apartment'] : '';
$pinCode = $orderData['pinCode'];
$city = $orderData['city'];
$state = $orderData['state'];
$country = $orderData['country'];
if ($total == 12000) {
    $plan = '12 months';
}
if ($total == 7200) {
    $plan = '6 months';
}
if ($total == 4500) {
    $plan = '3 months';
}
if ($total == 1800) {
    $plan = '1 month';
}

$sql = "INSERT INTO tblorder (first_name, last_name, order_plan, total, order_id, payment_id, email, phone_number, address_line1, address_line2, pincode, city, state, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssss", $firstName, $lastName, $plan, $total, $razorpayOrderId, $razorpayPaymentId, $email, $phone, $address, $apartment, $pinCode, $city, $state, $country);

if ($stmt->execute()) {
    header("Location: index.html");
} else {
    echo 'Something went wrong!';
}

$conn->close();
?>