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
    $task_id = $conn->real_escape_string($_POST['task_id']);
    $sql = "DELETE FROM tasks WHERE id=$task_id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Tâche supprimée avec succès";
    } else {
        $_SESSION['message'] = "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: index.php");
exit();
?>
