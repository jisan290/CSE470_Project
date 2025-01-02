<?php
include 'fetchuserinfo.php'; // Database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $spotId = $_POST['spot_id']; // Assuming you get this from the form as well
    $complaintText = $_POST['complaint_text']; // Match this with the table column 'complaint_text'

    // Prepare the SQL statement
    $insertComplaintQuery = $conn->prepare("
        INSERT INTO complaints (user_id, spot_id, complaint_text, status, complaint_date)
        VALUES (?, ?, ?, 'Pending', NOW())
    ");
    
    // Bind parameters - user_id (i), spot_id (i), complaint_text (s)
    $insertComplaintQuery->bind_param("iis", $userId, $spotId, $complaintText);

    // Execute and check if the insertion was successful
    if ($insertComplaintQuery->execute()) {
        echo "<script>alert('Complaint submitted successfully.'); window.location.href = 'complains.php';</script>";
    } else {
        echo "<script>alert('Error submitting complaint.');</script>";
    }
    $insertComplaintQuery->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Complaint</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, textarea, button {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }
        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Submit a Complaint</h1>
    <form method="POST">
        <input type="hidden" name="user_id" value="1"> <!-- Replace this with dynamic user ID -->
        <input type="hidden" name="spot_id" value="1"> <!-- Replace this with dynamic spot ID -->
        <textarea name="complaint_text" rows="5" placeholder="Write your complaint here..." required></textarea>
        <button type="submit">Submit Complaint</button>
    </form>
</div>
</body>
</html>
