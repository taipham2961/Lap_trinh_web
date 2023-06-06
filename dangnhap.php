<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="uft8">
    </head>
    <body>
        <table align="center">
            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST" name="formdn">
                <tr><td colspan="2" align="center"><h1>Đăng nhập tài khoản</h1></td></tr>
                <tr><td colspan="2" align="center">
                    <input type="text" name="masv" placeholder="Nhập mã sinh viên" value="<?php echo isset($_POST['masv']) ? $_POST['masv'] : ''; ?>">
                </td></tr>
                <tr><td colspan="2" align="center">
                    <input type="password" name="matkhau" placeholder="Nhập mật khẩu">
                </td></tr>
                <tr>
                    <td align="center">
                        <input type="submit" name="dn" value="Đăng nhập">
                        <input type="submit" name="dk" value="Đăng ký">
                    </td>
                </tr>
            </form>
        </table>
    </body>
</html>
<?php
    if(isset($_POST["masv"]) && isset($_POST["matkhau"]))
    {
        $masv = $_POST["masv"];
        $matkhau = md5($_POST["matkhau"]);
        if(isset($_POST["dn"]))
        {
            $connect = mysqli_connect("localhost","root","","qlthuchanh");
            mysqli_query($connect,"set names 'utf8'");
            $sql = "Select masv,matkhau from sinhvien";
            $result = mysqli_query($connect,$sql) or die("Lỗi!");
            while($row = mysqli_fetch_assoc($result))
            {
                if($row['masv'] == $masv && $row['matkhau'] == $matkhau)
                {
                    header("location:trangtonghop.php");
                }
            }
            echo "Sai mã sinh viên hoặc mật khẩu!";
            mysqli_close($connect);
        }elseif(isset($_POST["dk"]))
        {
            header("location:dangky.php");
        }
    }
?>