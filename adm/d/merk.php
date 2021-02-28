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

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/paging2.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "merk.php";
$diload = "document.formx.merk.focus();";
$judul = "Data Merk";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

//nek enter
$x_enter = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP.focus();
	}"';



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}



//jika edit
if ($s == "edit")
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysqli_query($koneksi, "SELECT * FROM m_merk ".
						"WHERE kd = '$kdx'");
	$rowx = mysqli_fetch_assoc($qx);

	$merk = balikin($rowx['merk']);
	}



//jika simpan
if (($_POST['btnSMP']) OR ($_POST['merk']))
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);
	$merk = cegah($_POST['merk']);
	$ke = "$filenya?page=$page";

	//nek null
	if (empty($merk))
		{
		//re-direct
		$pesan = "Merk Belum Ditulis. Harap Diulangi...!!";
		pekem($pesan,$ke);
		exit();
		}
	else
		{ ///cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM m_merk ".
								"WHERE merk = '$merk'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);


		//nek duplikasi, lebih dari 1
		if ($tcc > 1)
			{
			//null-kan
			xfree($qbw);
			xfree($qcc);
			xclose($koneksi);

			//re-direct
			$pesan = "Ditemukan Duplikasi Merk : $merk. Harap Segera Diperhatikan...!!";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//jika update
			if ($s == "edit")
				{
				mysqli_query($koneksi, "UPDATE m_merk SET merk = '$merk' ".
								"WHERE kd = '$kd'");

				//null-kan
				xfree($qbw);
				xfree($qcc);
				xclose($koneksi);

				//re-direct
				xloc($ke);
				exit();
				}

			//jika baru
			if (empty($s))
				{
				//nek ada
				if ($tcc != 0)
					{
					//null-kan
					xfree($qbw);
					xfree($qcc);
					xclose($koneksi);

					//re-direct
					$pesan = "Merk : $merk, Sudah Ada. Silahkan Ganti Yang Lain...!!";
					pekem($pesan,$ke);
					exit();
					}
				else
					{
					mysqli_query($koneksi, "INSERT INTO m_merk(kd, merk) VALUES ".
									"('$x', '$merk')");

					//null-kan
					xfree($qbw);
					xfree($qcc);
					xclose($koneksi);

					//re-direct
					xloc($ke);
					exit();
					}
				}
			}
		}
	}


//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);
	$ke = "$filenya?page=$page";

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM m_merk ".
						"WHERE kd = '$kd'");
		}

	//null-kan
	xfree($qbw);
	xclose($koneksi);


	//auto-kembali
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM m_merk ".
				"ORDER BY merk ASC";
$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);


//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
require("../../inc/menu/adm_cek.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
<input name="merk" type="text" value="'.$merk.'" '.$x_enter.'>
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</p>
<table width="500" border="1" cellspacing="0" cellpadding="3">
<tr valign="top" bgcolor="'.$warnaheader.'">
<td width="1%">&nbsp;</td>
<td width="1%">&nbsp;</td>
<td><strong><font color="'.$warnatext.'">Merk</font></strong></td>
</tr>';

if ($count != 0)
	{
	do {
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
		$kd = nosql($data['kd']);
		$merk = balikin($data['merk']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$nomer.'" value="'.$kd.'">
        </td>
		<td>
		<a href="'.$filenya.'?s=edit&page='.$page.'&kd='.$kd.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
		</td>
		<td>'.$merk.'</td>
        </tr>';
		}
	while ($data = mysqli_fetch_assoc($result));
	}


echo '</table>
<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="250">
<input name="jml" type="hidden" value="'.$count.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="page" type="hidden" value="'.$page.'">
<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$count.')">
<input name="btnBTL" type="reset" value="BATAL">
<input name="btnHPS" type="submit" value="HAPUS">
</td>
<td align="right">
<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
</td>
</tr>
</table>
</form>
<br><br><br>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>