<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

$servername = "41.111.198.131";
$username = "lega";
$password = "e23kEJrE";
$dbname = "lega";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$userId = $_POST['lawyerId'] ?? '';
if (empty($userId)) {
    die(json_encode(["error" => "User ID not provided"]));
}

// Retrieve service requests for the lawyer along with client details
//AND sr.status != 'accepted'
$query = "SELECT sr.serviceRequestID, sr.clientID, sr.serviceID, sr.status, sr.content, sr.Request_Date, 
u.name AS clientName, u.lastname AS clientLastName, u.userID AS clientUserID
FROM servicerequest sr
INNER JOIN client c ON sr.clientID = c.clientID
INNER JOIN user u ON c.userID = u.userID
WHERE sr.lawyerID = (SELECT id FROM lawyer WHERE userID = '$userId') ";


$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $serviceRequests = [];
    while ($row = $result->fetch_assoc()) {
        $serviceRequest = [
            "content"=>$row['content'],
            "serviceRequestID" => $row['serviceRequestID'],
            "clientName" => $row['clientName'],
            "clientLastName" => $row['clientLastName'],
            "serviceID" => $row['serviceID'],
            "status" => $row['status'],
            "requestDate" => date("Y-m-d", strtotime($row['Request_Date']))
        ];
        $serviceRequests[] = $serviceRequest;
    }
    echo json_encode(["success" => true, "serviceRequests" => $serviceRequests]);
} else {
    echo json_encode(["success" => false, "error" => "No service requests found for this lawyer"]);
}

$conn->close();
?>
