<?php  
include 'Connect.php';
session_start();
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Profile.css">
    <title>Document</title>
</head>
<body>
    <div class="contaner">
        <div class="box1">
        <header>
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
      <h1>SWAP</h1>
    <form action="#" method="post">
    <div class="wrap">
      <div class="search">
      <input type="text"  placeholder="What tag you looking for?" class="searchTerm">
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
        if(!isset($_SESSION['uname'])){ ?>
        <a href="login.php"><button class ="profile">Login</button></a>
       <?php }else{ ?>
        <a href="SignOut.php"><button class ="profile">Sign out</button></a>
       <?php }?>
  </header>
        </div>
        <?php 
            $userID = $_SESSION['USERID'];
            $Profile = "SELECT * FROM user WHERE userID='$userID'";//หาข้อมูลของผู้ใช้
            $DATAu = mysqli_query($conn, $Profile);
            $DATAu = mysqli_fetch_array($DATAu);

            $PostandLike = "SELECT NumLike FROM postdetail WHERE UserPost='$userID'";//หาจำนวณยอดไลย์รวมและจำนวณโพสรวม
            $DATAp = mysqli_query($conn,$PostandLike);
            $numrow = mysqli_num_rows($DATAp);//จำนวณโพสที่ได้โพสไป
            $numLikeP=0;
            while($plustlike = mysqli_fetch_array($DATAp)){
                        // print_r($plustlike);
                        $num = $plustlike['NumLike'];
                        $numLikeP += (int)$num;
                        // echo $numLikeP;
                        // echo "<br>";
            }
            ?>
        <div class="box2">
            <div class="mainP">
                <h1>ข้อมูลรายละเอียดสมาชิก <?php echo $userID; ?></h1>
            </div>
            <div class="profileAll">
            <div class="IMG">
                        <img src="Tase.jpg" alt="">
                </div>
                <div class="Detal">
                    <ul>
                        <li>ชื่อ : <?php echo $DATAu['Name']; ?></li>
                        <li>Email : <?php echo $DATAu['Email']; ?></li>
                        <li>ยอดรวมโพส : <?php echo $numrow; ?></li>
                        <li>ยอดรวมไลค์ : <?php echo $numLikeP; ?></li>
                    </ul>
                </div>
                <div class="tagfllow">
                        <div class="tag">
                        <p>eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod m</p>
                        </div>
                </div>
                <div class="swap">
                        
                </div> 
            </div>
                
        </div>
        <div class="box3">
            <div class="menulook">
                <ul>
                    <li class="Piot"><a href="#"><h4>กระทู้ที่ฉันตั้ง</h4></a></li>
                    <li class="notPiot"><a href="#"><h4>กระทู้ที่ตอบ</h4></a></li>
                    <li class="notPiot"><a href="#"><h4>กระทู้โปรด</h4></a></li>
                </ul>
            </div>
            <div class="tabalshow">
            <?php 
                $Allpost = "SELECT * FROM postdetail WHERE UserPost='$userID'";//หาโพสทั้งหมด
                $allpost = mysqli_query($conn,$Allpost);
                while($DATAap = mysqli_fetch_array($allpost)){ ?>
                    <div id="<?php echo $DATAap['PostID']; ?>" class="subjit">
                    <div class="toppic">
                    <a href="SujiectArea.php?PostID=<?php echo $DATAap['PostID']; ?>">
                        <?php echo $DATAap['Topic']; ?></a>
                    </div>
                        <ul>
                        <li><?php echo $DATAap['Date']; ?></li>
                        <li><?php echo $DATAap['NumLike'];?></li>
                    
                    <?php
                            $postID = $DATAap['PostID'];
                            $category ="SELECT * FROM categoryonpost INNER JOIN category ON categoryonpost.ID = category.ID WHERE PostID='$postID'";
                            $catequ = mysqli_query($conn,$category);
                            while($DATAcate = mysqli_fetch_array($catequ)){ ?>
                                <li class="tag"><?php echo $DATAcate['NameCategory']; ?></li>
                           <?php } ?> 
                            <a href="Process/DeleteSujiect.php?PostID=<?php echo $DATAap['PostID']; ?>"><li>ลบกระทู้</li></a>
                            </ul>  </div>
               <?php }?>
            </div>
        </div>
    </div>
    <br>
    <br>
</body>
</html>