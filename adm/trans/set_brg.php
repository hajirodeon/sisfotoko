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
$filenya = "set_brg.php";
$judul = "Set Barang";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kode = nosql($_REQUEST['kode']);
$nama = balikin($_REQUEST['nama']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}

//focus & attribut
if (empty($kode))
	{
	$diload = "document.formx.kode.focus();";
	}




//PROSES tambah/edit ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($filenya);
	exit();
	}




//nek tambah
if ($_POST['btnTBH'])
	{
	//nilai
	$kode = nosql($_POST['kode']);
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);


	//jika baru
	if (empty($s))
		{
		//jika input tidak lengkap
		if (empty($kode))
			{
			//null-kan
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Kode Barang Masih Kosong. Harap Diulangi...!!";
			pekem($pesan,$filenya);
			exit();
			}
		else
			{
			//kd_brg ...kan
			$qddf = mysql_query("SELECT stock.*, m_brg.*, m_brg.kd AS mbkd ".
									"FROM stock, m_brg ".
									"WHERE stock.kd_brg = m_brg.kd ".
									"AND m_brg.kode = '$kode'");
			$rddf = mysql_fetch_assoc($qddf);
			$tddf = mysql_num_rows($qddf);
			$ddf_kd = nosql($rddf['mbkd']);
			$ddf_hjual = nosql($rddf['hrg_jual']);
			$ddf_nama = cegah($rddf['nama']);


			//nek ada
			if ($tddf != 0)
				{
				//cek lagi, jika sudah ada
				$qcc = mysql_query("SELECT * FROM penawaran_brg ".
										"WHERE kd_brg = '$ddf_kd'");
				$rcc = mysql_fetch_assoc($qcc);
				$tcc = mysql_num_rows($qcc);

				if ($tcc != 0)
					{
					//null-kan
					xfree($qbw);
					xfree($qcc);
					xclose($koneksi);

					//re-direct
					$pesan = "Barang dengan Kode : $kode, Sudah Ada. Silahkan Ganti Yang Lain...!!";
					pekem($pesan,$filenya);
					exit();
					}
				else
					{
					//insert
					mysql_query("INSERT INTO penawaran_brg(kd, kd_brg, hrg_jual) VALUES ".
									"('$x', '$ddf_kd', '$ddf_hjual')");

					//null-kan
					xfree($qbw);
					xclose($koneksi);

					//re-direct
					xloc($filenya);
					exit();
					}
				}
			else
				{
				//null-kan
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Barang dengan Kode : $kode, Tidak Ada. Harap Diulangi...!!";
				pekem($pesan,$filenya);
				exit();
				}
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










//PROSES hapus //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM penawaran_brg ".
						"WHERE kd = '$kd'");
		}

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//isi *START
ob_start();

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT penawaran_brg.*, penawaran_brg.kd AS kbkd, ".
				"m_brg.* ".
				"FROM penawaran_brg, m_brg ".
				"WHERE penawaran_brg.kd_brg = m_brg.kd ".
				"ORDER BY m_brg.kode ASC";


$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);

//window
echo '
<script type="text/javascript" src="'.$sumber.'/inc/js/dhtmlwindow_adm.js"></script>
<script type="text/javascript" src="'.$sumber.'/inc/js/modal.js"></script>
<script type="text/javascript">

function open_brg()
	{
	brg_window=dhtmlmodal.open(\'Barang\',
	\'iframe\',
	\'popup_brg.php\',
	\'Barang\',
	\'width=730px,height=350px,center=1,resize=0,scrolling=0\')

	brg_window.onclose=function()
		{
		var kodex=this.contentDoc.getElementById("kodex");

		document.formx.kode.value=kodex.value;
		document.formx.kode.focus();
		return true
		}
	}
</script>';


//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
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

<table bgcolor="'.$warna02.'" width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
Kode Barang :
<input name="kode" type="text" value="'.$kode.'" size="10" tabindex="1"
onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnTBH.focus();
	document.formx.btnTBH.submit();
	}

if (keyCode == 45)
	{
	open_brg();
	return false
	}
">
<input name="btnTBH" type="submit" value="SIMPAN>>>">
</td>
</tr>
</table>
<br>

<table width="800" border="1" cellspacing="0" cellpadding="3">
<tr valign="top" bgcolor="'.$warnaheader.'">
<td width="1%">&nbsp;</td>
<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama Barang</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">Kategori</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Merk</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Satuan</font></strong></td>
</tr>';

if ($count != 0)
	{
	do {
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
		$y_kd = nosql($data['kbkd']);
		$y_kode = nosql($data['kode']);
		$y_nama = balikin($data['nama']);
		$y_katkd = balikin($data['kd_kategori']);
		$y_merkkd = balikin($data['kd_merk']);
		$y_stkd = balikin($data['kd_satuan']);

		//kategori
		$qkat = mysql_query("SELECT * FROM m_kategori ".
								"WHERE kd = '$y_katkd'");
		$rkat = mysql_fetch_assoc($qkat);
		$y_kategori = balikin($rkat['kategori']);

		//merk
		$qmer = mysql_query("SELECT * FROM m_merk ".
								"WHERE kd = '$y_merkkd'");
		$rmer = mysql_fetch_assoc($qmer);
		$y_merk = balikin($rmer['merk']);

		//satuan
		$qstu = mysql_query("SELECT * FROM m_satuan ".
								"WHERE kd = '$y_stkd'");
		$rstu = mysql_fetch_assoc($qstu);
		$y_satuan = balikin($rstu['satuan']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$nomer.'" value="'.$y_kd.'">
        </td>
		<td>'.$y_kode.'</td>
		<td>'.$y_nama.'</td>
		<td>'.$y_kategori.'</td>
		<td>'.$y_merk.'</td>
		<td>'.$y_satuan.'</td>
        </tr>';
		}
	while ($data = mysql_fetch_assoc($result));
	}


echo '</table>
<table width="800" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="250">
<input name="jml" type="hidden" value="'.$count.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kd.'">
<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')">
<input name="btnBTL" type="reset" value="BATAL">
<input name="btnHPS" type="submit" value="HAPUS">
</td>
<td align="right">
<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
</td>
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
xclose($koneksi);
exit();
?>