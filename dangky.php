<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf8">
	</head>
	<body>
	<table align="center">
		<form action="#" method="post" name="formdk">
			<tr><td  align="center" colspan="2">Đăng ký tài khoản</td></tr>
			<tr><td>Mã sinh viên:</td><td><input type="text" name="masv" value="<?php echo isset($_POST['masv']) ? $_POST['masv'] : ''; ?>"></tr>
			<tr><td>Mật khẩu:</td><td><input type="password" name="pass"></tr>
			<tr><td>Nhập lại mật khẩu:</td><td><input type="password" name="repass"></tr>
			<tr><td>Họ tên sinh viên:</td><td><input type="text" name="hoten" value="<?php echo isset($_POST['hoten']) ? $_POST['hoten'] : ''; ?>"></tr>
			<tr><td>Năm sinh:</td><td><input type="text" name="namsinh" value="<?php echo isset($_POST['namsinh']) ? $_POST['namsinh'] : ''; ?>"></tr>
			<tr><td>Quê quán:</td><td><input type="text" name="quequan" value="<?php echo isset($_POST['quequan']) ? $_POST['quequan'] : ''; ?>"></tr>
			<tr><td>Địa chỉ email:</td><td><input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></tr>
			<tr>
				<td align="left"><input type="submit" name="dk" value="Đăng ký"></td>
				<td align="right"><input type="submit" name="dn" value="Đăng nhập"></tr>
		</form>
	</table>
	</body>
</html>
<?php
	if (isset($_POST['masv']) && isset($_POST['pass']) &&
		isset($_POST['repass']) && isset($_POST['hoten']) &&
		isset($_POST['namsinh']) && isset($_POST['quequan']) &&
		isset($_POST['email']))
	{
		if(isset($_POST["dk"]))
		{
			$masv = $_POST['masv'];
			$matkhau = md5($_POST['pass']);
			$nhaplaimatkhau = md5($_POST['repass']);
			$hoten = $_POST['hoten'];
			$namsinh = $_POST['namsinh'];
			$quequan = $_POST['quequan'];
			$email = $_POST['email'];
			$connect=mysqli_connect("localhost","root","","qlthuchanh")or die ("Không kết nối được");
			mysqli_query($connect,"set names'utf8'");
			$lenh="insert into tbthongtin(masv,matkhau,hoten,namsinh,quequan,email) values 
					('".$masv."','".$matkhau."','".$hoten."','".$namsinh."','".$quequan."','".$email."')";
			if($matkhau != $nhaplaimatkhau || str_word_count($_POST['pass']) == 0)
			{
				echo "Nhập sai mật khẩu";
			}
			else
			{
				$lenhkt="select * from tbthongtin where masv='".$masv."'";
				$kq = mysqli_query($connect,$lenhkt);
				if($dong=mysqli_fetch_array($kq))
				{
					echo"Tên tài khoản đã tồn tại";
				}
				else
				{
					$results=mysqli_query($connect,$lenh) or die ("Không thực hiện được");
					if($results)
					{
						echo"Đã đăng ký thành công";
						header("location:dangky.php");
					}
					else
					{
						echo "Đăng ký thất bại";
					}
				}
			}	
			mysqli_close($connect);
		}elseif(isset($_POST["dn"]))
        {
            header("location:dangnhap.php");
        }
	}
?>