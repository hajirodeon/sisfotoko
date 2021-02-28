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
$filenya = "lap_pembelian.php";
$judul = "Laporan Pembelian";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$s = nosql($_REQUEST['s']);
$belkd = nosql($_REQUEST['belkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//focus
if (empty($xtgl1))
	{
	$diload = "document.formx.xtgl1.focus();";
	}
else if (empty($xbln1))
	{
	$diload = "document.formx.xbln1.focus();";
	}
else if (empty($xthn1))
	{
	$diload = "document.formx.xthn1.focus();";
	}
else if (empty($belkd))
	{
	$diload = "document.formx.belkd.focus();";
	}






//isi *START
ob_start();

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT beli.*, beli_detail.*, ".
				"beli_detail.kd AS ndkd, ".
				"beli_detail.qty AS ndqty, ".
				"m_brg.*, m_satuan.*, stock.* ".
				"FROM beli, beli_detail, m_brg, m_satuan, stock ".
				"WHERE beli.kd = beli_detail.kd_beli ".
				"AND beli_detail.kd_brg = m_brg.kd ".
				"AND m_brg.kd_satuan = m_satuan.kd ".
				"AND stock.kd_brg = m_brg.kd ".
				"AND beli.kd = '$belkd' ".
				"ORDER BY beli_detail.bonus DESC, m_brg.kode ASC";
$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$target = "$filenya?belkd=$belkd&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);

//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
require("../../inc/menu/adm_cek.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form method="post" name="formx">
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
Tanggal : ';
echo "<select name=\"xtgl1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xtgl1.'" selected>'.$xtgl1.'</option>';

for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$filenya.'?xtgl1='.$i.'">'.$i.'</option>';
	}

echo '</select>';

echo "<select name=\"xbln1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xbln1.'" selected>'.$arrbln[$xbln1].'</option>';

for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$filenya.'?xtgl1='.$xtgl1.'&xbln1='.$j.'">'.$arrbln[$j].'</option>';
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
	echo '<option value="'.$filenya.'?xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$x_thn.'">'.$x_thn.'</option>';
	}
while ($rthn = mysqli_fetch_assoc($qthn));

echo '</select>,

No. Faktur : ';
echo "<select name=\"belkd\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtru = mysqli_query($koneksi, "SELECT beli.*, beli.kd AS belkd, m_supplier.*  ".
						"FROM beli, m_supplier ".
						"WHERE beli.kd_supplier = m_supplier.kd ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%Y')) = '$xthn1' ".
						"AND beli.kd = '$belkd'");
$rtru = mysqli_fetch_assoc($qtru);
$x_belkd = $belkd;
$x_no_faktur = balikin($rtru['no_faktur']);
$x_supplier = balikin($rtru['singkatan']);
$x_diskon = nosql($rtru['diskon']);
$x_ppn = nosql($rtru['ppn']);
$x_total_bayar = round(nosql($rtru['total_bayar']),2);
$x_tgl_jtempo = $rtru['tgl_jtempo'];
$x_jtempo = $rtru['hr_jtempo'];
$x_tgl_lunas = $rtru['tgl_lunas'];
$x_kd_byr = nosql($rtru['kd_jns_byr']);

//total sementara
$qduwi = mysqli_query($koneksi, "SELECT SUM(subtotal) AS subtotal ".
						"FROM beli_detail ".
						"WHERE kd_beli = '$x_belkd' ".
						"AND bonus = 'false'");
$rduwi = mysqli_fetch_assoc($qduwi);
$x_total_beli = nosql($rduwi['subtotal']);
$x_total_diskon = round((($x_diskon * $x_total_beli)/100),2);
$x_total_bayar = round(nosql($rtru['total_bayar']),2);
$x_total_diskon2 = $x_total_beli - $x_total_diskon;
$x_total_ppn = ($x_total_diskon2 * 100) / (100 - $x_ppn);
$x_total_bayar = round($x_total_ppn,2);









//terpilih --> total item
$qtru2 = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
						"WHERE kd_beli = '$belkd'");
$rtru2 = mysqli_fetch_assoc($qtru2);
$ttru2 = mysqli_num_rows($qtru2);
$x_beli_items = nosql($ttru2);

echo '<option value="'.$x_belkd.'" selected>'.$x_no_faktur.' => '.$x_beli_items.' Item, Supplier : '.$x_supplier.'</option>';

//data
$qtrux = mysqli_query($koneksi, "SELECT beli.*, beli.kd AS belkd, m_supplier.*  ".
						"FROM beli, m_supplier ".
						"WHERE beli.kd_supplier = m_supplier.kd ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%Y')) = '$xthn1' ".
						"AND beli.kd <> '$belkd' ".
						"ORDER BY round(beli.no_faktur) ASC");
