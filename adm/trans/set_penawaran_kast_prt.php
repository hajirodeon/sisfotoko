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
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$filenya = "set_penawaran_kast_prt.php";
$judul = "PENAWARAN HARGA ATK";
$judulku = $judul;
$judulx = $judul;
$kastkd = nosql($_REQUEST['kastkd']);
$pwkd = nosql($_REQUEST['pwkd']);
$ptgl = nosql($_REQUEST['wtgl']);
$pbln = nosql($_REQUEST['wbln']);
$pthn = nosql($_REQUEST['wthn']);
$page = nosql($_REQUEST['page']);



//re-direct
$ke = "set_penawaran_kast.php?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
$diload = "window.print();location.href='$ke';";








//isi *START
ob_start();

//query
$qdata = mysql_query("SELECT kastumer_brg_detail.*, kastumer_brg_detail.kd AS kbkd, ".
						"m_brg.* ".
						"FROM kastumer_brg_detail, m_brg ".
						"WHERE kastumer_brg_detail.kd_brg = m_brg.kd ".
						"AND kastumer_brg_detail.kd_kastumer_brg = '$pwkd' ".
						"ORDER BY m_brg.nama ASC");
$rdata = mysql_fetch_assoc($qdata);
$tdata = mysql_num_rows($qdata);



//require
require("../../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form method="post" name="formx">
<table width="500" border="0" cellspacing="0" cellpadding="3">
<tr>
<td align="center">';
xheadline($judul);
echo '<br>
Per : '.$ptgl.' '.$arrbln1[$pbln].' '.$pthn.'</td>
</tr>
</table>
<table width="500" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="5"><strong><font color="'.$warnatext.'">No.</font></strong></td>
<td><strong><font color="'.$warnatext.'">Deskripsi</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Satuan</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Harga</font></strong></td>
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
		$y_kd = nosql($rdata['kbkd']);
		$y_brgkd = nosql($rdata['kd_brg']);
		$y_kode = nosql($rdata['kode']);
		$y_nama = balikin($rdata['nama']);
		$y_katkd = nosql($rdata['kd_kategori']);
		$y_merkkd = nosql($rdata['kd_merk']);
		$y_stkd = nosql($rdata['kd_satuan']);
		$y_diskon = nosql($rdata['diskon']);
		$y_hrg = nosql($rdata['hrg_jual_br']);


		//nek null
		if (empty($y_diskon))
			{
			$y_diskon = $dik_diskon;
			}


		//harga di stock
		$qstk = mysql_query("SELECT * FROM stock ".
								"WHERE kd_brg = '$y_brgkd'");
		$rstk = mysql_fetch_assoc($qstk);
		$stk_hjual = nosql($rstk['hrg_jual']);


		//satuan
		$qstu = mysql_query("SELECT * FROM m_satuan ".
								"WHERE kd = '$y_stkd'");
		$rstu = mysql_fetch_assoc($qstu);
		$y_satuan = balikin($rstu['satuan']);


		//nek null
		if (empty($y_hrg))
			{
			//hrg...%
			$p_nil = round($stk_hjual * 100);
			$p_nil2 = round((100 - $dik_diskon),2);
			$p_nilx = round($p_nil / $p_nil2);
			$d_muhrg = $p_nilx;


			//nek pembulatan
			$blt50 = substr($d_muhrg,-2,2);
			$blt50x = round($d_muhrg - $blt50);

			//50
			if (($blt50 >= 1) AND ($blt50 < 50))
				{
				$d_muhrg = $blt50x + 50;
				}

			//100
			else if (($blt50 > 50) AND ($blt50 < 100))
				{
				$d_muhrg = $blt50x + 100;
				}
			}
		else
			{
			$d_muhrg = $y_hrg;
			}


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$nomer.'.</td>
		<td>'.$y_nama.'</td>
		<td>'.$y_satuan.'</td>
		<td align="right">'.$d_muhrg.'</td>
		</tr>';
		}
	while ($rdata = mysql_fetch_assoc($qdata));
	}


echo '</table>
</form>
<br><br><br>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>
