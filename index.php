<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
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
    <h1>Registration Form</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="room_no">Select Room No:</label>
        <select id="room_no" name="room_no" required>
            <option value="application1">application1</option>
            <option value="application2">application2</option>
            <option value="cloud">cloud</option>
        </select><br><br>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture"><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

<?php
include_once("config.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ppassword = md5($_POST['password']); 
    $room_no = $_POST['room_no'];
    
    // Handle file upload for profile_picture
    $profile_picture_name = time() . $_FILES["profile_picture"]["name"];
    $profile_picture_tmpPath = $_FILES['profile_picture']['tmp_name'];
    move_uploaded_file($profile_picture_tmpPath, 'img/' . $profile_picture_name);

    $sql = "INSERT INTO users (name, email, password, room_no, profile_picture)
            VALUES ('$name', '$email', '$ppassword', '$room_no', '$profile_picture_name')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "User registered successfully.";
        header("Location: showusers.php");
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>
