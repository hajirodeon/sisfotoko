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



$judul = "Kwitansi";
$judulku = $judul;
$judulx = $judul;

//kastumer
$qsupx = mysql_query("SELECT * FROM m_kastumer ".
						"WHERE kd = '$kastkd'");
$rsupx = mysql_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['singkatan']);
$supx_almt = balikin($rsupx['alamat']);


//faktur
$qtru = mysql_query("SELECT * FROM jual ".
						"WHERE round(DATE_FORMAT(tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%Y')) = '$xthn1' ".
						"AND kd = '$jukd'");
$rtru = mysql_fetch_assoc($qtru);
$x_jukd = $jukd;
$x_nofak = balikin($rtru['no_faktur']);
$x_total_jual = nosql($rtru['total_jual']);



//isi *START
ob_start();




//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr valign="top">
<td width="130">
No.
</td>
<td>
: <strong>'.$x_nofak.'</strong>
</td>
</tr>

<tr>
<td width="130">
Telah terima dari
</td>
<td>
: <strong>'.$supx_nm.'</strong>
</td>
</tr>

<tr>
<td width="130">
Uang Sebanyak
</td>
<td>
: ';
xduitf($x_total_jual);
echo '</td>
</tr>

<tr>
<td width="130">
Guna Membayar
</td>
<td>
:
</td>
</tr>

</table>';

//detail item / barang
$qdata = mysql_query("SELECT jual_detail.*, jual_detail.kd AS bdkd, ".
						"stock.*, m_brg.*, m_satuan.* ".
						"FROM jual_detail, stock, m_brg, m_satuan ".
						"WHERE jual_detail.kd_brg = m_brg.kd ".
						"AND m_brg.kd_satuan = m_satuan.kd ".
						"AND stock.kd_brg = m_brg.kd ".
						"AND jual_detail.kd_jual = '$jukd' ".
						"ORDER BY m_brg.kode ASC");
$rdata = mysql_fetch_assoc($qdata);
$tdata = mysql_num_rows($qdata);

echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="20%" align="center"><strong>BANYAKNYA</strong></td>
<td align="center"><strong>NAMA BARANG</strong></td>
<td width="20%" align="center"><strong>JUMLAH</strong></td>
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
		$d_nama = balikin($rdata['nama']);
		$d_satuan = balikin($rdata['satuan']);
		$d_qty = nosql($rdata['qty']);
		$d_hrg = nosql($rdata['hrg_jual']);
		$d_jml = nosql($rdata['subtotal']);


		//nek null
		if (empty($d_qty))
			{
			$d_qty = "-";
			}

		if (empty($d_jml))
			{
			$d_subtotal = "-";
			}
		else
			{
			$d_subtotal = xduit2($d_jml);
			}



		echo "<tr bgcolor=\"$warna\">";
		echo '<td>'.$d_qty.' '.$d_satuan.'</td>
		<td>'.$d_nama.'</td>
		<td align="right">'.$d_subtotal.'</td>
		</tr>';
		}
	while ($rdata = mysql_fetch_assoc($qdata));
	}

echo '</table>
<br>
<br>

<table width="100%">
<tr>
<td>
Terbilang : <strong>'.xduit2($x_total_jual).'</strong>
&nbsp;
</td>
<td align="right">
'.$nama_kota.', '.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'
</td>
</tr>
</table>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>