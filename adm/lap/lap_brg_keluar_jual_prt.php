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
$filenya = "lap_brg_keluar_jual_prt.php";
$judul = "Laporan Barang Keluar [Penjualan]";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$ke = "lap_brg_keluar_jual.php?xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
$diload = "window.print();location.href='$ke';";



//isi *START
ob_start();

//query
$qdata = mysql_query("SELECT DISTINCT(kd_brg) ".
						"FROM jual, jual_detail, m_brg ".
						"WHERE jual_detail.kd_jual = jual.kd ".
						"AND jual_detail.kd_brg = m_brg.kd ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1' ".
						"ORDER BY m_brg.nama ASC");
$rdata = mysql_fetch_assoc($qdata);
$tdata = mysql_num_rows($qdata);


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">
<br>';
xheadline($judul);
echo '</td>
</tr>
</table>
<br>
<br>';

echo '<strong>Tanggal : </strong>
'.$xtgl1.' '.$arrbln[$xbln1].' '.$xthn1.'
<br>';


//data - datanya
echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama Barang</font></strong></td>
<td width="100" align="center"><strong><font color="'.$warnatext.'">Jumlah</font></strong></td>	</tr>';

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
		$brgkd = nosql($rdata['kd_brg']);

		//artinya....
		$qbrg = mysql_query("SELECT m_brg.*, m_satuan.* ".
								"FROM m_brg, m_satuan ".
								"WHERE m_brg.kd_satuan = m_satuan.kd ".
								"AND m_brg.kd = '$brgkd'");
		$rbrg = mysql_fetch_assoc($qbrg);
		$tbrg = mysql_num_rows($qbrg);
		$brg_kode = balikin($rbrg['kode']);
		$brg_nama = balikin($rbrg['nama']);
		$brg_satuan = balikin($rbrg['satuan']);

		//jumlahnya
		$qjml = mysql_query("SELECT SUM(qty) AS jml ".
								"FROM jual, jual_detail ".
								"WHERE jual_detail.kd_jual = jual.kd ".
								"AND round(DATE_FORMAT(jual.tgl_jual, '%d')) = '$xtgl1' ".
								"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
								"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1' ".
								"AND jual_detail.kd_brg = '$brgkd'");
		$rjml = mysql_fetch_assoc($qjml);
		$jml_qty = nosql($rjml['jml']);

		echo "<tr bgcolor=\"$warna\">";
		echo '<td>'.$brg_kode.'</td>
		<td>'.$brg_nama.'</td>
		<td align="right">
		'.$jml_qty.' '.$brg_satuan.'
		</td>
        </tr>';
		}
	while ($rdata = mysql_fetch_assoc($qdata));
	}
echo '</table>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xfree($qdata);
xclose($koneksi);
exit();
?>