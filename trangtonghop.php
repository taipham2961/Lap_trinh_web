<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="uft8">
    </head>
    <body>
        <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="GET" name="formTimKiem">
            <table align="center">
                <tr>
                    <td>Tìm kiếm tên sinh viên:</td>
                    <td><input type="text" name="tensvTimKiem" value=<?php 
                        if(isset($_GET["tensvTimKiem"]))
                        {
                            $tensv = $_GET["tensvTimKiem"];
                            echo $tensv;
                        }
                    ?>></td>
                    <td><input type="submit" value="Tìm kiếm"></td>
                </tr>
            </table>
        </form>
        <table align="center" border="1">
                <tr><td>Mã sinh viên</td><td>Họ tên sinh viên</td></tr>
                <?php 
                    $connect = mysqli_connect("localhost","root","","qlthuchanh");
                    mysqli_query($connect,"set names 'utf8'");
                    $limit = 5;
                    if(isset($_GET["tensvTimKiem"]))
                    {
                        $tensv = $_GET["tensvTimKiem"];
                        $sql = "Select * from sinhvien where hoten = '".$tensv."'";
                        $result = mysqli_query($connect,$sql) or die($sql);
                    }
                    else
                    {
                        $result = mysqli_query($connect, 'select count(masv) as total from sinhvien');
                        $row = mysqli_fetch_assoc($result);
                        $total_records = $row['total'];

                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $total_page = ceil($total_records / $limit);

                        if ($current_page > $total_page)
                        {
                            $current_page = $total_page;
                        }
                        else if ($current_page < 1)
                        {
                            $current_page = 1;
                        }
                        $start = ($current_page - 1) * $limit;
                        $result = mysqli_query($connect, "SELECT * FROM sinhvien LIMIT $start, $limit");
                    }

                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo '<tr><td><a href="trangchitiet.php?masv='.$row['masv'].'">'.$row['masv'].'</a></td><td>'.$row['hoten'].'</td></tr>';
                    }
                    mysqli_close($connect);
                ?>
        </table>
        <div align="center">
            <?php
                if(!isset($_GET["tensvTimKiem"]))
                {
                    if ($current_page > 1 && $total_page > 1)
                    {
                        echo '<a href="trangtonghop.php?page='.($current_page-1).'">Prev</a> | ';
                    }
                    // Lặp khoảng giữa
                    for ($i = 1; $i <= $total_page; $i++)
                    {
                        // Nếu là trang hiện tại thì hiển thị thẻ span
                        // ngược lại hiển thị thẻ a
                        if ($i == $current_page)
                        {
                            echo '<span>'.$i.'</span> | ';
                        }
                        else
                        {
                            echo '<a href="trangtonghop.php?page='.$i.'">'.$i.'</a> | ';
                        }
                    }
                    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                    if ($current_page < $total_page && $total_page > 1)
                    {
                        echo '<a href="trangtonghop.php?page='.($current_page+1).'">Next</a> | ';
                    }
                }
            ?>
        </div>
    </body>
</html>