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

$forumID = $_POST['forumID'] ?? '';
$comments = [];

// Fetch comments including information about the lawyer
$query = "SELECT c.*, u.name,u.userID, u.lastname, u.profilePic 
          FROM comments c
          INNER JOIN lawyer l ON c.lawyerID = l.id
          INNER JOIN user u ON l.userID = u.userID
          WHERE c.forumID = '$forumID'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comment = [
            "commentID" => $row['commentID'],
            "forumID" => $row['forumID'],
            "content" => $row['content'],
            "date" => $row['date'],
            "name" => $row['name'],
            "lastname" => $row['lastname'],
            "profilePic" => $row['profilePic'],
            "userID"=>$row['userID'],
        ];
        $comments[] = $comment;
    }
    echo json_encode(["success" => true, "comments" => $comments]);
} else {
    echo json_encode(["success" => false, "error" => "No comments found"]);
}

$conn->close();
?>
