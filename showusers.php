<!DOCTYPE html>
<html>
<head>
    <title>Student Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }

        .edit-button,
        .delete-button {
            margin-right: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .edit-button {
            background-color: #28a745;
            color: #fff;
        }

        .delete-button {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Student Data</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
          

            <th>room No</th>
            <th>profile_picture</th>
            <th>Actions</th>
        </tr>

        <?php
        include_once("config.php");

        $sql = "SELECT * FROM users";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row["room_no"] . '</td>';
                echo "<td><img src='img/{$row['profile_picture']}' alt='Profile Picture' width='100'></td>";
                echo '<td class="action-buttons">
                        <a class="edit-button" href="updateUser.php?id=' . $row["id"] . '">Edit</a>
                        <a class="delete-button" href="?delete=1&delete_id=' . $row["id"] . '">Delete</a>
                      </td>';
                echo '</tr>';
            }
            mysqli_free_result($result);
        } else {
            echo '<tr><td colspan="5">No data available</td></tr>';
        }

        // mysqli_close($connection);
        ?>
    </table>
</body>
</html>
  <?php 
include_once("config.php");


if (isset($_GET['delete'])) {
    $id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM users WHERE id=$id";
 
    $result = mysqli_query($connection, $delete_sql);
    if (!$result) {
        die("Delete query failed: " . mysqli_error($connection));
    }

    header("Location: showusers.php");
}
 ?>
    


