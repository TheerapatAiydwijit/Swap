<?php 
session_start();
    if(!isset($_SESSION['uname'])){
      header('Location: login.php');
    }
?>
<?php include 'Connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function showClik(Name,ID) {
        var check = document.getElementById(ID);
        // console.log(Name);
        var typeName = document.createElement("p");
        typeName.setAttribute("ID",ID+"n");
        typeName.innerHTML = Name ;
        console.log(typeName);
        var checkBox = document.getElementById(ID);
        var target = document.getElementById("showType");
        if (checkBox.checked == true){
            target.appendChild(typeName);
        } else {
            var tpename = document.getElementById(ID+"n");
            target.removeChild(tpename);
        }
    }
    
    </script>
</head>
<body>
    <div class="container">
    <form action="Process/addSubjiect.php" method="post">
    <p>1. ระบุคำถามของคุณ เช่น เว็บ Swap.com ก่อตั้งขึ้นตั้งแต่เมื่อไหร่ ใครพอทราบบ้าง?</p>
    <input type="text" name="Topic" maxlength="120">
    <p>2. เขียนรายละเอียดของคำถาม</p>
    <textarea rows="4" cols="50" name="Detail" maxlength="10000">
Enter text here...</textarea>
<p>3. เลือกแท็กที่เกี่ยวข้องกับกระทู้ กรุณาเลือก Tag ที่เกี่ยวข้องกับเนื้อหากระทู้ของท่าน</p>
    <div id="showType">

    </div>
<table>
    <?php 
        $Type = "SELECT * FROM category";
        $result = mysqli_query($conn, $Type);
        while($types = $result->fetch_array()) { ?>
            <tr>
                <td><input type="checkbox" name="type[]" value="<?php echo $types['ID']; ?>" id="<?php echo $types['ID']; ?>" onclick="showClik('<?php echo $types['NameCategory']; ?>','<?php echo $types['ID']; ?>')"></td>
                <td><?php echo $types['NameCategory']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <input type="submit" name="submit" value="ส่งกระทู้">
    </form>
    </div>
</body>
</html>