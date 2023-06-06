<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="uft8">
    </head>
    <body>
        <table align="center" border="1">
            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST" name="form1">
                <tr><td>Mã sinh viên</td><td>Họ tên sinh viên</td><td>Ngày sinh</td><td>Giới tính</td><td>Quê quán</td><td>Email</td></tr>
                <?php
                    $connect = mysqli_connect("localhost","root","","qlthuchanh");
                    mysqli_query($connect,"set names 'utf8'");
                    $masv = $_GET['masv'];
                    $result = mysqli_query($connect, "SELECT * FROM sinhvien where masv = $masv");
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo '<tr><td>'.$row['masv'].'</td><td>'.$row['hoten'].'</td><td>'.$row['ngaysinh'].'</td>
                            <td>'.($row['gioitinh'] == 0 ? "Nam" : "Nữ").'</td><td>'.$row['quequan'].'</td><td>'.$row['email'].'</td></tr>';
                    }
                ?>
            </form>
        </table>
    </body>
</html>