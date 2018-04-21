<?php include 'header.html'; ?>

<?php
    try {
        $dsn = "mysql:host=courses;dbname=z1732715";
        $pdo = new PDO($dsn, $username, $password);
    }
    catch(PDOexception $e) {
        echo "Connection to database failed: " . $e->getMessage();
    }
?>

<?php
    $sql = "SELECT * FROM MarinaSlip;"; 

    $result = $pdo->query($sql);

    $row = $result->fetch(PDO::FETCH_BOTH);

    $allrows = $result->fetchAll();
?>

<?php include 'footer.html'; ?>

