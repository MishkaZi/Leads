<?php
require_once 'src/Utils/Database.php'; // Include your database connection script

$db = Database::getInstance();

// Clear the leads table
$stmt = $db->prepare("DELETE FROM leads");
$stmt->execute();

// Fetch data from the JSON resource
$url = 'https://jsonplaceholder.typicode.com/users';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$jsonData = curl_exec($ch);
curl_close($ch);

$users = json_decode($jsonData, true);

// Define the list of countries
$countries = ["Israel", "USA", "Germany", "China"];

// Initialize an array to store processed emails
$emailsToInsert = [];

// Process and insert each user
foreach ($users as $user) {
    $email = $user['email'];

    // Skip if email already processed
    if (in_array($email, $emailsToInsert)) {
        continue;
    }

    $emailsToInsert[] = $email;
    $firstName = explode(' ', trim($user['name']))[0]; // Get the first name
    $lastName = explode(' ', trim($user['name']))[1] ?? 'Doe'; // Get the last name or a default value

    // Extract only digits from phone number
    $phoneNumber = preg_replace('/\D/', '', $user['phone']);

    // Generate random data for missing fields
    $ip = '192.168.1.' . rand(1, 255); // Random IP
    $country = $countries[array_rand($countries)]; // Random country from the list
    $url = $user['website'];
    $note = 'Random Note'; // Random note
    $sub1 = 'Sub-' . rand(1, 100); // Random sub_1 value
    $called = (int)(rand(0, 1) == 1); // Cast to integer

    // Insert into the database
    $stmt = $db->prepare("INSERT INTO leads (first_name, last_name, email, phone_number, ip, country, url, note, sub_1, called) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $ip, $country, $url, $note, $sub1, $called]);
}