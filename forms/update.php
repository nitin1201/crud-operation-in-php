<?php
include 'conn.php';
include 'header.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the current data for the record
    $sql = "SELECT * FROM solutions WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if ($row) {
        $name = $row['name'];
        $rollno = $row['rollno'];
        $class = $row['class'];
        $email = $row['email'];
    } else {
        echo 'No record found with the given ID.';
        exit;
    }
} else {
    echo 'No ID provided.';
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $rollno = htmlspecialchars($_POST['rollno']);
    $class = htmlspecialchars($_POST['class']);
    $email = htmlspecialchars($_POST['email']);

    // Update query
    $sql = "UPDATE solutions SET name='$name', rollno='$rollno', class='$class', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<div style="text-align: center;">
    <h2>Update Record</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" value="<?php echo $name; ?>"><br>
        Roll Number: <input type="text" name="rollno" value="<?php echo $rollno; ?>"><br>
        Class: <input type="text" name="class" value="<?php echo $class; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
        <input type="submit" value="Update">
    </form>
</div>

<?php
$conn->close();
?>
