<?php
include('db.php');

$query = "SELECT * FROM project_updates ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='update-card'>";
        echo "<h3>Status: " . $row['project_status'] . "</h3>";
        echo "<p>Team: " . $row['team_assigned'] . "</p>";
        echo "<p>Details: " . $row['project_details'] . "</p>";
        echo "<p>Created: " . $row['created_at'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No project updates found.";
}
?>
