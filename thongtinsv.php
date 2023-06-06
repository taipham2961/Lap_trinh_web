<?php
    if(isset($_GET['changed']))
    {
        echo "Update thành công";
    }
    function info()
    {
        $masv = $_GET['masv'];
        $connect = mysqli_connect("localhost","root","","qlthuchanh")or die ("Không kết nối được");
        mysqli_query($connect,"set names'utf8'");
        $sql = "Select * from sinhvien where masv = $masv";
        $result = mysqli_query($connect,$sql) or die("Lỗi!");
        $row = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        return $row;
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="uft8">
    </head>
    <body>
        <table align="center">
            <form action="#" method="POST" name="formtt">
                <tr><td colspan="2">Thông tin sinh viên</td></tr>
                <tr><td>Mã sinh viên:</td><td><input type="text" name="masv" value="<?php echo info()['masv']; ?>" readonly></tr>
                <tr><td>Họ tên sinh viên:</td><td><input type="text" name="hoten" value="<?php echo info()['hoten']; ?>"></tr>
			    <tr><td>Ngày sinh:</td><td><input type="text" name="ngaysinh" value="<?php echo info()['ngaysinh']; ?>"></tr>
			    <tr><td>Giới tính:</td><td><input type="text" name="gioitinh" value="<?php echo info()['gioitinh'] == false ? 'Nam' : 'Nữ'; ?>"></tr>
                <tr><td>Quê quán:</td><td><input type="text" name="quequan" value="<?php echo info()['quequan']; ?>"></tr>
			    <tr><td>Địa chỉ email:</td><td><input type="text" name="email" value="<?php echo info()['email']; ?>"></tr>
                <tr><td colspan="2"><input type="submit" name="dk" value="Thay đổi thông tin"></td></tr>
            </form>
        </table>
    </body>
</html>
<?php
    if (isset($_POST['masv']) && isset($_POST['hoten']) &&
        isset($_POST['ngaysinh']) && isset($_POST['gioitinh']) &&
        isset($_POST['quequan'])&& isset($_POST['email']))
    {
        $masv = $_POST['masv'];
        $hoten = $_POST['hoten'];
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'] == 'Nam' ? 0 : 1;
        $quequan = $_POST['quequan'];
        $email = $_POST['email'];
        $connect = mysqli_connect("localhost","root","","qlthuchanh")or die ("Không kết nối được");
        mysqli_query($connect,"set names'utf8'");
        $sql = "Update sinhvien set hoten = '".$hoten."', ngaysinh = '".$ngaysinh."', gioitinh = '".$gioitinh."', quequan = '".$quequan."', email = '".$email."' where masv = $masv";
        if(mysqli_query($connect,$sql))
        {
            echo "<script>window.location='thongtinsv.php?masv=".$masv."&changed'</script>";
        }
        else
        {
            echo "Update thất bại" . mysqli_error($connect);
        }
        $_POST['hoten'] = info()['hoten'];
        mysqli_close($connect);
    }
?>