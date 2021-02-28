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
$filenya = "lap_item_laris.php";
$judul = "Laporan Item Terlaris";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$limit = 100; //jumlah data item terlaris
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//focus
if (empty($xbln1))
	{
	$diload = "document.formx.xbln1.focus();";
	}
else if (empty($xthn1))
	{
	$diload = "document.formx.xthn1.focus();";
	}
else
	{
	//netralkan dahulu...!!
	mysqli_query($koneksi, "DELETE FROM item_laris ".
					"WHERE round(bln) = '$xbln1' ".
					"AND round(thn) = '$xthn1'");


	//ambil data dari nota //////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$qnot = mysqli_query($koneksi, "SELECT DISTINCT(nota_detail.kd_brg) AS brgkd ".
							"FROM nota, nota_detail ".
							"WHERE nota_detail.kd_nota = nota.kd ".
							"AND round(DATE_FORMAT(nota.tgl, '%m')) = '$xbln1' ".
							"AND round(DATE_FORMAT(nota.tgl, '%Y')) = '$xthn1'");
	$rnot = mysqli_fetch_assoc($qnot);
	$tnot = mysqli_num_rows($qnot);

	//nek ada
	if ($tnot != 0)
		{
		do
			{
			//nilai
			$nom = $nom + 1;
			$xx = md5("today3$nom");
			$n_brgkd = nosql($rnot['brgkd']);

			//qty-ne...
			$qnotx = mysqli_query($koneksi, "SELECT SUM(nota_detail.qty) AS qty ".
									"FROM nota, nota_detail ".
									"WHERE nota_detail.kd_nota = nota.kd ".
									"AND nota_detail.kd_brg = '$n_brgkd' ".
									"AND round(DATE_FORMAT(nota.tgl, '%m')) = '$xbln1' ".
									"AND round(DATE_FORMAT(nota.tgl, '%Y')) = '$xthn1'");
			$rnotx = mysqli_fetch_assoc($qnotx);
			$tnotx = mysqli_num_rows($qnotx);

			//nilai qty
			$n_qty = nosql($rnotx['qty']);

			//masukkan
			mysqli_query($koneksi, "INSERT INTO item_laris(kd, bln, thn, kd_brg, jml) VALUES ".
							"('$xx', '$xbln1', '$xthn1', '$n_brgkd', '$n_qty')");
			}
		while ($rnot = mysqli_fetch_assoc($qnot));
		}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	//ambil data dari penjualan, utk 'terlaris' /////////////////////////////////////////////////////////////////////////////////////////
	$qrisa = mysqli_query($koneksi, "SELECT DISTINCT(jual_detail.kd_brg) AS brgkd ".
							"FROM jual, jual_detail ".
							"WHERE jual_detail.kd_jual = jual.kd ".
							"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
							"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1'");
	$rrisa = mysqli_fetch_assoc($qrisa);
	$trisa = mysqli_num_rows($qrisa);

	//nek ada
	if ($trisa != 0)
		{
		do
			{
			//nilai
			$nomx = $nomx + 1;
			$xxy = md5("today3$nomx");
			$j_brgkd = nosql($rrisa['brgkd']);


			//qty
			$qrisax = mysqli_query($koneksi, "SELECT SUM(jual_detail.qty) AS qty ".
										"FROM jual, jual_detail ".
										"WHERE jual_detail.kd_jual = jual.kd ".
										"AND jual_detail.kd_brg = '$j_brgkd' ".
										"AND round(DATE_FORMAT(jual.tgl_jual, '%m')) = '$xbln1' ".
										"AND round(DATE_FORMAT(jual.tgl_jual, '%Y')) = '$xthn1'");
			$rrisax = mysqli_fetch_assoc($qrisax);
			$j_qty = nosql($rrisax['qty']);

			//cek
			$qcc = mysqli_query($koneksi, "SELECT * FROM item_laris ".
									"WHERE round(bln) = '$xbln1' ".
									"AND round(thn) = '$xthn1' ".
									"AND kd_brg = '$j_brgkd'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);

			//nek ada, update aja
			if ($tcc != 0)
				{
				//qty di data terlaris
				$cc_qty = nosql($rcc['jml']);

				//qty baru
				$qty_br = $cc_qty + $j_qty;

				//nilai baru
				mysqli_query($koneksi, "UPDATE item_laris SET jml = '$qty_br' ".
								"WHERE round(bln) = '$xbln1' ".
								"AND round(thn) = '$xthn1' ".
								"AND kd_brg = '$j_brgkd'");
				}
			else //nak gak ada, berarti baru
				{
				mysqli_query($koneksi, "INSERT INTO item_laris(kd, bln, thn, kd_brg, jml) VALUES ".
								"('$xxy', '$xbln1', '$xthn1', '$j_brgkd', '$j_qty')");
				}
			}
		while ($rrisa = mysqli_fetch_assoc($qrisa));
		}
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
<td>';

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


//nek masih do null
if (empty($xbln1))
	{
	echo "<strong>Bulan Belum Dipilih...!!</strong>";
	}
else if (empty($xthn1))
	{
	echo "<strong>Tahun Belum Dipilih...!!</strong>";
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT item_laris.*, m_brg.*, m_kategori.* ".
					"FROM item_laris, m_brg, m_kategori ".
					"WHERE item_laris.kd_brg = m_brg.kd ".
					"AND m_brg.kd_kategori = m_kategori.kd ".
					"AND round(item_laris.bln) = '$xbln1' ".
					"AND round(item_laris.thn) = '$xthn1' ".
					"ORDER BY round(item_laris.jml) DESC";
	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	//nek ada
	if ($count != 0)
		{
		//data - datanya
		echo '<table width="600" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="5"><strong><font color="'.$warnatext.'">No.</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama Barang</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Kategori</font></strong></td>
		<td width="100"><strong><font color="'.$warnatext.'">Jumlah Terjual</font></strong></td>
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
			$x_kode = nosql($data['kode']);
			$x_nama = balikin($data['nama']);
			$x_kategori = balikin($data['kategori']);
			$x_jml = nosql($data['jml']);


			echo "<tr bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$nomer.'.</td>
			<td>'.$x_kode.'</td>
			<td>'.$x_nama.'</td>
			<td>'.$x_kategori.'</td>
			<td>'.$x_jml.'</td>
	        </tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="800" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="xbln1" type="hidden" value="'.$xbln1.'">
		<input name="xthn1" type="hidden" value="'.$xthn1.'">
		<input name="page" type="hidden" value="'.$page.'">
		[<a href="lap_item_laris_prt.php?xbln1='.$xbln1.'&xthn1='.$xthn1.'" title="PRINT...!!"><img src="../../img/print.gif" border="0"></a>]
		</td>
		</tr>
		</table>';
		}
	else
		{
		//tidak ada data
		echo '<font color="red"><strong>TIDAK ADA DATA</strong></font>';
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