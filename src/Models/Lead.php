<?php
// src/Models/Lead.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Utils/Database.php';

class Lead
{
    // Function to add a lead to the database
    public function addLead($firstName, $lastName, $email, $phoneNumber, $ip, $country, $url, $note, $sub1)
    {
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare("INSERT INTO leads (first_name, last_name, email, phone_number, ip, country, url, note, sub_1) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $ip, $country, $url, $note, $sub1]);
            return ['status' => 'success', 'message' => 'Lead added successfully'];
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage()); // Log error
            if ($e->getCode() == 23000) {
                return ['status' => 'error', 'message' => 'Email already registered'];
            } else {
                return ['status' => 'error', 'message' => 'Database error'];
            }
        }
    }


    // Function to get lead details by ID
    public function getLeadById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM leads WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Function to edit a lead by ID
    public function editLead($id, $called)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE leads SET called = ? WHERE id = ?");
        $stmt->execute([$called, $id]);
    }

    // Function to get filtered leads
    public function getFilteredLeads($filter)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM leads WHERE ";

        // Add conditional clauses based on the filter type
        // Example for 'country' filter
        if ($filter['type'] === 'country') {
            $sql .= "country = ?";
            $values = [$filter['value']];
        }
        // Add other conditions for 'called' and 'created today' filters

        $stmt = $db->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
