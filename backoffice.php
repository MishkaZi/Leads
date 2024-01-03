<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once 'src/Utils/Database.php';
$db = Database::getInstance();

$stmt = $db->prepare("SELECT * FROM leads");
$stmt->execute();
$leads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>BackOffice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <span class="navbar-brand mb-0 h1">BackOffice</span>
        <a href="login.php" class="btn btn-secondary">Go Back</a>
    </nav>
    <div class="container">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Called</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($lead['id']); ?></td>
                        <td><?php echo htmlspecialchars($lead['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($lead['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($lead['called'] ? 'Yes' : 'No'); ?></td>
                        <td><?php echo htmlspecialchars($lead['phone_number']); ?></td>
                        <td>
                            <?php if ($lead['called']) : ?>
                                <a href="mark_as_called.php?id=<?php echo $lead['id']; ?>&called=0" class="btn btn-sm btn-danger">Remove</a>
                            <?php else : ?>
                                <a href="mark_as_called.php?id=<?php echo $lead['id']; ?>&called=1" class="btn btn-sm btn-success">Called</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>