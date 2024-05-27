<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

session_start();

// Tableau de citations motivantes
$quotes = [
    "La seule limite à notre épanouissement de demain sera nos doutes d'aujourd'hui.",
    "N'abandonne jamais. Les miracles se produisent tous les jours.",
    "Le succès n'est pas final, l'échec n'est pas fatal : c'est le courage de continuer qui compte.",
    "Le seul moyen de faire du bon travail est d'aimer ce que vous faites.",
    "La vie est ce que vous en faites, alors prenez ce que vous voulez et profitez-en.",
    "Chaque jour est une nouvelle opportunité de changer ta vie.",
    "Le succès est la somme de petits efforts répétés jour après jour.",
    "Ton attitude détermine ton altitude.",
    "Crois en toi et tout sera possible.",
    "L'échec est le fondement de la réussite.",
    "La persévérance est la clé du succès.",
    "Faites de chaque jour votre chef-d'œuvre.",
    "Les défis sont ce qui rend la vie intéressante et les surmonter est ce qui donne un sens à la vie.",
    "Il n'est jamais trop tard pour être ce que vous auriez pu être.",
    "Votre temps est limité, ne le gaspillez pas en vivant la vie de quelqu'un d'autre."
];

// Sélectionne une citation aléatoire
$random_quote = $quotes[array_rand($quotes)];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .welcome-message {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #34495e;
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        .task-form input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-right: 10px;
        }
        .task-form button {
            padding: 10px 20px;
            border: none;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .task-form button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }
        .task-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .task-list li {
            background-color: #ecf0f1;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .task-list li:hover {
            background-color: #d0d7da;
            transform: scale(1.02);
        }
        .task-list li.completed {
            color: green;
            text-decoration: line-through;
        }
        .task-list li .task-actions {
            display: flex;
            gap: 10px;
        }
        .task-list li .task-actions form {
            display: inline;
        }
        .task-list li .task-actions button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .task-list li .task-actions .complete-button {
            background-color: #2ecc71;
            color: #fff;
        }
        .task-list li .task-actions .delete-button {
            background-color: #e74c3c;
            color: #fff;
        }
        .task-list li .task-actions .complete-button:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }
        .task-list li .task-actions .delete-button:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }
        .quote {
            margin-top: 20px;
            font-style: italic;
            color: #555;
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            background: linear-gradient(135deg, #f9f9f9 0%, #e0e0e0 100%);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            transition: all 0.3s ease-in-out;
        }
        .quote:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ma To-Do List</h1>
        <div class="welcome-message">
            Voici les tâches que vous avez à faire aujourd'hui. Restez concentré et motivé, chaque petit pas compte !
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
<form class="task-form" action="add_task.php" method="POST">
    <input type="text" name="task_name" placeholder="Nom de la tâche" required><br><br>
    <input type="text" name="task_description" placeholder="Description de la tâche" required><br><br>
    <button type="submit">Ajouter</button>
</form>
        <ul class="task-list">
            <?php include 'display_tasks.php'; ?>
        </ul>
        <div class="quote">
            <?php echo $random_quote; ?>
        </div>
    </div>
</body>
</html>
