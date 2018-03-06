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
$filenya = "lap_history_jual_prt.php";
$judul = "Laporan History Penjualan";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$brgkd = nosql($_REQUEST['brgkd']);
$ke = "lap_history_jual.php?xbln1=$xbln1&xthn1=$xthn1&brgkd=$brgkd";
$diload = "window.print();location.href='$ke';";



//isi *START
ob_start();


//query
$qdata = mysql_query("SELECT jual.*, jual_detail.*, m_brg.*, m_brg.nama AS mbnm, ".
						"m_satuan.*, m_kastumer.*, m_kastumer.singkatan AS kastumer ".
						"FROM jual, jual_detail, m_brg, m_satuan, m_kastumer ".
						"WHERE jual.kd = jual_detail.kd_jual ".
						"AND jual_detail.kd_brg = m_brg.kd ".
						"AND m_brg.kd_satuan = m_satuan.kd ".
						"AND jual.kd_kastumer = m_kastumer.kd ".
						"AND m_brg.kd = '$brgkd' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1' ".
						"ORDER BY jual.tgl_jual ASC");
$rdata = mysql_fetch_assoc($qdata);
$tdata = mysql_num_rows($qdata);

//nilai data
$brg_kode = nosql($rdata['kode']);
$brg_nm = balikin($rdata['mbnm']);



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<br>';
xheadline($judul);
echo '</td>
</tr>
</table>

<br><br>';


echo 'Bulan : <strong>'.$arrbln[$xbln1].' '.$xthn1.'</strong>;
Kode Barang : <strong>'.$brg_kode.'</strong>,
Nama Barang : <strong>'.$brg_nm.'</strong>';

echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr valign="top" bgcolor="'.$warnaheader.'">
<td width="100"><strong><font color="'.$warnatext.'">Tanggal</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">No. Faktur</font></strong></td>
<td><strong><font color="'.$warnatext.'">Kastumer</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Jumlah</font></strong></td>
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
		$y_kd = nosql($rdata['kd']);
		$y_tgl_jual = $rdata['tgl_jual'];
		$y_no_faktur = balikin($rdata['no_faktur']);
		$y_kastumer = balikin($rdata['kastumer']);
		$y_qty = nosql($rdata['qty']);
		$y_satuan = balikin($rdata['satuan']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\">";
		echo '<td>'.$y_tgl_jual.'</td>
		<td>'.$y_no_faktur.'</td>
		<td>'.$y_kastumer.'</td>
		<td>'.$y_qty.' '.$y_satuan.'</td>
        </tr>';
		}
	while ($rdata = mysql_fetch_assoc($qdata));
	echo '</table>';
	}

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>