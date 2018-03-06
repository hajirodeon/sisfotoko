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
$judul = "Entry Stock Barang";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$a = nosql($_REQUEST['a']);
$brgkd = nosql($_REQUEST['brgkd']);
$supkd = nosql($_REQUEST['supkd']);
$belkd = nosql($_REQUEST['belkd']);
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$yuk = nosql($_REQUEST['yuk']);
$katkd = nosql($_REQUEST['katkd']);
$merkkd = nosql($_REQUEST['merkkd']);
$kode = nosql($_REQUEST['y_kode']);
$y_kode = nosql($_REQUEST['y_kode']);
$filenya = "beli_brg_entry.php?supkd=$supkd&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&belkd=$belkd&yuk=detail&y_kode=$y_kode";





//nek null
if (empty($katkd))
	{
	$diload = "document.formx.kategori.focus();";
	}
else if (empty($merkkd))
	{
	$diload = "document.formx.merk.focus();";
	}
else if (empty($kode))
	{
	$diload = "document.formx.kode.focus();";
	}
else
	{
	$diload = "document.formx.nama.focus();";
	}




//nek null
if (empty($prs_tung))
	{
	$prs_tung = "0";
	}

$ke = $filenya;
$kecek = "$filenya&katkd=$katkd&merkkd=$merkkd&a=cek&kode=$kode";


//nek enter
$x_enter = 'onkeydown="return handleEnter(this, event)"';
$x_enter2 = 'onkeydown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP.focus();
	document.formx.btnSMP.submit();
	}"';





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "beli.php?supkd=$supkd&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&belkd=$belkd&yuk=detail";
	xloc($ke);
	exit();
	}





