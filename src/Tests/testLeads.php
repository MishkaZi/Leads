<?php
require_once __DIR__ . '/../Controllers/LeadController.php';

// Instantiate the controller
$leadController = new LeadController();

// Test getLeadById
echo "Testing getLeadById:\n";
$testLeadId = 69; // Replace with a valid lead ID in your database
$lead = $leadController->getLeadById($testLeadId);
echo "Lead Details: " . print_r($lead, true) . "\n";

// Test editLead
echo "Testing editLead:\n";
$editLeadId = 69; // Replace with a valid lead ID in your database
$calledStatus = 0; // Change to false as needed
$leadController->editLead($editLeadId, $calledStatus);
echo "Lead with ID $editLeadId marked as called.\n";

// Check if the edit was successful
$updatedLead = $leadController->getLeadById($editLeadId);
echo "Updated Lead Details: " . print_r($updatedLead, true) . "\n";

// Test getFilteredLeads
// Test with different filter scenarios
$filters = [
    ['country' => 'USA', 'called' => 0, 'created_at' => date('Y-m-d')],  // Example for today
    ['country' => 'USA', 'called' => 0],  // Example without created_at
    ['created_at' => date('Y-m-d', strtotime('-1 day'))],  // Yesterday
];

foreach ($filters as $filter) {
    $results = $leadController->getFilteredLeads($filter);
    echo "Filter: " . json_encode($filter) . "\n";
    echo "Results: " . json_encode($results) . "\n\n";
}

?>
