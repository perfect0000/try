<?php

$Q1 = $_POST['Q1'];
$Q2 = $_POST['Q2'];
$Q3 = $_POST['Q3'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "survey";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO data (Q1, Q2, Q3) VALUES ('$Q1', '$Q2', '$Q3')";
if ($conn->query($sql) === TRUE) {
    
    $rowId = $conn->insert_id;

    
    $answers = [
        'Q1' => $Q1,
        'Q2' => $Q2,
        'Q3' => $Q3
    ];

    
    $answersJson = json_encode($answers);

    
    $updateSql = "UPDATE data SET answers = '$answersJson' WHERE id = '$rowId'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Data stored successfully!";
    } else {
        echo "Error: " . $updateSql . "
" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "
" . $conn->error;
}

$conn->close();
?>