//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$a = nosql($_POST['a']);
	$brgkd = nosql($_POST['brgkd']);
	$katkd = nosql($_POST['katkd']);
	$merkkd = nosql($_POST['merkkd']);
	$kode = strtoupper(nosql($_POST['kode']));
	$barkode = nosql($_POST['barkode']);
	$nama = cegah2($_POST['nama']);
	$merkkd = nosql($_POST['merk']);
	$katkd = nosql($_POST['kategori']);
	$stkd = nosql($_POST['satuan']);
	$jml_toko = nosql($_POST['jml_toko']);
	$jml_gudang = nosql($_POST['jml_gudang']);
	$jml_min = nosql($_POST['jml_min']);
	$prs_tung = nosql($_POST['prs_tung']);
	$hrg_beli = nosql($_POST['hrg_beli']);

	$hrg_jual = nosql($_POST['hrg_jual']);

	//nek pembulatan
	$blt50 = substr($hrg_jual,-2,2);
	$blt50x = round($hrg_jual - $blt50);

	//50
	if (($blt50 >= 1) AND ($blt50 < 50))
		{
		$hrg_jual = $blt50x + 50;
		}

	//100
	else if (($blt50 > 50) AND ($blt50 < 100))
		{
		$hrg_jual = $blt50x + 100;
		}





	//jika baru
	if (empty($s))
		{
		//nek kode masih kosong
		if (empty($kode))
			{
			//null-kan
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Kode Barang Belum Dimasukkan. Harap Diulangi...!!";
			$ke = "$filenya&katkd=$katkd&merkkd=$merkkd";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			///cek kode
			$qcc = mysql_query("SELECT * FROM m_brg ".
									"WHERE kode = '$kode'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			///cek barcode
			$qcc1 = mysql_query("SELECT * FROM m_brg ".
									"WHERE barkode = '$barkode'");
			$rcc1 = mysql_fetch_assoc($qcc1);
			$tcc1 = mysql_num_rows($qcc1);
			$cc1_barkode = nosql($rcc1['barkode']);

			//nek ada
			if ($tcc != 0)
				{
				//null-kan
				xfree($qbw);
				xfree($qcc);
				xfree($qcc1);
				xclose($koneksi);

				//re-direct
				$pesan = "Kode Barang : $kode, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya&katkd=$katkd&merkkd=$merkkd";
				pekem($pesan,$ke);
				exit();
				}
			else if (($tcc1 != 0) AND ($cc1_barkode != ''))
				{
				//null-kan
				xfree($qbw);
				xfree($qcc);
				xfree($qcc1);
				xclose($koneksi);

				//re-direct
				$pesan = "BarCode Barang : $barkode, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya&katkd=$katkd&merkkd=$merkkd";
				pekem($pesan,$ke);
				exit();
				}
			else //re-direct utk lengkapi entry
				{
				if ($a != "isi")
					{
					//null-kan
					xfree($qbw);
					xclose($koneksi);

					//re-direct
					$ke = "$filenya&katkd=$katkd&merkkd=$merkkd&a=isi&kode=$kode";
					xloc($ke);
					exit();
					}
				}
			}



		//nek null entry dan kode sudah ada
		if ((empty($nama)) AND ($kode != ""))
			{
			//null-kan
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Input Tidak Lengkap. Harap Diulangi...!";
			$ke = "$filenya&katkd=$katkd&merkkd=$merkkd&a=isi&kode=$kode";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//jika telah isi
			if ($a == "isi")
				{
				//ke m_brg
				mysql_query("INSERT INTO m_brg(kd, kd_merk, kd_kategori, kd_satuan, kode, barkode, nama, postdate) VALUES ".
								"('$x', '$merkkd', '$katkd', '$stkd', '$kode', '$barkode', '$nama', '$today')");

				//ke stock
				$xi = md5($today3);

				mysql_query("INSERT INTO stock(kd, kd_brg, jml_toko, jml_gudang, jml_min, hrg_beli, hrg_jual, persen) VALUES ".
								"('$xi', '$x', '$jml_toko', '$jml_gudang', '$jml_min', '$hrg_beli', '$hrg_jual', '$prs_tung')");


				//null-kan
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$uke = "beli.php?supkd=$supkd&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
							"&belkd=$belkd&yuk=detail&a=isi&y_kode=$y_kode".
							"&y_nama=$nama&y_hrg_lama=$hrg_beli";
				xloc($uke);
				exit();
				}
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


echo '
<script type="text/javascript" src="'.$sumber.'/inc/js/dhtmlwindow_adm.js"></script>
<script type="text/javascript" src="'.$sumber.'/inc/js/modal.js"></script>
<script type="text/javascript">

function open_kat()
	{
	kat_window=dhtmlmodal.open(\'Kategori\',
	\'iframe\',
	\'beli_brg_kat.php\',
	\'Kategori\',
	\'width=550px,height=325px,center=1,resize=0,scrolling=0\')

	kat_window.onclose=function()
		{
		document.formx.kategori.focus();

		return true
		}
	}


function open_merk()
	{
	merk_window=dhtmlmodal.open(\'Merk\',
	\'iframe\',
	\'beli_brg_merk.php\',
	\'Merk\',
	\'width=550px,height=325px,center=1,resize=0,scrolling=0\')

	merk_window.onclose=function()
		{
		document.formx.merk.focus();
		return true
		}
	}

</script>';


//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/down_enter.js");
require("../../inc/js/number.js");
require("../../inc/menu/adm.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form method="post" action="'.$filenya.'" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td>';
xheadline($judul);
echo '</td>
</tr>
</table>

<table width="100%" bgcolor="'.$warna02.'" border="0" cellspacing="3" cellpadding="0">
<tr valign="top">
<td>
Kategori : <br>';
echo "<select name=\"kategori\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qsupx = mysql_query("SELECT * FROM m_kategori ".
						"WHERE kd = '$katkd'");
$rsupx = mysql_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['kategori']);

echo '<option value="'.$supx_kd.'" selected>'.$supx_nm.'</option>';

//query
$qsup = mysql_query("SELECT * FROM m_kategori ".
						"WHERE kd <> '$katkd' ".
						"ORDER BY kategori ASC");
$rsup = mysql_fetch_assoc($qsup);

do
	{
	$sup_kd = nosql($rsup['kd']);
	$sup_sing = balikin($rsup['kategori']);

	echo '<option value="'.$filenya.'&a=isi&katkd='.$sup_kd.'">'.$sup_sing.'</option>';
	}
while ($rsup = mysql_fetch_assoc($qsup));

echo '</select>
<input name="btnKAT" type="button" value="..." onClick="open_kat(); return false">
<br>

Merk :
<br>';

echo "<select name=\"merk\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qmerx = mysql_query("SELECT * FROM m_merk ".
						"WHERE kd = '$merkkd'");
$rmerx = mysql_fetch_assoc($qmerx);
$merx_kd = nosql($rmerx['kd']);
$merx_nm = balikin($rmerx['merk']);

echo '<option value="'.$merx_kd.'" selected>'.$merx_nm.'</option>';

//query
$qmer = mysql_query("SELECT * FROM m_merk ".
						"WHERE kd <> '$merkd' ".
						"ORDER BY merk ASC");
$rmer = mysql_fetch_assoc($qmer);

do
	{
	$mer_kd = nosql($rmer['kd']);
	$mer_sing = balikin($rmer['merk']);

	echo '<option value="'.$filenya.'&a=isi&&katkd='.$katkd.'&merkkd='.$mer_kd.'">'.$mer_sing.'</option>';
	}
while ($rmer = mysql_fetch_assoc($qmer));

echo '</select>
<input name="btnMER" type="button" value="..." onClick="open_merk(); return false">
<br>
Kode : <br>
<input name="kode" type="text" value="'.$kode.'" size="15" maxlength="15">
</td>

<td>
Nama :
<br>
<input name="nama" type="text" value="'.$nama.'" size="20" '.$x_enter.'>
<br>
Satuan : <br>
<select name="satuan" '.$x_enter.'>';
//jika edit
if (empty($stkd))
	{
	echo '<option value="" selected></option>';
	}
else
	{
	$qstx = mysql_query("SELECT * FROM m_satuan ".
							"WHERE kd = '$stkd'");
	$rstx = mysql_fetch_assoc($qstx);
	$stx = balikin($rstx['satuan']);

	echo '<option value="'.$stkd.'" selected>'.$stx.'</option>';
	}

//satuan
$qst = mysql_query("SELECT * FROM m_satuan ".
						"WHERE kd <> '$stkd' ".
						"ORDER BY satuan ASC");
$rst = mysql_fetch_assoc($qst);

do
	{
	$stkd = nosql($rst['kd']);
	$st = nosql($rst['satuan']);

	echo '<option value="'.$stkd.'">'.$st.'</option>';
	}
while ($rst = mysql_fetch_assoc($qst));


echo '</select>
<br>
Stock. Toko :
<br>
<input name="jml_toko" type="text" value="'.$jml_toko.'" size="5" style="text-align:right" onkeypress="return numbersonly(this, event)" '.$x_enter.'>
</td>

<td>
Stock. Gudang :
<br>
<input name="jml_gudang" type="text" value="'.$jml_gudang.'" size="5" style="text-align:right" onkeypress="return numbersonly(this, event)" '.$x_enter.'>
<br>
Stock. Minimal :
<br>
<input name="jml_min" type="text" value="'.$jml_min.'" size="5" style="text-align:right" onkeypress="return numbersonly(this, event)" '.$x_enter.'>
<br>
Harga Beli : <br>
<input name="hrg_beli" type="text" value="'.$hrg_beli.'" size="10" style="text-align:right"
onKeyUp="if (document.formx.hrg_beli.value == \'\')
	{
	document.formx.hrg_jual.value = \'0\';
	}
else
	{
	k_kur1=Math.round(document.formx.hrg_beli.value * 100);
	k_kur2=Math.round(100 - document.formx.prs_tung.value);
	k_kur=Math.round(k_kur1 / k_kur2);
	document.formx.hrg_jual.value=eval(k_kur);
	}" '.$x_enter.'>
</td>

<td>
</td>

<td>
Persen Keuntungan : <br>
<input name="prs_tung" type="text" value="'.$prs_tung.'" size="5" maxlength="5" style="text-align:right"
onKeyUp="if (document.formx.hrg_beli.value == \'\')
	{
	document.formx.hrg_jual.value = \'0\';
	}
else
	{
	k_kur1=Math.round(document.formx.hrg_beli.value * 100);
	k_kur2=Math.round(100 - document.formx.prs_tung.value);
	k_kur=Math.round(k_kur1 / k_kur2);
	document.formx.hrg_jual.value=eval(k_kur);
	}" '.$x_enter.'>%
<br>
Harga Jual : <br>
<input name="hrg_jual" type="text" value="'.$hrg_jual.'" size="10" style="text-align:right" onKeyPress="return numbersonly(this, event)" '.$x_enter.'>
<br>
BarCode :
<br>
<input name="barkode" type="text" value="'.$barkode.'" size="20" onKeyPress="return numbersonly(this, event)" '.$x_enter2.'>
<br>
</td>
</table>

<table width="100%" bgcolor="'.$warna02.'" border="0" cellspacing="3" cellpadding="0">
<tr valign="top">
<td>
<input name="s" type="hidden" value="'.$s.'">
<input name="a" type="hidden" value="'.$a.'">
<input name="brgkd" type="hidden" value="'.$brgkd.'">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</td>
</tr>
</table>




<br>
<br>
<br>';


//data ne...
//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT m_brg.*, m_brg.kd AS mbkd, stock.* ".
						"FROM m_brg, stock ".
						"WHERE stock.kd_brg = m_brg.kd ".
						"AND m_brg.kd_kategori = '$katkd' ".
						"AND m_brg.kd_merk = '$merkkd' ".
						"ORDER BY m_brg.kode DESC";


$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$target = "$filenya?katcari=$katcari&kunci=$kunci";
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);




echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
<td width="200"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Merk</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Kategori</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Satuan</font></strong></td>
<td width="50" align="center"><strong><font color="'.$warnatext.'">Stock. Toko</font></strong></td>
<td width="50" align="center"><strong><font color="'.$warnatext.'">Stock. Gudang</font></strong></td>
<td width="50" align="center"><strong><font color="'.$warnatext.'">Stock. Min.</font></strong></td>
<td width="50" align="center"><strong><font color="'.$warnatext.'">Stock. Total</font></strong></td>
<td width="75" align="center"><strong><font color="'.$warnatext.'">Hrg. Beli</font></strong></td>
<td width="75" align="center"><strong><font color="'.$warnatext.'">Hrg. Jual</font></strong></td>
</tr>';

if ($count != 0)
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


		$brgkd = nosql($data['mbkd']);

		//kategori
		$katkd = nosql($data['kd_kategori']);
		$qikat = mysql_query("SELECT * FROM m_kategori ".
								"WHERE kd = '$katkd'");
		$rikat = mysql_fetch_assoc($qikat);
		$ikat_kat = balikin($rikat['kategori']);

		//satuan
		$stkd = nosql($data['kd_satuan']);
		$qist = mysql_query("SELECT * FROM m_satuan ".
								"WHERE kd = '$stkd'");
		$rist = mysql_fetch_assoc($qist);
		$ist_st = balikin($rist['satuan']);

		//mer
		$merkkd = nosql($data['kd_merk']);
		$qimerk = mysql_query("SELECT * FROM m_merk ".
								"WHERE kd = '$merkkd'");
		$rimerk = mysql_fetch_assoc($qimerk);
		$imerk_merk = balikin($rimerk['merk']);



		$merk = $imerk_merk;
		$kategori = $ikat_kat;
		$satuan = $ist_st;
		$kode = nosql($data['kode']);
		$nama = balikin($data['nama']);
		$jml_gudang = nosql($data['jml_gudang']);
		$jml_toko = nosql($data['jml_toko']);
		$jml_min = nosql($data['jml_min']);
		$jml_total = $jml_toko + $jml_gudang;
		$hrg_beli = nosql($data['hrg_beli']);
		$hrg_jual = nosql($data['hrg_jual']);

		//nek null
		if (empty($jml_gudang))
			{
			$jml_gudang = "-";
			}

		if (empty($jml_toko))
			{
			$jml_toko = "-";
			}

		if (empty($jml_min))
			{
			$jml_min = "-";
			}

		if (empty($jml_total))
			{
			$jml_total = "-";
			}

		if (empty($hrg_beli))
			{
			$hrg_beli = "-";
			}

		if (empty($hrg_jual))
			{
			$hrg_jual = "-";
			}






		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$kode.'</td>
		<td>'.$nama.'</td>
		<td>'.$merk.'</td>
		<td>'.$kategori.'</td>
		<td>'.$satuan.'</td>
		<td align="right">'.$jml_toko.'</td>
		<td align="right">'.$jml_gudang.'</td>
		<td align="right">'.$jml_min.'</td>
		<td align="right">'.$jml_total.'</td>
		<td align="right">'.$hrg_beli.'</td>
		<td align="right">'.$hrg_jual.'</td>
        </tr>';
		}
	while ($data = mysql_fetch_assoc($result));
	}


echo '</table>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="300">
<input name="jml" type="hidden" value="'.$limit.'">
<input name="katkd" type="hidden" value="'.$katkd.'">
<input name="merkkd" type="hidden" value="'.$merkkd.'">
<input name="brgkd" type="hidden" value="'.$brgkd.'">
</td>
<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
</tr>
</table>
</form>
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