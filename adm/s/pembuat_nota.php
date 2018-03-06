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
$filenya = "pembuat_nota.php";
$judul = "Pembuat Nota";
$judulku = "[$admin_session : $username1_session] ==> $judul  ";
$diload = "document.formx.xuserx.focus();";



// PROSES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//baru
if ($_POST['btnBR'])
	{
	//nilai
	$xuserx = nosql($_POST['xuserx']);
	$xpassx = md5(nosql($_POST['xpassx']));
	$xpassx2 = md5(nosql($_POST['xpassx2']));

	//nek null
	if ((empty($xuserx)) OR (empty($xpassx)))
		{
		//re-direct
		$pesan = "Input Masih Kosong. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else if ($xpassx != $xpassx2) //nek password gak sama
		{
		//re-direct
		$pesan = "Password Tidak Sama. Silahkan Diulangi Untuk Membuat Akses User.";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//cek
		$qcc = mysql_query("SELECT * FROM admks ".
								"WHERE username = '$xuserx'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//null-kan
			xfree($qxx);
			xfree($qbw);
			xclose($koneksi);

			//ojo input
			$pesan = "Username : $xuserx, Sudah Ada. Ganti Yang Lain...!!";
			pekem($pesan,$filenya);
			exit();
			}
		else
			{
			//masukin
			mysql_query("INSERT INTO admks(kd, username, password, postdate) VALUES ".
							"('$x', '$xuserx', '$xpassx', '$today')");

			//null-kan
			xfree($qcc);
			xfree($qbw);
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
		$pesan = "Pilih Dahulu Username-nya...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//username e...
		$qstu = mysql_query("SELECT * FROM admks ".
								"WHERE kd = '$item'");
		$rstu = mysql_fetch_assoc($qstu);
		$stunama = nosql($rstu['username']);

		//reset password
		mysql_query("UPDATE admks SET password = '$passbrx', ".
						"postdate = '$today' ".
						"WHERE kd = '$item'");

		//null-kan
		xfree($qstu);
		xfree($qbw);
		xclose($koneksi);

		//pesan
		$pesan = "Password Baru Untuk Username : $stunama, ---> $passbaru";
		pekem($pesan,$filenya);
		exit();
		}
	}


//hapus
if ($_POST['btnHPS'])
	{
	//nilai
	$item = nosql($_POST['item']);

	//nek null
	if (empty($item))
		{
		//null-kan
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Pilih Dahulu Username Yang Ingin Dihapus...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		mysql_query("DELETE FROM admks ".
						"WHERE kd = '$item'");

		//null-kan
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		xloc($filenya);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

require("../../inc/js/jumpmenu.js");
require("../../inc/js/down_enter.js");
require("../../inc/js/swap.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100">Username </td>
<td width="250">: <input name="xuserx" type="text" value="" size="15" onkeypress="return handleEnter(this, event)"></td>
</tr>
<tr>
<td width="100">Password </td>
<td width="250">: <input name="xpassx" type="password" value="" size="15" onkeypress="return handleEnter(this, event)"></td>
</tr>
<tr>
<td width="100">RE-Password </td>
<td width="250">: <input name="xpassx2" type="password" value="" size="15"></td>
</tr>
<tr>
<td width="100"><input name="btnBR" type="submit" value="BARU"></td>
<td width="250"></td>
</tr>
</table>
<br>
<br>
<table width="300" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="1%">&nbsp;</strong></td>
<td><strong><font color="'.$warnatext.'">Username</font></strong></td>
</tr>';

$qdm = mysql_query("SELECT * FROM admks ".
						"WHERE username <> 'admin'");
$rdm = mysql_fetch_assoc($qdm);
$tdm = mysql_num_rows($qdm);

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
		$kdyz = nosql($rdm['kd']);
		$useryz = balikin($rdm['username']);
		$postdateyz = $rdm['postdate'];

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input name="item" type="radio" value="'.$kdyz.'">
		</td>
		<td>'.$useryz.'</td>
		</tr>';
		}
	while ($rdm = mysql_fetch_assoc($qdm));
	}

echo '</table>
<input name="btnRST" type="submit" value="Reset Password">
<input name="btnHPS" type="submit" value="Hapus">
</form>
<br><br><br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xfree($qdm);
xfree($qbw);
xclose($koneksi);
exit();
?>