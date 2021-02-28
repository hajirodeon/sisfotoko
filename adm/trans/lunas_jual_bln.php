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
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "lunas_jual_bln.php";
$judul = "Lunas Penjualan [Per Bulan]";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$brgkd = nosql($_REQUEST['brgkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//focus
//nek sih null
if (empty($xbln1))
	{
	$diload = "document.formx.xbln1.focus();";
	}
else if (empty($xthn1))
	{
	$diload = "document.formx.xthn1.focus();";
	}






//isi *START
ob_start();





//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
require("../../inc/menu/adm_cek.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form method="post" action="'.$filenya.'" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';
xheadline($judul);
echo '</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna02.'">
<td>
<strong>Bulan : </strong>';
echo "<select name=\"xbln1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xbln1.'" selected>'.$arrbln[$xbln1].'</option>';

for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$filenya.'?xbln1='.$j.'">'.$arrbln[$j].'</option>';
	}

echo '</select>';

echo "<select name=\"xthn1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xthn1.'" selected>'.$xthn1.'</option>';

//query
$qthn = mysqli_query($koneksi, "SELECT * FROM m_tahun ".
						"ORDER BY tahun DESC");
$rthn = mysqli_fetch_assoc($qthn);

do
	{
	$x_thn = nosql($rthn['tahun']);
	echo '<option value="'.$filenya.'?xbln1='.$xbln1.'&xthn1='.$x_thn.'">'.$x_thn.'</option>';
	}
while ($rthn = mysqli_fetch_assoc($qthn));

echo '</select>
</td>
</tr>
</table>
<br>';


//cek
if ((empty($xbln1)) OR (empty($xthn1)))
	{
	echo '<strong>Per Bulan Apa...?</strong>';
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT jual.*, DATE_FORMAT(tgl_bayar, '%d') AS ltgl, ".
					"DATE_FORMAT(tgl_bayar, '%m') AS lbln,  ".
					"DATE_FORMAT(tgl_bayar, '%Y') AS lthn ".
					"FROM jual ".
					"WHERE round(DATE_FORMAT(tgl_jual, '%m')) = '$xbln1' ".
					"AND round(DATE_FORMAT(tgl_jual, '%Y')) = '$xthn1' ".
					"AND round(DATE_FORMAT(tgl_bayar, '%d')) <> '00' ".
					"AND round(DATE_FORMAT(tgl_bayar, '%m')) <> '00' ".
					"AND round(DATE_FORMAT(tgl_bayar, '%Y')) <> '0000' ".
					"ORDER BY tgl_jual DESC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?xbln1=$xbln1&xthn1=$xthn1";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	if ($count != 0)
		{
		echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="80" align="center"><strong><font color="'.$warnatext.'">Tanggal</font></strong></td>
		<td width="100" align="center"><strong><font color="'.$warnatext.'">No. Faktur</font></strong></td>
		<td align="center"><strong><font color="'.$warnatext.'">Kastumer</font></strong></td>
		<td width="80" align="center"><strong><font color="'.$warnatext.'">Jenis Pembayaran</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Total</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Tgl. Pelunasan</font></strong></td>
		</tr>';

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
			$y_kd = nosql($data['kd']);
			$y_tgl_jual = $data['tgl_jual'];
			$y_no_faktur = balikin($data['no_faktur']);
			$y_kd_byr = nosql($data['kd_jns_byr']);
			$y_kastkd = nosql($data['kd_kastumer']);

			//total
			$y_total_jual = nosql($data['total_jual']);

			if (empty($y_total_jual))
				{
				$y_total_jualx = "-";
				}
			else
				{
				$y_total_jualx = xduit2($y_total_jual);
				}



			//tgl. pelunasan
			$y_ltgl = nosql($data['ltgl']);
			$y_lbln = nosql($data['lbln']);
			$y_lthn = nosql($data['lthn']);

			if ($y_ltgl == "00")
				{
				$y_ltgl = "";
				}

			if ($y_lthn == "000")
				{
				$y_lthn = "";
				}




			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input name="kd'.$nomer.'" type="hidden" value="'.$y_kd.'">
			'.$y_tgl_jual.'
			</td>
			<td>'.$y_no_faktur.'</td>

			<td>';
			//kastumer
			$qsup = mysqli_query($koneksi, "SELECT * FROM m_kastumer ".
									"WHERE kd = '$y_kastkd'");
			$rsup = mysqli_fetch_assoc($qsup);
			$sup_nm = balikin($rsup['singkatan']);

			echo $sup_nm;

			echo '</td>

			<td align="center">';
			//terpilih
			$qbyrx = mysqli_query($koneksi, "SELECT * FROM m_jns_byr ".
									"WHERE kd = '$y_kd_byr'");
			$rbyrx = mysqli_fetch_assoc($qbyrx);
			$byrx_nm = balikin($rbyrx['jns_byr']);

			echo $byrx_nm;

			echo '</td>
			<td align="right">
			'.$y_total_jualx.'
			</td>


			<td>
			'.$y_ltgl.' '.$arrbln1[$y_lbln].' '.$y_lthn.'
			</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right">
		<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
		</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<font color="red"><strong>TIDAK ADA DAFTAR PELUNASAN.</strong></font>';
		}
	}

echo '</form>
<br><br><br>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xfree($result);
xclose($koneksi);
exit();
?>