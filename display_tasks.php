<?php
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

// Récupérer les tâches
$sql = "SELECT id, description, status FROM tasks";
$result = $conn->query($sql);

// Vérifier si des tâches existent et les afficher
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $taskClass = $row["status"] === "terminée" ? "completed" : "pending";
        $checkmark = $row["status"] === "terminée" ? "&#10003;" : "";
        echo "<li class='$taskClass'>" . htmlspecialchars($row["description"]) . " <span class='checkmark'>$checkmark</span>";
        echo "<div class='task-actions'>";
        if ($row["status"] === "à faire") {
            echo "<form method='POST' action='mark_completed.php'>
                    <input type='hidden' name='task_id' value='" . $row['id'] . "'>
                    <button class='complete-button' type='submit'>Terminer</button>
                  </form>";
        }
        echo "<form method='POST' action='delete_task.php'>
                <input type='hidden' name='task_id' value='" . $row['id'] . "'>
                <button class='delete-button' type='submit'>Supprimer</button>
              </form>";
        echo "</div></li>";
    }
} else {
    echo "<li>Aucune tâche</li>";
}

$conn->close();
?>
