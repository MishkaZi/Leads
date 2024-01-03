<?php
// src/leads.php

require_once 'src/Controllers/LeadController.php';

// Instantiate LeadController and handle incoming requests
$leadController = new LeadController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract POST data
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $ip = $_POST['ip'] ?? '';
    $country = $_POST['country'] ?? '';
    $url = $_POST['url'] ?? '';
    $note = $_POST['note'] ?? '';
    $sub1 = $_POST['sub_1'] ?? '';

    // Form data array
    $formData = [$firstName, $lastName, $email, $phoneNumber, $ip, $country, $url, $note, $sub1];

    // Call the addLead method and get the response
    $response = $leadController->addLead($formData);

    // Set header as JSON and echo the response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
