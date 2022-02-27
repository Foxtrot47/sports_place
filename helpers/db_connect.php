<?php
$servername = "localhost";
$username = "server_handle";
$password = "%YtFCNJoX3tCdE";
$dbname = "the_sports_place";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error to browser console
    echo `<script> console.log( "Database Connection failed: $conn->connect_error ") </script>`;
}
