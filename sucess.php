<?php
session_start();
include "connect.php"; // Make sure this file contains your database connection

// Check if the request is coming from the Razorpay page
$allowedReferer = 'https://pages.razorpay.com/pl_OgJFJrnSKej3QT/view';
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $allowedReferer) !== 0) {
    // Redirect to an error page if the referer is not the Razorpay page
    header("Location: error.php?message=" . urlencode("Invalid access attempt"));
    exit();
}

// Check if the user is coming from a valid session
if (!isset($_SESSION['regno'])) {
    // Redirect to an error page or home page if there's no valid session
    header("Location: error.php?message=" . urlencode("Invalid session"));
    exit();
}

$regno = $_SESSION['regno'];

// Prepare a secure SQL query to get user data
$stmt = $conn->prepare("SELECT * FROM users WHERE regno = ?");
$stmt->bind_param("s", $regno);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // No user found with this registration number
    header("Location: error.php?message=" . urlencode("User not found"));
    exit();
}

$user = $result->fetch_assoc();

// Update payment status
$updateStmt = $conn->prepare("UPDATE users SET payment_status = 1 WHERE regno = ?");
$updateStmt->bind_param("s", $regno);

if ($updateStmt->execute()) {
    // Payment status updated successfully
    $paymentUpdateSuccess = true;
} else {
    // Failed to update payment status
    $paymentUpdateSuccess = false;
}

// Close the database connections
$stmt->close();
$updateStmt->close();
$conn->close();

// Clear the session variable after successful processing
unset($_SESSION['regno']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <h1>Payment Successful</h1>
    
    <?php if ($paymentUpdateSuccess): ?>
        <p>Thank you, <?php echo htmlspecialchars($user['player_name']); ?>, for your payment!</p>
        <p>Your registration (<?php echo htmlspecialchars($user['regno']); ?>) is now complete.</p>
    <?php else: ?>
        <p>Thank you for your payment. However, there was an issue updating your payment status.</p>
        <p>Please contact support with your registration number: <?php echo htmlspecialchars($user['regno']); ?></p>
    <?php endif; ?>

    <p><a href="index.php">Return to Home</a></p>

    <!-- Add your JavaScript links here -->
</body>
</html>