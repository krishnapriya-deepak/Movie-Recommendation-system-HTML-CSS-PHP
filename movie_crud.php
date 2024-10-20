<?php
// Database connection parameters
$hostname = "localhost";
$username = "root";
$password = "";
$database = "web";

// Establish database connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert a new movie
if (isset($_POST['insert'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO movies (title, genre, rating) VALUES ('$title', '$genre', '$rating')";
    if (mysqli_query($connection, $sql)) {
        echo "New movie added successfully.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Function to delete a movie by ID
if (isset($_POST['delete'])) {
    $id = $_POST['movie_id'];
    $sql = "DELETE FROM movies WHERE id = $id";
    if (mysqli_query($connection, $sql)) {
        echo "Movie deleted successfully.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Function to update a movie by ID
if (isset($_POST['update'])) {
    $id = $_POST['movie_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];

    $sql = "UPDATE movies SET title = '$title', genre = '$genre', rating = '$rating' WHERE id = $id";
    if (mysqli_query($connection, $sql)) {
        echo "Movie updated successfully.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Function to view all movies
if (isset($_POST['view'])) {
    $sql = "SELECT * FROM movies";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Movie List</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Rating</th>
                </tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["title"] . "</td>
                    <td>" . $row["genre"] . "</td>
                    <td>" . $row["rating"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No movies found.";
    }
}

// Close the database connection
mysqli_close($connection);
?>
