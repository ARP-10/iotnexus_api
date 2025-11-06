<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=iotnexus_db", "iotnexus_db_user37826", "10tnexus_2025");
    echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
