<?php

function getDbConnection() {
    try {
        // Connect to the SAME database as Laravel for demonstration
        $pdo = new PDO('sqlite:../backend/database/database.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
