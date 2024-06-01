<!DOCTYPE html>
<html lang="en">
<?php
include ("regdbconnect.php");
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Registration</title>
</head>

<body>
    <style>
        table,
        th,
        td {
            padding: 10px;
            width: fit-content;
            height: fit-content;
            border: 3px solid darkgreen;
            border-collapse: collapse;
        }

        body {
            background-image: url(images/wpaper.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 0 auto;
            width: 1520px;
        }

        .header {
            display: flex;
            flex-direction: row;
            height: 15%;
            justify-content: space-between;
        }

        .navibar {
            display: flex;
            flex-direction: row;
            width: 60%;
            justify-content: space-around;
            align-items: center;
        }

        .navibar a {
            background-color: red;
            text-decoration: none;
            font-size: 20px;
            border-radius: 10%;
            border: 6px solid white;
            padding: 10px 15px;
            color: black;
        }

        .navibar a:hover {
            background-color: black;
            color: red;
        }

        .header img {
            width: 7%;
            border: 6px solid white;
            border-radius: 50%;
        }

        .main {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            height: 75%;
        }

        .content {
            margin: 0 auto;
            padding-top: 20px;
            width: 40%;
            height: 100%;
            background-color: rgb(98, 116, 210);
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .register {
            margin: 20px 0px;
            padding: 0px 30px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 60px;
        }

        .heading {
            height: 20px;
            padding-left: 2px;
            justify-content: center;
        }

        .labelTag {
            font-size: 19px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .inputTag {
            height: 80%;
            width: 50%;
        }

        .buttonTag {
            margin: 10px 40%;
            width: 30%;
            height: 75%;
        }

        .feed {
            text-align: center;
            margin: 0 auto;
            width: fit-content;
            height: fit-content;
            background-color: rgba(255, 255, 255, 0.85);
        }

        .footer {
            margin: 0 auto;
            width: fit-content;
            background-color: blanchedalmond;
            height: 50px;
            text-align: center;
            align-content: center;
        }

        .whImg {
            width: 100px;
            height: 100px;
        }

        .currentTab {
            border-color: blue;
        }

        .hidden {
            display: none;
        }

        .fillBtn {
            width: 100px;
            height: 50px;
        }
    </style>
    <div class="container">
        <div class="header">
            <img src="images/ALPHA GENES.jpg" alt="">
            <div class="navibar">
                <a href="playerreg.php">Players</a>
                <a class="currentTab" href="teamreg.php">Teams</a>
                <a href="">Tournaments</a>
                <a href="">Newsletter</a>
            </div>
            <img src="images/ALPHA GENES.jpg" alt="">
        </div>
        <div class="main">
            <button class="fillForm fillBtn">Fill Form</button>
            <div class="content hidden">
                <div class="register heading">
                    <h2>Register Your Team Here</h2>
                </div>
                <?php
                if (isset($_POST["btnSubmit"])) {
                    $name = $_POST["tname"];
                    $email = $_POST["temail"];
                    $phno = $_POST["tno"];

                    if (isset($_FILES["tfile"]) && $_FILES["tfile"]["error"] == 0) {
                        $filename = $_FILES["tfile"]["name"];
                        $filepatch = $_FILES["tfile"]["tmp_name"];
                    } else {
                        $filename = "";
                    
                    }

                    $sql = "INSERT INTO tbl_team (teamId, teamName, teamEmail, teamPhno, teamImage) VALUES (NULL, '$name','$email', '$phno','$filename')";
                    if ($conn->query($sql) == True) {
                        echo "Record inserted successfully";
                        move_uploaded_file($filepatch, "uploadfiles/" . $filename);
                        header("location:teamreg.php");
                        exit();
                    }
                }

                if (isset($_POST["btnUpdate"])) {
                    $id = $_POST["tid"];
                    $name = $_POST["tname"];
                    $email = $_POST["temail"];
                    $phno = $_POST["tno"];

                    $sql = "UPDATE tbl_team SET teamName='$name', teamEmail='$email', teamPhno='$phno' WHERE teamId='$id'";
                    if ($conn->query($sql) == True) {
                        echo "<div>Successfully Updated One Record!</div>";
                        header("location:teamreg.php");
                        exit();
                    }
                }

                if (isset($_GET["deleteid"])) {
                    $delid = $_GET["deleteid"];
                    $sql = "DELETE FROM tbl_team WHERE teamId = '$delid'";
                    if ($conn->query($sql) == TRUE) {
                        echo "<div> Record deleted successfully</div>";
                        header("location:teamreg.php");
                        exit();
                    }
                }

                if (isset($_GET["editid"])) {
                    $eid = $_GET["editid"];
                    $sql = "SELECT * from tbl_team WHERE teamId='$eid'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                }
                ?>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="register">
                        <p class="labelTag">Team Name</p>
                        <input name="tname" type="text" class="inputTag" value="<?php echo isset($row) ? $row['teamName'] : ''; ?>" required>
                    </div>

                    <div class="register">
                        <p class="labelTag">Team Email</p>
                        <input name="temail" type="email" class="inputTag" value="<?php echo isset($row) ? $row['teamEmail'] : ''; ?>" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Team Phone Number</p>
                        <input name="tno" type="number" class="inputTag" value="<?php echo isset($row) ? $row['teamPhno'] : ''; ?>" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Upload Team Logo</p>
                        <input name="tfile" type="file" class="inputTag">
                    </div>
                    <?php if (isset($row)) { ?>
                        <input type="hidden" name="tid" value="<?php echo $row['teamId']; ?>">
                        <div class="register">
                            <input name="btnUpdate" type="Submit" class="buttonTag" value="Update">
                        </div>
                    <?php } else { ?>
                        <div class="register">
                            <input name="btnSubmit" type="Submit" class="buttonTag" value="Register">
                        </div>
                    <?php } ?>
                </form>
                <?php
                $sql = "SELECT * from tbl_team";
                $result = $conn->query($sql);
                if ($result->num_rows > 0 && !isset($_GET['editid'])) {
                ?>
            </div>
            <div class="feed">
                <table>
                    <tr>
                        <th>Team ID</th>
                        <th>Team Name</th>
                        <th>Team Email</th>
                        <th>Team Phone Number</th>
                        <th>Team Logo</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["teamId"]; ?></td>
                            <td><?php echo $row["teamName"]; ?></td>
                            <td><?php echo $row["teamEmail"]; ?></td>
                            <td><?php echo $row["teamPhno"]; ?></td>
                            <td><img class="whImg" src="<?php echo "uploadfiles\\" . $row['teamImage']; ?>" alt=""></td>
                            <td>
                                <a href="teamreg.php?editid=<?php echo $row['teamId'] ?>">Edit</a>
                                <a href="teamreg.php?deleteid=<?php echo $row['teamId'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <?php } ?>
        </div>
        <div class="footer">
            <p>&copy;SFU eSports Community. All rights reserved 2024</p>
        </div>
    </div>

<?php
ob_end_flush();
?>
<script src="script.js"></script>
</body>

</html>
