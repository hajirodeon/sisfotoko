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
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$filenya = "lap_penjualan_prt.php";
$judul = "Laporan Penjualan";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$s = nosql($_REQUEST['s']);
$jukd = nosql($_REQUEST['jukd']);
$ke = "lap_penjualan.php?jukd=$jukd&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
$diload = "window.print();location.href='$ke';";





//isi *START
ob_start();

//query
$qdata = mysqli_query($koneksi, "SELECT jual.*, jual_detail.*, ".
						"jual_detail.kd AS ndkd, ".
						"jual_detail.qty AS ndqty, ".
						"m_brg.*, m_satuan.*, stock.* ".
						"FROM jual, jual_detail, m_brg, m_satuan, stock ".
						"WHERE jual.kd = jual_detail.kd_jual ".
						"AND jual_detail.kd_brg = m_brg.kd ".
						"AND m_brg.kd_satuan = m_satuan.kd ".
						"AND stock.kd_brg = m_brg.kd ".
						"AND jual.kd = '$jukd' ".
						"ORDER BY m_brg.kode ASC");
$rdata = mysqli_fetch_assoc($qdata);
$tdata = mysqli_num_rows($qdata);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<br>';
xheadline($judul);
echo '</td>
</tr>
</table>
<br>';


echo 'Tanggal : <strong>'.$xtgl1.' '.$arrbln[$xbln1].' '.$xthn1.'</strong>,
<br>
No. Faktur : ';
//terpilih
$qtru = mysqli_query($koneksi, "SELECT jual.*, jual.kd AS jukd, m_kastumer.*  ".
						"FROM jual, m_kastumer ".
						"WHERE jual.kd_kastumer = m_kastumer.kd ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1' ".
						"AND jual.kd = '$jukd'");
$rtru = mysqli_fetch_assoc($qtru);
$x_jukd = $jukd;
$x_no_faktur = balikin($rtru['no_faktur']);
$x_pelanggan = balikin($rtru['singkatan']);
$x_total = nosql($rtru['total_jual']);


echo '<strong>'.$x_no_faktur.'</strong>,
<br>
Kastumer : <strong>'.$x_pelanggan.'</strong>,
<br>
Total : <strong>'.xduit2($x_total).'</strong>';


//data - datanya
echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama Barang</font></strong></td>
<td width="100" align="center"><strong><font color="'.$warnatext.'">@ Harga</font></strong></td>
<td width="100" align="center"><strong><font color="'.$warnatext.'">Jumlah</font></strong></td>
<td width="150" align="center"><strong><font color="'.$warnatext.'">SubTotal</font></strong></td>
</tr>';

if ($tdata != 0)
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
		$kd = nosql($rdata['ndkd']);
		$kode = nosql($rdata['kode']);
		$nama = balikin($rdata['nama']);
		$satuan = balikin($rdata['satuan']);
		$ndqty = nosql($rdata['ndqty']);
		$hrg_jual = nosql($rdata['hrg_jual_br']); //harga jual setelah diberi 'MU+..%'
		$subtotal = nosql($rdata['subtotal']);

		//nek null
		if (empty($ndqty))
			{
			$nil_qty = "-";
			}
		else
			{
			$nil_qty = "$ndqty $satuan";
			}

		if (empty($subtotal))
			{
			$nil_subtotal = "-";
			}
		else
			{
			$nil_subtotal = xduit2($subtotal);
			}

		echo "<tr bgcolor=\"$warna\">";
		echo '<td>'.$kode.'</td>
		<td>'.$nama.'</td>
		<td align="right">
		'.xduit2($hrg_jual).'
		</td>
		<td align="right">'.$nil_qty.'
		</td>
		<td align="right">'.$nil_subtotal.'
		</td>
        </tr>';
		}
	while ($rdata = mysqli_fetch_assoc($qdata));
	}
	echo '</table>';

echo '</form>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>