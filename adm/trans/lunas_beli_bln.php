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
$filenya = "lunas_beli_bln.php";
$judul = "Lunas Pembelian [Per Bulan]";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$brgkd = nosql($_REQUEST['brgkd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//focus
//nek sih null
if (empty($xbln1))
	{
	$diload = "document.formx.xbln1.focus();";
	}
else if (empty($xthn1))
	{
	$diload = "document.formx.xthn1.focus();";
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
echo '<form method="post" action="'.$filenya.'" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';
xheadline($judul);
echo '</td>
</tr>
</table>

<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
<strong>Bulan : </strong>';
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
$qthn = mysql_query("SELECT * FROM m_tahun ".
						"ORDER BY tahun DESC");
$rthn = mysql_fetch_assoc($qthn);

do
	{
	$x_thn = nosql($rthn['tahun']);
	echo '<option value="'.$filenya.'?xbln1='.$xbln1.'&xthn1='.$x_thn.'">'.$x_thn.'</option>';
	}
while ($rthn = mysql_fetch_assoc($qthn));

echo '</select>
</td>
</tr>
</table>
<br>';


//cek
if ((empty($xbln1)) OR (empty($xthn1)))
	{
	echo '<strong>Per Bulan Apa...?</strong>';
	}
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT beli.*, DATE_FORMAT(tgl_lunas, '%d') AS ltgl, ".
					"DATE_FORMAT(tgl_lunas, '%m') AS lbln,  ".
					"DATE_FORMAT(tgl_lunas, '%Y') AS lthn ".
					"FROM beli ".
					"WHERE round(DATE_FORMAT(tgl_beli, '%m')) = '$xbln1' ".
					"AND round(DATE_FORMAT(tgl_beli, '%Y')) = '$xthn1' ".
					"AND round(DATE_FORMAT(tgl_lunas, '%d')) <> '00' ".
					"AND round(DATE_FORMAT(tgl_lunas, '%m')) <> '00' ".
					"AND round(DATE_FORMAT(tgl_lunas, '%Y')) <> '0000' ".
					"ORDER BY tgl_beli DESC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?xbln1=$xbln1&xthn1=$xthn1";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);

	if ($count != 0)
		{
		echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="80" align="center"><strong><font color="'.$warnatext.'">Tanggal</font></strong></td>
		<td width="100" align="center"><strong><font color="'.$warnatext.'">No. Faktur</font></strong></td>
		<td align="center"><strong><font color="'.$warnatext.'">Supplier</font></strong></td>
		<td width="80" align="center"><strong><font color="'.$warnatext.'">Jenis Pembayaran</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Total</font></strong></td>
		<td width="100" align="center"><strong><font color="'.$warnatext.'">Bank</font></strong></td>
		<td width="150" align="center"><strong><font color="'.$warnatext.'">Tgl. Pelunasan</font></strong></td>
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
			$y_kd = nosql($data['kd']);
			$y_tgl_beli = $data['tgl_beli'];
			$y_no_faktur = balikin($data['no_faktur']);
			$y_kd_byr = nosql($data['kd_jns_byr']);
			$y_supkd = nosql($data['kd_supplier']);
			$y_bank = balikin($data['bank']);
			$y_diskon = nosql($data['diskon']);
			$y_tot_byr = nosql($data['total_bayar']);

			//total sementara
			$qduwi = mysql_query("SELECT SUM(subtotal) AS subtotal ".
									"FROM beli_detail ".
									"WHERE kd_beli = '$y_kd'");
			$rduwi = mysql_fetch_assoc($qduwi);
			$y_total_beli = nosql($rduwi['subtotal']);
			$y_total_diskon = round((($y_diskon * $total_beli)/100),2);


			//total
			//nek gak ada diskon
			if (empty($y_diskon))
				{
				$y_total_bayar = $y_total_beli;
				}
			else if (empty($t_tot_byr))
				{
				$y_total_bayar = $y_tot_byr;
				}
			else
				{
				$y_total_bayar = round($y_total_beli - $y_total_diskon,2);
				}

			//nek null
			if (empty($y_total_bayar))
				{
				$y_total_bayarx = "-";
				}
			else
				{
				$y_total_bayarx = $y_total_bayar;
				}



			//tgl. pelunasan
			$y_ltgl = nosql($data['ltgl']);
			$y_lbln = nosql($data['lbln']);
			$y_lthn = nosql($data['lthn']);

			if ($y_ltgl == "00")
				{
				$y_ltgl = "";
				}

			if ($y_lthn == "000")
				{
				$y_lthn = "";
				}




			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input name="kd'.$nomer.'" type="hidden" value="'.$y_kd.'">
			'.$y_tgl_beli.'
			</td>
			<td>'.$y_no_faktur.'</td>

			<td>';
			//supplier
			$qsup = mysql_query("SELECT * FROM m_supplier ".
									"WHERE kd = '$y_supkd'");
			$rsup = mysql_fetch_assoc($qsup);
			$sup_nm = balikin($rsup['singkatan']);

			echo $sup_nm;

			echo '</td>

			<td align="center">';

			//terpilih
			$qbyrx = mysql_query("SELECT * FROM m_jns_byr ".
									"WHERE kd = '$y_kd_byr'");
			$rbyrx = mysql_fetch_assoc($qbyrx);
			$byrx_nm = balikin($rbyrx['jns_byr']);

			echo ''.$byrx_nm.'
			</td>
			<td align="right">
			'.$y_total_bayarx.'
			</td>

			<td>
			'.$y_bank.'
			</td>


			<td>
			'.$y_ltgl.' '.$arrbln1[$y_lbln].' '.$y_lthn.'
			</td>

	        </tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
		</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<font color="red"><strong>TIDAK ADA DAFTAR PELUNASAN.</strong></red>';
		}
	}

echo '</form>
<br><br><br>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xfree($qbw);
xfree($result);
xclose($koneksi);
exit();
?>