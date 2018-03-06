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
$tpl = LoadTpl("../../template/window.html");

nocache;

//nilai
$filenya = "pengelola_menu.php";
$uskd = nosql($_REQUEST['uskd']);
$usnm = balikin($_REQUEST['usnm']);
$judul = "Menu Pengelola : $usnm";
$judulku = $judul;
$ke = "$filenya?uskd=$uskd&usnm=$usnm";




// PROSES ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//set akses
if ($_POST['btnSMP'])
	{
	//nilai
	$uskd = nosql($_POST['uskd']);
	$usnm = cegah($_POST['usnm']);
	$jml = nosql($_POST['jml']);
	$ke = "$filenya?uskd=$uskd&usnm=$usnm";

	//netralkan dahulu
	mysql_query("DELETE FROM akses_admin ".
					"WHERE kd_admin = '$uskd'");

	//looping menu
	for ($i=1;$i<=$jml;$i++)
		{
		//checked...?
		$xitem = "item";
		$xitem1 = "$xitem$i";
		$xitemx = nosql($_POST["$xitem1"]);

		//nek gak null, true-kan
		if (!empty($xitemx))
			{
			$nil_st = "true";
			}
		else
			{
			$nil_st = "false";
			}


		//kode unik
		$xu = md5("$x$i");

		//insert
		mysql_query("INSERT INTO akses_admin(kd, kd_admin, kd_menu, status) VALUES ".
						"('$xu', '$uskd', '$xitemx', '$nil_st')");
		}


	//null-kan
	xclose($koneksi);

	//re-direct
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

//require
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");

xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="10"><strong><font color="'.$warnatext.'">No.</font></strong></td>
<td width="200"><strong><font color="'.$warnatext.'">Menu</font></strong></td>
<td>&nbsp;</td>
</tr>';

//menu
$qdm = mysql_query("SELECT * FROM akses_menu ".
						"ORDER BY no, no_sub ASC");
$rdm = mysql_fetch_assoc($qdm);
$tdm = mysql_num_rows($qdm);

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
	$dm_judul = balikin($rdm['judul']);

	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>'.$nomer.'.</td>
	<td>'.$dm_judul.'</td>';

	//user punya menu
	$qsmu = mysql_query("SELECT * FROM akses_admin ".
							"WHERE kd_admin = '$uskd' ".
							"AND kd_menu = '$dm_kd'");
	$rsmu = mysql_fetch_assoc($qsmu);
	$tsmu = mysql_num_rows($qsmu);
	$smu_status = nosql($rsmu['status']);
	$smu_kd = nosql($rsmu['kd']);


	//status
	if ($smu_status == "true")
		{
		$attr_status = "checked";
		}
	else
		{
		$attr_status = "";
		}


	echo '<td>
	<input name="item'.$nomer.'" type="checkbox" value="'.$dm_kd.'" '.$attr_status.'>
	</td>
	</tr>';
	}
while ($rdm = mysql_fetch_assoc($qdm));

echo '</table>
<input name="uskd" type="hidden" value="'.$uskd.'">
<input name="usnm" type="hidden" value="'.$usnm.'">
<input name="jml" type="hidden" value="'.$tdm.'">
<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tdm.')">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnKLR" type="submit" value="TUTUP" onClick="parent.menu_window.onClose();parent.menu_window.hide();">
</form>
<br><br><br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//null-kan
xclose($koneksi);
exit();
?>