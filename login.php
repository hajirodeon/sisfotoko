<?php
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//// SISFO-TOKO v2.1                                 ////
/////////////////////////////////////////////////////////
//// Dibuat Oleh :                                   ////
////    Agus Muhajir, S.Kom                          ////
/////////////////////////////////////////////////////////
//// URL    : http://hajirodeon.wordpress.com/       ////
//// E-Mail : hajirodeon@yahoo.com                   ////
//// HP/SMS : 081-829-88-54                          ////
/////////////////////////////////////////////////////////
//// Milist :                                        ////
////    http://yahoogroup.com/groups/linuxbiasawae/  ////
////    http://yahoogroup.com/groups/sisfokol/       ////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/login_adm.html");


nocache;

//nilai
$filenya = "login.php";
$judul = $nama_toko;
$diload = "document.formx.tipe.focus();";

$x_enter = 'onkeydown="return handleEnter(this, event)"';
$x_enter2 = 'onkeydown="if (keyCode == 13)
				{
				document.formx.btnOK.focus();
				document.formx.btnOK.submit();
				}"';



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnOK'])
	{
	//ambil nilai
	$tipe = nosql($_POST["tipe"]);
	$username = nosql($_POST["usernamex"]);
	$password = md5(nosql($_POST["passwordx"]));

	//cek
	if ((empty($tipe)) OR (empty($username)) OR (empty($password)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika kasir/pembuat nota /////////////////////////////////////////////////////////////////////
		if ($tipe == "tp01")
			{
			$q = mysqli_query($koneksi, "SELECT * FROM admks ".
						"WHERE username = '$username' ".
						"AND password = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				$_SESSION['kd2_session'] = nosql($row['kd']);
				$_SESSION['username2_session'] = $username;
				$_SESSION['pass2_session'] = $password;
				$_SESSION['time2_session'] = $today;
				$_SESSION['kasir_session'] = "PEMBUAT NOTA";
				$_SESSION['hajirobe2_session'] = $hajirobe;

				//time login
				mysqli_query($koneksi, "UPDATE admks SET time_login = '$today' ".
						"WHERE username = '$username' ".
						"AND password = '$password'");

				//null-kan
				xclose($koneksi);

				//re-direct
				$ke = "admks/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//null-kan
				xclose($koneksi);

				//re-direct
				pekem($pesan, $filenya);
				exit();
				}
			}




		//jika admin/pengelola ////////////////////////////////////////////////////////////////////////
		else if ($tipe == "tp02")
			{
			//admin
			$q = mysqli_query($koneksi, "SELECT * FROM admin ".
						"WHERE username = '$username' ".
						"AND password = '$password'");
			$row = mysqli_fetch_assoc($q);
			$total = mysqli_num_rows($q);

			//cek login
			if ($total != 0)
				{
				session_start();

				//nilai - nilai
				$_SESSION['kd1_session'] = nosql($row['kd']);
				$_SESSION['username1_session'] = $username;
				$_SESSION['pass1_session'] = $password;
				$_SESSION['time1_session'] = $today;
				$_SESSION['admin_session'] = "PENGELOLA";
				$_SESSION['hajirobe1_session'] = $hajirobe;

				//time login
				mysqli_query($koneksi, "UPDATE admin SET time_login = '$today' ".
						"WHERE username = '$username' ".
						"AND password = '$password'");

				//null-kan
				xfree($q);
				xclose($koneksi);

				//re-direct
				$ke = "adm/index.php";
				xloc($ke);
				exit();
				}
			else
				{
				//null-kan
				xfree($q);
				xclose($koneksi);

				//re-direct
				$pesan = "PASSWORD SALAH. HARAP DIULANGI...!!!";
				pekem($pesan, $filenya);
				exit();
				}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//js
require("inc/js/down_enter.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="990" bgcolor="'.$warnaover.'" border="0" cellspacing="5" cellpadding="0">
<tr valign="top">
<td valign="top">
<h1>
'.$nama_toko.'
</h1>
<em>
'.$alamat_toko.', '.$nama_kota.'
</em>
<br>
<br>

Tipe :
<select name="tipe">
<option value="" selected></option>
<option value="tp01">Kasir</option>
<option value="tp02">Pengelola</option>
</select>,
Username :
<input name="usernamex" type="text" size="10" maxlength="15" '.$x_enter.'>,
Password :
<input name="passwordx" type="password" size="10" maxlength="15" '.$x_enter2.'>
<br>
<input name="btnBTL" type="reset" value="BATAL">
<input name="btnOK" type="submit" value="OK &gt;&gt;&gt;">
</td>
<td width="300" valign="top">
<img src="'.$sumber.'/img/linux.gif" width="300" height="130" title="Bravo Freedom Software based Open Source...!!">
</td>
</tr>
</table>

<table width="990" bgcolor="'.$warna02.'" border="0" cellspacing="5" cellpadding="0">
<tr valign="top">
<td>
&copy;2021. <strong>{versi}</strong>
</td>
</tr>
</table>


  
</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>