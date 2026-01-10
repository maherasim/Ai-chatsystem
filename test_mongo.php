<?php
try {
    if (class_exists('MongoDB\Driver\Manager')) {
        echo "MongoDB\Driver\Manager class exists.\n";
        $m = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        echo "Manager instance created.\n";
    } else {
        echo "MongoDB\Driver\Manager class NOT found.\n";
    }
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
