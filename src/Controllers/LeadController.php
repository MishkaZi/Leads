<?php
// src/Controllers/LeadController.php

require_once 'Models/Lead.php';

class LeadController {
    private $leadModel;

    public function __construct() {
        $this->leadModel = new Lead();
    }

    public function addLead($formData) {
        // Validate form data or perform any additional checks
        return $this->leadModel->addLead(...$formData); // Return the result here
    }
    
    public function getLeadById($id) {
        return $this->leadModel->getLeadById($id);
    }
    
    public function editLead($id, $called) {
        $this->leadModel->editLead($id, $called);
    }
    
    public function getFilteredLeads($filter) {
        return $this->leadModel->getFilteredLeads($filter);
    }
}
