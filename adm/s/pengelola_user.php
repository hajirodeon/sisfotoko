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
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "pengelola_user.php";
$judul = "User Pengelola";
$judulku = "[$admin_session : $username1_session] ==> $judul  ";
$diload = "document.formx.xuserx.focus();";




// PROSES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//hapus user
if ($_POST['btnHPS'])
	{
	//nilai
	$item = nosql($_POST['item']);

	//nek null
	if (empty($item))
		{
		//re-direct
		$pesan = "Pilih Dahulu Username Yang Akan Dihapus...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//hapus di table : admin
		mysql_query("DELETE FROM admin ".
						"WHERE kd = '$item'");

		//hapus di tabel : akses_admin
		mysql_query("DELETE FROM akses_admin ".
						"WHERE kd_admin = '$item'");

		//null-kan
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		xloc($filenya);
		exit();
		}
	}



//jika baru
if ($_POST['btnBR'])
	{
	//nilai
	$xuserx = cegah($_POST['xuserx']);
	$xpassx = md5(nosql($_POST['xpassx']));
	$xpassx2 = md5(nosql($_POST['xpassx2']));

	//cek nek null
	if ((empty($xuserx)) OR (empty($xpassx)) OR (empty($xpassx2)))
		{
		//re-direct
		$pesan = "Pembuatan User Baru Gagal. Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	//nek password gak sama
	else if ($xpassx != $xpassx2)
		{
		//re-direct
		$pesan = "Password Tidak Sama. Harap Diperhatikan...!!";
		pekem($pesan,$filenya);
		exit();
		}

	//cek, suda ada user trsebut...?
	else
		{
		$qcc = mysql_query("SELECT * FROM admin ".
								"WHERE username = '$xuserx'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek iya
		if ($tcc != 0)
			{
			//null-kan
			xfree($qbw);
			xfree($qcc);
			xclose($koneksi);

			//re-direct
			$pesan = "User : $xuserx, Sudah Ada. Silahkan Ganti Yang Lainnya...!!";
			pekem($pesan,$filenya);
			exit();
			}
		else //nek gak, simpan aja yg baru
			{
			mysql_query("INSERT INTO admin(kd, username, password, postdate) VALUES ".
							"('$x', '$xuserx', '$xpassx', '$today')");

			//null-kan
			xfree($qbw);
			xfree($qcc);
			xclose($koneksi);

			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}



//reset password
if ($_POST['btnRST'])
	{
	//nilai
	$item = nosql($_POST['item']);
	$passbrx = md5($passbaru);

	//nek null
	if (empty($item))
		{
		//re-direct
		$pesan = "Pilih Dahulu Username Untuk Reset Password-nya...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//username e...
		$qstu = mysql_query("SELECT * FROM admin ".
								"WHERE kd = '$item'");
		$rstu = mysql_fetch_assoc($qstu);
		$stunama = nosql($rstu['username']);

		//reset password
		mysql_query("UPDATE admin SET password = '$passbrx', ".
						"postdate = '$today' ".
						"WHERE kd = '$item'");

		//null-kan
		xfree($qbw);
		xfree($qstu);
		xclose($koneksi);

		//pesan
		$pesan = "Password Baru Untuk Username : $stunama, ---> $passbaru";
		pekem($pesan,$filenya);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

require("../../inc/js/jumpmenu.js");
require("../../inc/js/down_enter.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//popup
echo '<script type="text/javascript" src="'.$sumber.'/inc/js/dhtmlwindow_admks.js"></script>
<script type="text/javascript" src="'.$sumber.'/inc/js/modal.js"></script>
<script type="text/javascript">
function open_menu(str)
	{
	menu_window=dhtmlmodal.open(\'Menu User\',
	\'iframe\',
	\'pengelola_menu.php\',
	\'Menu Pengelola\',
	\'width=970px,height=450px,center=1,resize=0,scrolling=0\');
	}
</script>';

echo '<form action="'.$filenya.'" method="post" name="formx">
Username : <br>
<input name="xuserx" type="text" value="" onkeypress="return handleEnter(this, event)">
<br>
Password : <br>
<input name="xpassx" type="password" value="" onkeypress="return handleEnter(this, event)">
<br>
RE-Password : <br>
<input name="xpassx2" type="password" value="">
<br>
<input name="btnBR" type="submit" value="BARU">
<input name="btnBTL" type="reset" value="BATAL">
<br>
<br>
<br>




<table border="1" width="300" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="1%">&nbsp;</td>
<td><strong><font color="'.$warnatext.'">Nama User</font></strong></td>
<td width="1"><strong><font color="'.$warnatext.'">Menu</font></strong></td>
</tr>';

//user
$qdm = mysql_query("SELECT * FROM admin ".
						"WHERE username <> 'admin' ".
						"ORDER BY username ASC");
$rdm = mysql_fetch_assoc($qdm);
$tdm = mysql_num_rows($qdm);

//nek gak null
if ($tdm != 0)
	{
	do
		{
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		$nomer = $nomer + 1;
		$dm_kd = nosql($rdm['kd']);
		$dm_username = balikin($rdm['username']);
		$dm_usernamey = cegah($rdm['username']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td><input name="item" type="radio" value="'.$dm_kd.'"></td>
		<td>'.$dm_username.'</td>
		<td>
		<a href="#" onClick="menu_window=dhtmlmodal.open(\'Menu Pengelola : '.$dm_username.'\', \'iframe\', \'pengelola_menu.php?uskd='.$dm_kd.'&usnm='.$dm_usernamey.'\', \'Menu Pengelola : '.$dm_username.'\', \'width=400px,height=300px,center=1,resize=0,scrolling=0\');
		menu_window.onClose=function()
			{
			location.href=\''.$filenya.'\';
			return true
			}"
		title="Menu User : '.$dm_username.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
		</td>
		</tr>';
		}
	while ($rdm = mysql_fetch_assoc($qdm));
	}


echo '</table>
<input name="btnRST" type="submit" value="RESET Password">
<input name="btnHPS" type="submit" value="HAPUS">
</form>
<br><br><br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xfree($qbw);
xfree($qdm);
xclose($koneksi);
exit();
?>