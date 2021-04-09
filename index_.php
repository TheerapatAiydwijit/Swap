<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="grid.css">
  <title>Document</title>
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("mySidenav2").style.width = "0";
      document.getElementById("mySidenav2").style.display = "none";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0%";
      document.getElementById("mySidenav2").style.width = "5%";
      document.getElementById("mySidenav2").style.display = "block";
    }

    function show_more_menu(n) {
      console.log(n);
      for (let index = 1; index < n; index++) {
        var newN = "n" + index;
        console.log(newN);
        document.getElementById(newN).style.display = "block";
      }
      document.getElementById("lookAll").style.display = "block";
      document.getElementById("lookmore").style.display = "none";
    }

    function show_less_menu(n) {
      console.log(n);
      for (let index = 1; index < n; index++) {
        var newN = "n" + index;
        console.log(newN);
        document.getElementById(newN).style.display = "none";
      }
      document.getElementById("lookAll").style.display = "none";
      document.getElementById("lookmore").style.display = "block";
    }
  </script>
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
            <li><a href="NewSubject.php">สร้างกระทู้</a></li>
            <li>แท็กทั้งหมด</li>
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

    <div class="box2 lefit">
      <div class="menubar" id="mySidenav">
        <a href="#" onclick="closeNav()"><img src="Icon/close.png" alt="" class="closs"></a>
        <ul>
          <li><a href="#"><img src="Icon/home.png">หน้าแรก</a></li>
          <li><a href="#"><img src="Icon/feed.png">My Feed</a></li>
          <li><a href="#"><img src="Icon/connection.png"> กระทู้แนะนำ</a></li>
          <li><a href="#"><img src="Icon/email.png"> ติดต่อเรา</a></li>
        </ul><br>
        <ul class="cont">
          <li>ข้อบังคับต่างๆ</li><br>
          <li>ติดต่อเพื่อลงโฆณา</li><br>
        </ul>
        <!-- อันนี้อยู่ติดขอบล่าง -->
        <ul class="butom">
          <li>ติดตามเราได้ที่</li>
          <li><img src="Icon/facebook.png" alt=""></li>
          <li><img src="Icon/earth.png" alt=""></li>
        </ul>
      </div>

      <div class="menubarAnothersize" id="mySidenav2">
        <ul>
          <li><a href="#"><img src="Icon/home.png"></a></li>
          <li><a href="#"><img src="Icon/feed.png"></a></li>
          <li><a href="#"><img src="Icon/connection.png"></a></li>
          <li><a href="#"><img src="Icon/email.png"></a></li>
        </ul>
      </div>
    </div>
    <div class="box3 center">
      <?php
      $date = date('d m Y');
      ?>
      <h1>แนะนำโดย Swap</h1>
      <p class="datetop">กระทู้ที่มีคนถูกใจมาที่สุดในขณะนี้ <?php echo $date; ?></p>
      <div class="AllSujiect">
        <?php
        include 'Connect.php';
        $select = "SELECT * FROM postdetail ORDER BY NumLike desc";
        $query = mysqli_query($conn, $select);
        $i = 1;
        $x = 0;
        $num = 1;
        while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
          if ($i > 14) {
            break;
          }
          if ($i >= 9) { ?>
            <div class="Sujiect showmoretopic" id="n<?php echo $num; ?>">
              <div class="toppic">
                <h6><a href='SujiectArea.php?PostID=<?php echo $data['PostID']; ?>'><?php echo $data['Topic']; ?></a></h6>
              </div>
              <div class="detail">
                <ul>
                  <li class="date">
                    <?php echo $data['Date']; ?>
                  </li>
                  <li class="like">
                    <?php echo $data['NumLike']; ?>
                  </li>
                </ul>
              </div>
            </div>
          <?php $num++;
          } else { ?>
            <div class="Sujiect" id="<?php echo $data['PostID']; ?>">
              <div class="toppic">
                <h6><a href='SujiectArea.php?PostID=<?php echo $data['PostID']; ?>'><?php echo $data['Topic']; ?></a></h6>
              </div>
              <div class="detail">
                <ul>
                  <li class="date">
                    <?php echo $data['Date']; ?>
                  </li>
                  <li class="like">
                    <?php echo $data['NumLike']; ?>
                  </li>
                </ul>
              </div>
            </div>
        <?php   }
          $i++;
        } ?>
        <div class="more" id="lookmore">
          <center>
            <a href="javascript:show_more_menu(<?php echo $num; ?>);">
              ดูเพิ่มเติม...
            </a>
          </center>
        </div>
        <div class="more all" id="lookAll">
          <center>
            <a href="javascript:show_less_menu(<?php echo $num; ?>);">
              ดูน้อยลง
            </a>
          </center>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="box4 rift">
                <h1>box4</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus facilis numquam repellat doloribus omnis error necessitatibus in, totam consequuntur, incidunt deleniti quas culpa nobis esse velit modi, voluptatum repellendus. Vero.</p>
        </div> -->
  </div>
  <br><br>
</body>

</html>