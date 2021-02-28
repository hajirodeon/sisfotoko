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
$supkd = nosql($_REQUEST['supkd']);
$belkd = nosql($_REQUEST['belkd']);
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$ke = "beli.php?supkd=$supkd".
		"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
		"&belkd=$belkd&yuk=detail";
$diload = "window.print();location.href='$ke';";


$judul = "Pembelian";
$judulku = $judul;
$judulx = $judul;







//isi *START
ob_start();





//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna02.'">
<td>
<strong>Supplier : </strong>';
//terpilih
$qsupx = mysqli_query($koneksi, "SELECT * FROM m_supplier ".
						"WHERE kd = '$supkd'");
$rsupx = mysqli_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['singkatan']);

echo "$supx_nm,
<br>
<strong>Tanggal Beli : </strong>
$xtgl1 $arrbln[$xbln1] $xthn1,
<br>
<strong>No. Faktur : </strong>";

//terpilih
$qtru = mysqli_query($koneksi, "SELECT * FROM beli ".
						"WHERE round(DATE_FORMAT(tgl_beli, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(tgl_beli, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(tgl_beli, '%Y')) = '$xthn1' ".
						"AND kd = '$belkd'");
$rtru = mysqli_fetch_assoc($qtru);
$x_belkd = $belkd;
$x_nofak = balikin($rtru['no_faktur']);


//terpilih --> total item
$qtru2 = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
						"WHERE kd_beli = '$belkd'");
$rtru2 = mysqli_fetch_assoc($qtru2);
$ttru2 = mysqli_num_rows($qtru2);
$x_beli_items = nosql($ttru2);

echo "$x_nofak => [Total : $x_beli_items Item]";
echo '</td>
</tr>
</table>';

//query view
$qteh = mysqli_query($koneksi, "SELECT beli.*, DATE_FORMAT(beli.tgl_jtempo, '%d') AS ttgl, ".
						"DATE_FORMAT(beli.tgl_jtempo, '%m') AS tbln, ".
						"DATE_FORMAT(beli.tgl_jtempo, '%Y') AS tthn, ".
						"DATE_FORMAT(beli.tgl_lunas, '%d') AS ltgl, ".
						"DATE_FORMAT(beli.tgl_lunas, '%m') AS lbln, ".
						"DATE_FORMAT(beli.tgl_lunas, '%Y') AS lthn ".
						"FROM beli ".
						"WHERE beli.kd = '$belkd'");
$rteh = mysqli_fetch_assoc($qteh);
$e_nofak = balikin($rteh['no_faktur']);

//jenis pembayaran
$e_jns_byr_kd = nosql($rteh['kd_jns_byr']);

$qjbr = mysqli_query($koneksi, "SELECT * FROM m_jns_byr ".
						"WHERE kd = '$e_jns_byr_kd'");
$rjbr = mysqli_fetch_assoc($qjbr);
$jbr_nm = balikin($rjbr['jns_byr']);
$e_jns_byr_nm = $jbr_nm;

$e_ttgl = nosql($rteh['ttgl']);
$e_tbln = nosql($rteh['tbln']);
$e_tthn = nosql($rteh['tthn']);
$e_ltgl = nosql($rteh['ltgl']);
$e_lbln = nosql($rteh['lbln']);
$e_lthn = nosql($rteh['lthn']);

$e_hr_jtempo = nosql($rteh['hr_jtempo']);

//nek null
if (empty($e_hr_jtempo))
	{
	$e_hr_jtempo = "_";
	}


$e_diskon = nosql($rteh['diskon']);
$e_ppn = nosql($rteh['ppn']);

//total sementara
$qduwi = mysqli_query($koneksi, "SELECT SUM(subtotal) AS subtotal ".
						"FROM beli_detail ".
						"WHERE kd_beli = '$belkd' ".
						"AND bonus = 'false'");
$rduwi = mysqli_fetch_assoc($qduwi);
$e_total_beli = nosql($rduwi['subtotal']);
$e_total_diskon = round((($e_diskon * $e_total_beli)/100),2);
$e_total_bayar = round(nosql($rteh['total_bayar']),2);
$e_total_diskon2 = $e_total_beli - $e_total_diskon;
$e_total_ppn = ($e_total_diskon2 * 100) / (100 - $e_ppn);
$e_total_bayar = round($e_total_ppn,2);



