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
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "lap_penjualan.php";
$judul = "Laporan Penjualan";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$s = nosql($_REQUEST['s']);
$jukd = nosql($_REQUEST['jukd']);


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
else if (empty($jukd))
	{
	$diload = "document.formx.jukd.focus();";
	}






//isi *START
ob_start();



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
$qthn = mysql_query("SELECT * FROM m_tahun ".
						"ORDER BY tahun DESC");
$rthn = mysql_fetch_assoc($qthn);

do
	{
	$x_thn = nosql($rthn['tahun']);
	echo '<option value="'.$filenya.'?xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$x_thn.'">'.$x_thn.'</option>';
	}
while ($rthn = mysql_fetch_assoc($qthn));

echo '</select>,

No. Faktur : ';
echo "<select name=\"jukd\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtru = mysql_query("SELECT jual.*, jual.kd AS jukd, m_kastumer.*  ".
						"FROM jual, m_kastumer ".
						"WHERE jual.kd_kastumer = m_kastumer.kd ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1' ".
						"AND jual.kd = '$jukd'");
$rtru = mysql_fetch_assoc($qtru);
$x_jukd = $jukd;
$x_no_faktur = balikin($rtru['no_faktur']);
$x_pelanggan = balikin($rtru['singkatan']);
$x_total = nosql($rtru['total_jual']);



//terpilih --> total item
$qtru2 = mysql_query("SELECT * FROM jual_detail ".
						"WHERE kd_jual = '$jukd'");
$rtru2 = mysql_fetch_assoc($qtru2);
$ttru2 = mysql_num_rows($qtru2);
$x_jual_items = nosql($ttru2);

echo '<option value="'.$x_jukd.'" selected>'.$x_no_faktur.' => '.$x_jual_items.' Item, Kastumer : '.$x_pelanggan.'</option>';

//data
$qtrux = mysql_query("SELECT jual.*, jual.kd AS jukd, m_kastumer.*  ".
						"FROM jual, m_kastumer ".
						"WHERE jual.kd_kastumer = m_kastumer.kd ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1' ".
						"AND jual.kd <> '$jukd' ".
						"ORDER BY round(jual.no_faktur) ASC");
$rtrux = mysql_fetch_assoc($qtrux);

do
	{
	$i_jukd = nosql($rtrux['jukd']);
	$i_no_faktur = balikin($rtrux['no_faktur']);
	$i_pelanggan = balikin($rtrux['singkatan']);

	//nek null
	if (empty($i_no_faktur))
		{
		$i_no_faktur = "-";
		}



	//jumlahnya
	$qyukx = mysql_query("SELECT * FROM jual_detail ".
							"WHERE kd_jual = '$i_jukd'");
	$ryukx = mysql_fetch_assoc($qyukx);
	$tyukx = mysql_num_rows($qyukx);
	$i_jual_items = $tyukx;

	echo '<option value="'.$filenya.'?xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$xthn1.'&jukd='.$i_jukd.'">
	'.$i_no_faktur.' => '.$i_jual_items.' Item, Kastumer : '.$i_pelanggan.'. </option>';
	}
while ($rtrux = mysql_fetch_assoc($qtrux));

echo '</select>
</td>
</tr>
</table>
<br>';


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
else if (empty($jukd))
	{
	echo "<strong>No. Faktur Belum Dipilih...!!</strong>";
	}
else
	{
	//query
	$qdata = mysql_query("SELECT jual.*, jual_detail.*, ".
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
	$rdata = mysql_fetch_assoc($qdata);
	$tdata = mysql_num_rows($qdata);

	if ($tdata != 0)
		{
		echo '<table width="800" border="0" cellspacing="0" cellpadding="0">
		<tr>
	    <td align="right">
		Total : <strong>'.xduit2($x_total).'</strong>
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


			echo "<tr bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
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
		while ($rdata = mysql_fetch_assoc($qdata));

		echo '</table>
		<table width="800" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="250">
		<input name="xtgl1" type="hidden" value="'.$xtgl1.'">
		<input name="xbln1" type="hidden" value="'.$xbln1.'">
		<input name="xthn1" type="hidden" value="'.$xthn1.'">
		<input name="jukd" type="hidden" value="'.$jukd.'">
		[<a href="lap_penjualan_prt.php?jukd='.$jukd.'&xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$xthn1.'" title="PRINT...!!"><img src="../../img/print.gif" border="0"></a>]
		</td>
		<td align="right">
		<strong><font color="#FF0000">'.$tdata.'</font></strong> Data.
		</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<font color="red"><strong>TIDAK ADA DATA.</strong></fonr>';
		}
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