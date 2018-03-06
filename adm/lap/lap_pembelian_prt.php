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
$filenya = "lap_pembelian_prt.php";
$judul = "Laporan Pembelian";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$s = nosql($_REQUEST['s']);
$belkd = nosql($_REQUEST['belkd']);
$ke = "lap_pembelian.php?belkd=$belkd&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
$diload = "window.print();location.href='$ke';";





//isi *START
ob_start();

//query
$qdata = mysql_query("SELECT beli.*, beli_detail.*, ".
						"beli_detail.kd AS ndkd, ".
						"beli_detail.qty AS ndqty, ".
						"m_brg.*, m_satuan.*, stock.* ".
						"FROM beli, beli_detail, m_brg, m_satuan, stock ".
						"WHERE beli.kd = beli_detail.kd_beli ".
						"AND beli_detail.kd_brg = m_brg.kd ".
						"AND m_brg.kd_satuan = m_satuan.kd ".
						"AND stock.kd_brg = m_brg.kd ".
						"AND beli.kd = '$belkd' ".
						"ORDER BY beli_detail.bonus DESC, m_brg.kode ASC");
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
<br>';


//terpilih
$qtru = mysql_query("SELECT beli.*, beli.kd AS belkd, m_supplier.*  ".
						"FROM beli, m_supplier ".
						"WHERE beli.kd_supplier = m_supplier.kd ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(beli.tgl_beli, '%Y')) = '$xthn1' ".
						"AND beli.kd = '$belkd'");
$rtru = mysql_fetch_assoc($qtru);
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
$qduwi = mysql_query("SELECT SUM(subtotal) AS subtotal ".
						"FROM beli_detail ".
						"WHERE kd_beli = '$x_belkd' ".
						"AND bonus = 'false'");
$rduwi = mysql_fetch_assoc($qduwi);
$x_total_beli = nosql($rduwi['subtotal']);
$x_total_diskon = round((($x_diskon * $x_total_beli)/100),2);
$x_total_bayar = round(nosql($rtru['total_bayar']),2);
$x_total_diskon2 = $x_total_beli - $x_total_diskon;
$x_total_ppn = ($x_total_diskon2 * 100) / (100 - $x_ppn);
$x_total_bayar = round($x_total_ppn,2);



//jenis pembayaran
$qwow = mysql_query("SELECT * FROM m_jns_byr ".
						"WHERE kd = '$x_kd_byr'");
$rwow = mysql_fetch_assoc($qwow);
$qwow = mysql_num_rows($qwow);
$wow_jns = balikin($rwow['jns_byr']);


echo '<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
No. Faktur : <strong>'.$x_no_faktur.'</strong> ,
Tanggal Pembelian : <strong>'.$xtgl1.' '.$arrbln[$xbln1].' '.$xthn1.'</strong> ,
<br>



Total Beli : <strong>'.$x_total_beli.'</strong> ,
Diskon : <strong>'.$x_diskon.'</strong>% ,
PPN : <strong>'.$x_ppn.'</strong>% ,
Total Bayar : <strong>'.$x_total_bayar.'</strong> ,

<br>

Pembayaran : <strong>'.$wow_jns.'</strong> ,
Jatuh Tempo : <strong>'.$x_jtempo.'</strong> Hari ,
Tgl. Pelunasan : <strong>'.$x_tgl_lunas.'</strong>.
</td>
</tr>
</table>';


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

		$x_bonus = nosql($rdata['bonus']);

		//nek barang bonus
		if ($x_bonus == "true")
			{
			$hrg_beli = "0";
			$subtotal = "0";
			}
		else //bukan bonus
			{
			$hrg_beli = nosql($rdata['hrg_beli']);
			$subtotal = nosql($rdata['subtotal']);
			}


		echo "<tr bgcolor=\"$warna\">";
		echo '<td>'.$kode.'</td>
		<td>'.$nama.'</td>
		<td align="right">
		'.$hrg_beli.'
		</td>
		<td align="right">
		'.$ndqty.' '.$satuan.'
		</td>
		<td align="right">
		'.$subtotal.'
		</td>
        </tr>';
		}
	while ($rdata = mysql_fetch_assoc($qdata));
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