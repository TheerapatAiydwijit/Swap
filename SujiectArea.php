<?php
session_start();
if (isset($_SESSION['SujiectArea'])) {
    unset($_SESSION['SujiectArea']);
}
// session_unset();
// if(!isset($_SESSION['uname'])){
//   header('Location: login.php');
// }
include 'Connect.php';
$post = $_GET['PostID'];
// echo $post;
// session_unset()
$Show = "SELECT * FROM postdetail where PostID='$post'";
$result = mysqli_query($conn, $Show);
$datapost = mysqli_fetch_array($result, MYSQLI_ASSOC);
// echo $datapost['Topic'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css.css">
    <title>Document</title>
    <style>
        .visually-hidden {
            clip: rect(0 0 0 0);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="box1 top">
            <header>
                <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                <h1>SWAP</h1>
                <form action="#" method="post">
                    <div class="wrap">
                        <div class="search">
                            <input type="text" placeholder="What tag you looking for?" class="searchTerm">
                            <button type="submit" class="searchButton">
                                <img src="Icon/search.png" alt="#">
                            </button>
                        </div>
                    </div>
                </form>
                <nav>
                    <ul class="nav_link">
                        <li><a href="index_.php">หน้าแรก</a></li>
                        <li><a href="NewSubject.php">สร้างกระทู้</a></li>
                        <li><a href="Profile.php">อันดับผู้ใช้</a></li>
                    </ul>
                </nav>
                <?php
                if (!isset($_SESSION['uname'])) { ?>
                    <a href="login.php"><button class="profile">Login</button></a>
                <?php } else { ?>
                    <a href="SignOut.php"><button class="profile">Sign out</button></a>
                <?php } ?>
            </header>
        </div>

        <div class="Sujiect">
            <?php
            $Postdata = "SELECT * FROM postdetail WHERE PostID='$post'";
            $queryPost = mysqli_query($conn, $Postdata);
            $DATAp = mysqli_fetch_assoc($queryPost);
            ?>
            <div class="Topic">
                <h1><?php echo $DATAp['Topic']; ?></h1>
                <div class="type">
                    <ul>
                        <?php
                        $seletype = "SELECT * FROM categoryonpost INNER JOIN category ON categoryonpost.ID = category.ID WHERE categoryonpost.PostID='$post'";
                        $resulttype = mysqli_query($conn, $seletype);
                        while ($typename = mysqli_fetch_array($resulttype)) { ?>
                            <li class="nametype">
                                <p><?php echo $typename['NameCategory']; ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>


            <p><?php echo $DATAp['Detail'];  ?></p>
        </div>
        <hr>
        <div class="commentAll">
            <?php
            $comment = "SELECT * FROM comments INNER JOIN user ON comments.userID = user.userID WHERE comments.PostID='$post'";
            $queryComment = mysqli_query($conn, $comment);
            // echo "Error: " . $insert . "<br>" . $conn->error;
            while ($DATAc = mysqli_fetch_array($queryComment)) { ?>
                <!-- echo $DATAc['Name'];
                    echo "<br>"; -->
                <div class="comment" id="<?php echo $DATAc['userID']; ?>">
                    <h3 class="username"><?php print_r($DATAc['Name']); ?></h3>
                    <p class="commentdetail"><?php echo $DATAc['ComDetail']; ?></p>
                    <?php
                    if (isset($_SESSION['USERID'])) {
                        if ($DATAp['UserPost'] === $_SESSION['USERID']) { ?>
                            <div class="delte">
                                <a href="Process/DeleteComment.php?OrderCom=<?php echo $DATAc['OrderCom']; ?>&PostID=<?php echo $post; ?>">
                                    <p>ลบ</p>
                                </a>
                            </div>
                <?php }
                    }
                    echo "</div>";
                } ?>
                </div>
                <br>
                <hr>
                <br>
                <div class="commentbox">
                    <form action="Process/addcomment.php" method="post">
                        <?php
                        // echo $_SESSION['SujiectArea'];
                        if (isset($_SESSION['uname'])) { ?>
                            <input type="text" name="userID" class="visually-hidden" value="<?php echo $_SESSION['USERID']; ?>" readonly>
                            <input type="text" name="PostID" class="visually-hidden" value="<?php echo $post; ?>" readonly>
                            <label>Name :</label>
                            <input type="text" name="username" value="<?php echo $_SESSION['uname']; ?>" readonly>
                            <br>
                            <br>
                            <br>
                            <label>Comments :</label>
                            <textarea id="ccomment" class="comment-textarea required" name="comment"></textarea>
                            <input type="submit" name="submit" value="ส่งข้อความ">
                        <?php } else { ?>
                            <a href="login.php?SujiectArea=<?php echo $post; ?>"><button type="button">กรุณาสมัครสมาชิกหรือเข้าสู่ระบบก่อนแสดงความคิดเห็นครับ</button></a>
                        <?php }
                        ?>
                    </form>
                </div>
                <br>
                <br>
                <br>

</body>

</html>