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
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$kastkd = nosql($_REQUEST['kastkd']);
$jukd = nosql($_REQUEST['jukd']);
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);

$ke = "jual.php?kastkd=$kastkd".
		"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
		"&jukd=$jukd&yuk=detail";
$diload = "window.print();location.href='$ke';";



$judul = "Surat Pengantar";
$judulku = $judul;
$judulx = $judul;

//kastumer
$qsupx = mysqli_query($koneksi, "SELECT * FROM m_kastumer ".
						"WHERE kd = '$kastkd'");
$rsupx = mysqli_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['singkatan']);
$supx_almt = balikin($rsupx['alamat']);



//faktur
$qtru = mysqli_query($koneksi, "SELECT * FROM jual ".
						"WHERE round(DATE_FORMAT(tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%Y')) = '$xthn1' ".
						"AND kd = '$jukd'");
$rtru = mysqli_fetch_assoc($qtru);
$x_jukd = $jukd;
$x_nofak = balikin($rtru['no_faktur']);


//isi *START
ob_start();





//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellpadding="3">
<tr>
<td align="center">
<big><strong>SURAT PENGANTAR</strong></big>
</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td width="450">
Kepada Yth.
<br>
<strong>'.$supx_nm.'</strong>
<br>
'.$supx_almt.'
<br>
<br>
</td>
<td align="right">
No. Faktur :
'.$x_nofak.'
<br>
<br>
'.$nama_kota.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'
</td>
</tr>
</table>
<p>
<u>Perincian pembelian barang - barang seperti tersebut dibawah ini :</u>
</p>';

//detail item / barang
$qdata = mysqli_query($koneksi, "SELECT jual_detail.*, jual_detail.kd AS bdkd, ".
						"stock.*, m_brg.*, m_satuan.* ".
						"FROM jual_detail, stock, m_brg, m_satuan ".
						"WHERE jual_detail.kd_brg = m_brg.kd ".
						"AND m_brg.kd_satuan = m_satuan.kd ".
						"AND stock.kd_brg = m_brg.kd ".
						"AND jual_detail.kd_jual = '$jukd' ".
						"ORDER BY m_brg.kode ASC");
$rdata = mysqli_fetch_assoc($qdata);
$tdata = mysqli_num_rows($qdata);

echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="10%" align="center"><strong>Kode</strong></td>
<td align="center"><strong>Nama Barang</strong></td>
<td width="20%" align="center"><strong>Qty.</strong></td>
</tr>';

//nek gak nul
if ($tdata!= "0")
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

		//nilai
		$nomer = $nomer + 1;
		$d_kd = nosql($rdata['bdkd']);
		$d_kode = nosql($rdata['kode']);
		$d_nama = balikin($rdata['nama']);
		$d_satuan = balikin($rdata['satuan']);
		$d_qty = nosql($rdata['qty']);

		//nek null
		if (empty($d_qty))
			{
			$d_nilx = "-";
			}
		else
			{
			$d_nilx = "$d_qty $d_satuan";
			}


		echo "<tr bgcolor=\"$warna\">";
		echo '<td>'.$d_kode.'</td>
		<td>'.$d_nama.'</td>
		<td align="center">'.$d_nilx.'</td>
		</tr>';
		}
	while ($rdata = mysqli_fetch_assoc($qdata));
	}


echo '</table>
<br><br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td width="400">

<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="center">Disiapkan</td>
<td align="center">Diperiksa</td>
<td align="center">Dikirim</td>
</tr>
<tr height="50">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>

</td>
<td align="center">
Diterima oleh :
</td>
</tr>
</table>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>