if ($e_ttgl == "00")
	{
	$e_ttgl = "";
	}

if ($e_tthn == "0000")
	{
	$e_tthn = "";
	}

if ($e_ltgl == "00")
	{
	$e_ltgl = "";
	}

if ($e_lthn == "0000")
	{
	$e_lthn = "";
	}




//form-nya
echo '<table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="'.$warnaover.'">
<tr valign="top">
<td>
<strong>Jenis Pembayaran : </strong>'.$e_jns_byr_nm.'';
echo '<br>
<br><strong>Jatuh Tempo : </strong>';
echo $e_hr_jtempo;
echo ' Hari
<br>
<br>
<strong>Tgl. Pelunasan : </strong>';
echo "$e_ltgl $arrbln1[$e_lbln] $e_lthn";
echo '</td>
<td><strong>Total : </strong>';
echo $e_total_beli;
echo '<br><br>
<strong>Diskon : </strong>';
echo "$e_diskon %";
echo '<br><br>
<strong>PPN : </strong>';
echo "$e_ppn %";
echo '</td>
<td>
<strong>Total Bayar :</strong> ';
echo $e_total_bayar;
echo '</td>
</table>
<br>
<br>
<br>';

//detail item / barang
$qdata = mysqli_query($koneksi, "SELECT beli_detail.*, beli_detail.kd AS bdkd, ".
						"m_brg.*, m_satuan.*, m_merk.* ".
						"FROM beli_detail, m_brg, m_satuan, m_merk ".
						"WHERE beli_detail.kd_brg = m_brg.kd ".
						"AND m_brg.kd_satuan = m_satuan.kd ".
						"AND m_brg.kd_merk = m_merk.kd ".
						"AND beli_detail.kd_beli = '$belkd' ".
						"ORDER BY beli_detail.bonus DESC, m_brg.kode ASC");
$rdata = mysqli_fetch_assoc($qdata);
$tdata = mysqli_num_rows($qdata);

echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="10%"><strong>Kode</strong></td>
<td><strong>Nama Barang</strong></td>
<td width="10%"><strong>Merk</strong></td>
<td width="10%"><strong>Qty.</strong></td>
<td width="15%" align="center"><strong>Harga</strong></td>
<td width="5%" align="center"><strong>Disk#1</strong></td>
<td width="5%" align="center"><strong>Disk#2</strong></td>
<td width="15%" align="center"><strong>SubTotal</strong></td>
</tr>';

//nek gak nul
if ($tdata != "0")
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
		$d_merk = balikin($rdata['merk']);
		$d_satuan = balikin($rdata['satuan']);
		$d_qty = nosql($rdata['qty']);
		$d_qty_gudang = nosql($rdata['qty_gudang']);
		$d_qty_toko = nosql($rdata['qty_toko']);

		$d_bonus = nosql($rdata['bonus']);

		//nek bonus
		if ($d_bonus == "true")
			{
			$d_hrg = "0";
			$d_diskon = "0";
			$d_diskon2 = "0";
			$d_subtotal = "0";
			}
		else
			{
			$d_hrg = nosql($rdata['hrg']);
			$d_diskon = nosql($rdata['diskon']);
			$d_diskon2 = nosql($rdata['diskon2']);
			$d_subtotal = nosql($rdata['subtotal']);
			}


		echo "<tr bgcolor=\"$warna\">";
		echo '<td>'.$d_kode.'</td>
		<td>'.$d_nama.'</td>
		<td>'.$d_merk.'</td>
		<td>'.$d_qty.' '.$d_satuan.'</td>
		<td align="right">'.$d_hrg.'</td>
		<td align="right">'.$d_diskon.'%</td>
		<td align="right">'.$d_diskon2.'%</td>
		<td align="right">'.$d_subtotal.'</td>
		</tr>';
		}
	while ($rdata = mysqli_fetch_assoc($qdata));
	}

echo '</table>
<br>
<br>
<br>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xfree($qbw);
xfree($qdata);
xclose($koneksi);
exit();
?>