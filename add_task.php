<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_description = $conn->real_escape_string($_POST['task_description']);
    $sql = "INSERT INTO tasks (description, status) VALUES ('$task_description', 'à faire')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Nouvelle tâche ajoutée avec succès";
    } else {
        $_SESSION['message'] = "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: index.php");
exit();
?>
