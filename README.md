# Media Supreme - Leads

## Description
A landing page for the company that saves the clients details in order to call them back. 

## Installation
1. Clone the repository: `git clone https://github.com/MishkaZi/Leads.git` (or use provided files)
2. Navigate to the project directory: `cd project-directory`
3. Install dependencies: `composer install`

## Configuration
1. Rename the `.env.example` file to `.env`.
2. Open the `.env` file and update the configuration variables as needed.
 

## Usage
1. Install php, create `leads_db`.
1. Start the application: `php -S localhost:8000`
2. Open your web browser and navigate to `http://localhost:8000`.
3. For migration run `php database/migrations/create_leads_table.php`
4. For seeding leads run `php database/seed/seed.php`
 

## Testing
Run tests: `php src/Tests/testLeads.php` (adjust info in test file accordingly.)
