<?php

require 'vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use PDO;

$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('POST', '/ussd', 'handleUssdRequest');
});

// Fetch method and URI from somewhere, in this case, from the global variables
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func($handler, $vars);
        break;
}

function handleUssdRequest() {
    $input = file_get_contents('php://input');
    parse_str($input, $data);

    $sessionId = $data['sessionId'] ?? '';
    $serviceCode = $data['serviceCode'] ?? '';
    $phoneNumber = $data['phoneNumber'] ?? '';
    $text = $data['text'] ?? '';

    $response = '';
    $Myarray = [];
    $reps = [];

    $pdo = new PDO('mysql:host=your-hostname;dbname=your-dbname', 'your-username', 'your-password');

    switch ($text) {
        case '':
            try {
                $stmt = $pdo->query('SELECT * FROM language');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($results) > 0) {
                    foreach ($results as $row) {
                        if ($row['id'] === 'Language') {
                            $response = 'CON What would you like to check\n';
                            $keys = array_keys($row);
                            for ($index = 1; $index < count($keys); $index++) {
                                $response .= "$index. " . $keys[$index] . "\n";
                            }
                            $response .= '*. Cancel';
                        }
                    }
                }
            } catch (Exception $e) {
                error_log("Error executing query: " . $e->getMessage());
                $response = 'END An error occurred. Please try again later.';
            }
            break;

        case '*':
            $response = "END Your phone number is $phoneNumber";
            break;

        case '1':
            try {
                $stmt = $pdo->query('SELECT questions FROM question WHERE language="English"');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($results) > 0) {
                    foreach ($results as $row) {
                        $Myarray[] = $row['questions'];
                    }
                    $response = "CON {$Myarray[0]}\n";
                    $response .= "1. Yes\n";
                    $response .= "2. No\n";

                    if ($text === '1*1') {
                        $stmt = $pdo->query('SELECT state FROM state');
                        $result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($result3) > 0) {
                            foreach ($result3 as $row) {
                                $reps[] = $row['state'];
                            }
                            $response = "CON {$Myarray[1]}\n";
                            $response .= "1. {$reps[0]}\n";
                            $response .= "2. {$reps[1]}\n";
                            $response .= "3. {$reps[2]}\n";

                            if ($text === '1') {
                                $stmt = $pdo->query('SELECT location FROM where state="' . $reps[0] . '"');
                                $result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // Handle further nested conditions here
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                error_log("Error executing query: " . $e->getMessage());
                $response = 'END An error occurred. Please try again later.';
            }
            break;

        // Add more cases as needed
    }

    header('Content-Type: text/plain');
    echo $response;
}

?>
