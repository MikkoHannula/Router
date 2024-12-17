<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Database;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$pdo = Database::getInstance();

function executeSqlFile($pdo, $file) {
    try {
        $sql = file_get_contents(__DIR__ . '/' . $file);
        $pdo->exec($sql);
        echo "Executed $file successfully.\n";
    } catch (PDOException $e) {
        echo "Error executing $file: " . $e->getMessage() . "\n";
    }
}

function showUsage() {
    echo "Usage: php cli.php [command]\n";
    echo "Commands:\n";
    echo "  migrate       Create the database and tables.\n";
    echo "  seed          Add demo data to the database.\n";
    exit;
}

// Check command-line arguments
if ($argc < 2) {
    showUsage();
}

$command = $argv[1];

switch ($command) {
    case 'migrate':
        executeSqlFile($pdo, 'schema.sql');
        break;
    case 'seed':
        executeSqlFile($pdo, 'seed.sql');
        break;
    default:
        showUsage();
}
