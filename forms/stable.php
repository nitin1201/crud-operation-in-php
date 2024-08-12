<?php
include 'conn.php';
include 'header.php';
?>
<div style="text-align: center;">
    <?php
    // Fetch data from database
    $sql = "SELECT * FROM solutions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<h2>Student Information</h2>';
        echo '<table style="border-collapse: collapse; width: 56%; margin: 20px auto; border: 1px solid #999;">'; 
        echo '<thead><tr style="background-color: #f2f2f2;"><th style="padding: 8px; border: 1px solid #999;">ID</th><th style="padding: 8px; border: 1px solid #999;">Name</th>
        <th style="padding: 8px; border: 1px solid #999;">Roll Number</th><th style="padding: 8px; border: 1px solid #999;">Class</th><th style="padding: 8px; border: 1px solid #999;">Email</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['rollno'] . '</td>';
            echo '<td>' . $row['class'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No records found';
    }
    $conn->close();
    ?>
</div>
