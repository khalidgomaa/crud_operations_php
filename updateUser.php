<?php
include_once("config.php");
    $id = $_GET['id'];
    $edit_sql = "SELECT * FROM users WHERE id=$id";
    $edit_result = mysqli_query($connection, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_result);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        select {
            height: 35px;
        }

        input[type="file"] {
            border: none;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Student Data</h1>
    <form action="update_student.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $edit_row['name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $edit_row['email']; ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $edit_row['password']; ?>" required><br><br>

        <label for="room_no">Select Room No:</label>
        <select id="room_no" name="room_no" required>
            <option value="application1">application1</option>
            <option value="application2">application2</option>
            <option value="cloud"> cloud</option>
        </select><br><br>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*"><br><br>

        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
<?php
include_once("config.php");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $room_no = $_POST['room_no'];

    // Handle file upload for profile_picture (if provided)
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profile_picture_name = time() . $_FILES["profile_picture"]["name"];
        $profile_picture_tmpPath = $_FILES['profile_picture']['tmp_name'];
        move_uploaded_file($profile_picture_tmpPath, 'img/' . $profile_picture_name);
    } else {
        // No new profile picture uploaded, keep the existing one or handle accordingly.
        $profile_picture_name = $edit_row['profile_picture'];
    }

    // Update the student's data in the database
    $update_sql = "UPDATE users SET
        name = '$name',
        email = '$email',
        password = '$password',
        room_no = '$room_no',
        profile_picture = '$profile_picture_name'
        WHERE id = $id";

    $result = mysqli_query($connection, $update_sql);

    if ($result) {
        echo "Student data updated successfully.";
        header("Location: showusers.php");    
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>
