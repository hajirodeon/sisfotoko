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


session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/admks.php");
$tpl = LoadTpl("../template/window.html");


nocache;

//nilai
$filenya = "pass.php";
$diload = "document.formx.passlama.focus();";
$judul = "Ganti Password";
$judulku = "[$kasir_session : $username2_session] ==> $judul";

//keydown.
//tombol "ESC"=27, utk. keluar
$dikeydown = "var keyCode = event.keyCode;
				if (keyCode == 27)
					{
					parent.pass_window.hide();
					}";


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$passlama = md5(nosql($_POST["passlama"]));
	$passbaru = md5(nosql($_POST["passbaru"]));
	$passbaru2 = md5(nosql($_POST["passbaru2"]));

	//nek null
	if ((empty($passlama)) OR (empty($passbaru)) OR (empty($passbaru2)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else if ($passbaru != $passbaru2) //nek passbaru gak sama
		{
		//re-direct
		$pesan = "Password Baru Tidak Cocok. Silahkan Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//query
		$q = mysql_query("SELECT * FROM admks ".
							"WHERE kd = '$kd2_session' ".
							"AND username = '$username2_session' ".
							"AND password = '$passlama'");
		$row = mysql_fetch_assoc($q);
		$total = mysql_num_rows($q);

		//cek
		if ($total != 0)
			{
			//perintah SQL
			mysql_query("UPDATE admks SET password = '$passbaru' ".
							"WHERE kd = '$kd2_session' ".
							"AND username = '$username2_session'");

			//auto-kembali
			$pesan = "PASSWORD BERHASIL DIGANTI.";
			xpesan($pesan);
			echo '<script>parent.pass_window.hide();</script>';
			}
		else
			{
			//re-direct
			$pesan = "PASSWORD LAMA TIDAK COCOK. HARAP DIULANGI...!!!";
			pekem($pesan, $filenya);
			exit();
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//js
require("../inc/js/down_enter.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Password Lama : <br>
<input name="passlama" type="password" size="15" maxlength="15" onkeypress="return handleEnter(this, event)">
<br><br>
Password Baru : <br>
<input name="passbaru" type="password" size="15" maxlength="15" onkeypress="return handleEnter(this, event)">
<br><br>
RE-Password Baru : <br>
<input name="passbaru2" type="password" size="15" maxlength="15">
<br><br>
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="reset" value="BATAL">
</td>
<td><img src="'.$sumber.'/img/pass.gif" width="222" height="288"></td>
</tr>
</table>
</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>