$rtrux = mysqli_fetch_assoc($qtrux);

do
	{
	$i_belkd = nosql($rtrux['belkd']);
	$i_no_faktur = balikin($rtrux['no_faktur']);
	$i_supplier = balikin($rtrux['singkatan']);

	//nek null
	if (empty($i_no_faktur))
		{
		$i_no_faktur = "-";
		}



	//jumlahnya
	$qyukx = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
							"WHERE kd_beli = '$i_belkd' ".
							"AND bonus = 'false'");
	$ryukx = mysqli_fetch_assoc($qyukx);
	$tyukx = mysqli_num_rows($qyukx);
	$i_beli_items = $tyukx;

	echo '<option value="'.$filenya.'?xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$xthn1.'&belkd='.$i_belkd.'">
	'.$i_no_faktur.' => '.$i_beli_items.' Item, Supplier : '.$i_supplier.'. </option>';
	}
while ($rtrux = mysqli_fetch_assoc($qtrux));

echo '</select>
</td>
</tr>
</table>';


//nek masih do null
if (empty($xtgl1))
	{
	echo "<strong>Tanggal Belum Dipilih...!!</strong>";
	}
else if (empty($xbln1))
	{
	echo "<strong>Bulan Belum Dipilih...!!</strong>";
	}
else if (empty($xthn1))
	{
	echo "<strong>Tahun Belum Dipilih...!!</strong>";
	}
else if (empty($belkd))
	{
	echo "<strong>No. Faktur Belum Dipilih...!!</strong>";
	}
else
	{
	//jenis pembayaran
	$qwow = mysqli_query($koneksi, "SELECT * FROM m_jns_byr ".
							"WHERE kd = '$x_kd_byr'");
	$rwow = mysqli_fetch_assoc($qwow);
	$qwow = mysqli_num_rows($qwow);
	$wow_jns = balikin($rwow['jns_byr']);


	echo '<br>
	<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr>
    <td>
	Total Beli : <strong>'.$x_total_beli.'</strong> ,
	Diskon : <strong>'.$x_diskon.'</strong>% ,
	PPN : <strong>'.$x_ppn.'</strong>% ,
	Total Bayar : <strong>'.$x_total_bayar.'</strong> ,

	<br>

	Pembayaran : <strong>'.$wow_jns.'</strong> ,
	Jatuh Tempo : <strong>'.$x_jtempo.'</strong> Hari.
	Tgl. Pelunasan : <strong>'.$x_tgl_lunas.'</strong>.
	</td>
  	</tr>
	</table>';

	//data - datanya
	echo '<table width="800" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama Barang</font></strong></td>
	<td width="100" align="center"><strong><font color="'.$warnatext.'">@ Harga</font></strong></td>
	<td width="100" align="center"><strong><font color="'.$warnatext.'">Jumlah</font></strong></td>
	<td width="150" align="center"><strong><font color="'.$warnatext.'">SubTotal</font></strong></td>
	</tr>';

	if ($count != 0)
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
			$kd = nosql($data['ndkd']);
			$kode = nosql($data['kode']);
			$nama = balikin($data['nama']);
			$satuan = balikin($data['satuan']);
			$ndqty = nosql($data['ndqty']);
			$x_bonus = nosql($data['bonus']);

			//nek barang bonus
			if ($x_bonus == "true")
				{
				$hrg_beli = "0";
				$subtotal = "0";
				}
			else //bukan bonus
				{
				$hrg_beli = nosql($data['hrg_beli']);
				$subtotal = nosql($data['subtotal']);
				}


			echo "<tr bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$kode.'</td>
			<td>'.$nama.'</td>
			<td align="right">
			'.$hrg_beli.'
			</td>
			<td align="right">'.$ndqty.' '.$satuan.'
			</td>
			<td align="right">'.$subtotal.'
			</td>
	        </tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	echo '</table>
	<table width="800" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td width="250">
	<input name="xtgl1" type="hidden" value="'.$xtgl1.'">
	<input name="xbln1" type="hidden" value="'.$xbln1.'">
	<input name="xthn1" type="hidden" value="'.$xthn1.'">
	<input name="belkd" type="hidden" value="'.$belkd.'">
	<input name="page" type="hidden" value="'.$page.'">
	[<a href="lap_pembelian_prt.php?belkd='.$belkd.'&xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$xthn1.'" title="PRINT...!!"><img src="../../img/print.gif" border="0"></a>]
	</td>
	<td>
	<div align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</div>
	</td>
	</tr>
	</table>';
	}

echo '</form>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>