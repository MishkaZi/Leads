<?php
// database/migrations/create_leads_table.php

require_once 'src/Utils/Database.php';

$db = Database::getInstance();
$query = "
    CREATE TABLE IF NOT EXISTS leads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        phone_number VARCHAR(20),
        ip VARCHAR(50),
        country VARCHAR(100),
        url TEXT,
        note TEXT,
        sub_1 TEXT,
        called BOOLEAN DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";
$db->exec($query);
