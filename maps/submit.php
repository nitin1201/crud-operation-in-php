<?php
include 'conn.php';
include 'header.php'; 

// Check if form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $rollno = htmlspecialchars($_POST['rollno']);
    $class = htmlspecialchars($_POST['class']);
    $email = htmlspecialchars($_POST['email']);

    // SQL query to insert data into database
    $sql = "INSERT INTO solutions (name, rollno, class, email)
            VALUES ('$name', '$rollno', '$class', '$email')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo '<div style="text-align: center;">';
        echo "<h2>Submitted Information</h2>";
        echo "Name: " . $name . "<br>";
        echo "Roll Number: " . $rollno . "<br>";
        echo "Class: " . $class . "<br>";
        echo "Email: " . $email . "<br>";
        echo '</div>';
    } else {
        // Display error message if insert fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if delete request is sent
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // SQL query to delete record
    $sql = "DELETE FROM solutions WHERE id = $delete_id";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo '<div style="text-align: center;">';
        echo "Record deleted successfully.<br>";
        echo '</div>';
    } else {
        // Display error message if delete fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch data from database
$sql = "SELECT * FROM solutions";
$result = $conn->query($sql);

// Display fetched data in a table
if ($result->num_rows > 0) {
    echo '<div style="text-align: center;">';
    echo '<h2>DATABASE RECORD</h2>';
    echo '<table style="border-collapse: collapse; width: 56%; margin: 20px auto; border: 1px solid #999;">'; 
    echo '<thead><tr style="background-color: #f2f2f2;"><th style="padding: 8px; border: 1px solid #999;">ID</th>
    <th style="padding: 8px; border: 1px solid #999;">Name</th>
    <th style="padding: 8px; border: 1px solid #999;">Roll Number</th>
    <th style="padding: 8px; border: 1px solid #999;">Class</th>
    <th style="padding: 8px; border: 1px solid #999;">Email</th>
    <th style="padding: 8px; border: 1px solid #999;">Delete</th>
    <th style="padding: 8px; border: 1px solid #999;">update</th>
    </tr></thead><tbody>';
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['rollno'] . '</td>';
        echo '<td>' . $row['class'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td><a href="?delete_id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a></td>';
        echo '<td><a href="update.php?id=' . $row['id'] . '">Update</a>  ';
        echo '</tr>';
    }
    
    echo '</tbody></table>';
    echo '</div>';
} else {
    // Display message if no records found
    echo '<div style="text-align: center;">';
    echo 'No records found';
    echo '</div>';
}

// Close database connection
$conn->close();
?>
