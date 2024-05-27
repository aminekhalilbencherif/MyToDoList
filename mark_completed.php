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
    
    // Récupérer la description de la tâche
    $sql = "SELECT description FROM tasks WHERE id=$task_id";
    $result = $conn->query($sql);
    $task_description = '';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $task_description = $row['description'];
    }

    // Marquer la tâche comme terminée
    $sql = "UPDATE tasks SET status='terminée' WHERE id=$task_id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "La tâche \"$task_description\" est complétée";
    } else {
        $_SESSION['message'] = "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: index.php");
exit();
?>
