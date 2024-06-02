<!DOCTYPE html>
<html lang="en">
<?php
include ("regdbconnect.php");
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Registeration</title>
    <link rel="stylesheet" href="playerreg.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="images/ALPHA GENES.jpg" alt="">
            <div class="navibar">
                <a class="currentTab" href="playerreg.php">Players</a>
                <a href="teamreg.php">Teams</a>
                <a href="">Tournaments</a>
                <a href="">Newsletter</a>
            </div>
            <img src="images/ALPHA GENES.jpg" alt="">
        </div>
        <div class="main">
            <button class="fillForm fillBtn">Fill Form</button>
            <div class="content hidden">
                <div class="heading">
                    <h2>Register Here</h2>
                </div>
                <?php
                if (isset($_GET["btnSubmit"])) {
                    $name = $_GET["pname"];
                    $link = $_GET["plink"];
                    $email = $_GET["pemail"];
                    $phno = $_GET["pno"];
                    $batch = $_GET["pbatch"];
                    $igname = $_GET["pign"];
                    $igid = $_GET["pigid"];
                    $pos = $_GET["ppos"];
                    $teamid = $_GET["tid"];


                    $sql = "INSERT INTO tbl_player (playerId, playerName, playerFblink, playerEmail, playerPhno, playerBatch, `playerIgn`, playerIgid, roleId,teamId) VALUES (NULL, '$name', '$link', '$email', '$phno', '$batch', '$igname', '$igid', '$pos','$teamid')";
                    if ($conn->query($sql) == True) {
                        echo "Record inserted successfully";
                        header("location:playerreg.php");
                        exit();
                    }

                }
                if (isset($_GET["deleteid"])) {
                    $delid = $_GET["deleteid"];
                    $sql = "DELETE from tbl_player where playerId='$delid'";
                    if ($conn->query($sql) == TRUE) {
                        echo "<div> Record deleted successfully</div>";
                        header("location:playerreg.php");
                        exit();
                    }
                }
                if (isset($_GET["editid"])) {
                    $eid = $_GET["editid"];
                    $sql = "SELECT * from tbl_player WHERE playerId='$eid'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                } else {
                    // $sql = "SELECT * FROM tbl_player";
                    // $result = $conn->query($sql);
                }
                ?>

                <form action="#" method="GET">
                    <div class="register">
                        <p class="labelTag">Player Name</p>
                        <input name="pname" type="text" class="inputTag" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Facebook Link</p>
                        <input name="plink" type="url" class="inputTag" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Email</p>
                        <input name="pemail" type="email" class="inputTag" placeholder="example@gmail.com" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Phone Number</p>
                        <input name="pno" type="number" class="inputTag" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">Batch</p>
                        <input name="pbatch" type="text" class="inputTag" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">In Game Name</p>
                        <input name="pign" type="text" class="inputTag" required>
                    </div>
                    <div class="register">
                        <p class="labelTag">In Game Id</p>
                        <input name="pigid" type="text" class="inputTag" required>
                    </div>
                    <div class="register">
                        <?php
                        $ssql = "SELECT * from tbl_role";
                        $r = $conn->query($ssql);
                        ?>
                        <p class="labelTag">Role/Position</p>
                        <select name="ppos" class="selectTag" required>
                            <option>------Select Role------</option>
                            <?php
                            while ($row1 = $r->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row1['roleId']; ?>"><?php echo $row1['roleName']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="register">
                        <?php
                        $ssql = "SELECT * From tbl_team";
                        $r = $conn->query($ssql);
                        ?>
                        <p class="labelTag">Team Name</p>
                        <select name="tid" class="selectTag" required>
                            <option value="">------Select Role------</option>
                            <?php
                            while ($row1 = $r->fetch_assoc()) {
                                ?>
                                <option  value="<?php echo $row1['teamId']; ?>">
                                    <?php echo $row1['teamName']; ?>
                                </option>
                            
                                    <?php
                                
                            }
                            ?>
                        </select>
                        
                    </div>




                    <div class="register">
                        <input name="btnSubmit" type="Submit" class="buttonTag" value="Register" />
                    </div>

                </form>
                </div>
                <div class="feed">
                    <table>
                        <tr>
                            <th>ID </th>
                            <th>Player Name </th>
                            <th>Player Facebook Link</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Batch</th>
                            <th>In Game Name</th>
                            <th>In Game ID</th>
                            <th>Player Role</th>
                            <th>Team ID</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        require_once './Models/Player.php';
                        foreach ($result as $row) {


                            ?>
                            <tr>
                                <td>
                                    <?php echo $row["playerId"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerName"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerFblink"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerEmail"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerPhno"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerBatch"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerIgn"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["playerIgid"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["roleId"]; ?>
                                </td>

                                <td>
                                    <?php echo $row["teamId"]; ?>
                                </td>
                                <td>
                                    <a href="playerreg.php?editid=<?php echo $row['playerId']; ?>">Edit</a>

                                    <a href="playerreg.php?deleteid=<?php
                                    echo $row['playerId']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>

                </div>
        </div>
        <div class="footer">
            <p>&copy;SFU eSports Community.All rights reserved 2024</p>
        </div>
    </div>
    <?php
    ob_end_flush();
    ?>
    <script src="script.js"></script>
</body>

</html>