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
require("../../inc/class/paging2.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "set_penawaran_kast.php";
$judul = "Set Penawaran Harga Kastumer";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;

$kastkd = nosql($_REQUEST['kastkd']);
$pwkd = nosql($_REQUEST['pwkd']);
$wtgl = nosql($_REQUEST['wtgl']);
$wbln = nosql($_REQUEST['wbln']);
$wthn = nosql($_REQUEST['wthn']);
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//enter
$x_enter4 = 'onKeyDown="return handleEnter(this, event)"';
$x_enter4x = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP.focus();
	document.formx.btnSMP.submit();
	}"';

//nek input pilih item & enter
//13 = "ENTER"
//45 = "INSERT"
$x_item = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnTBH.focus();
	document.formx.btnTBH.submit();
	}

if (keyCode == 45)
	{
	open_brg();
	return false
	}"';



//focus
if (empty($kastkd))
	{
	$diload = "document.formx.kastumer.focus();";
	}
else if ((empty($pwkd)) AND (empty($s)))
	{
	$diload = "document.formx.pwtgl.focus();";
	}
else if ($s == "baru")
	{
	$diload = "document.formx.ptgl.focus();";
	}
else if ($s != "detail")
	{
	$diload = "document.formx.btnSMP.focus();";
	}
else
	{
	$diload = "document.formx.y_kode.focus();";
	}







//nek baru //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnBR'])
	{
	//nilai
	$kastkd = nosql($_POST['kastkd']);

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?kastkd=$kastkd&s=baru";
	xloc($ke);
	exit();
	}





//nek hapus penawaran
if ($_POST['btnHPS'])
	{
	//nilai
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);

	//hapus detail
	mysql_query("DELETE FROM kastumer_brg_detail ".
					"WHERE kd_kastumer_brg = '$pwkd'");

	//hapus
	mysql_query("DELETE FROM kastumer_brg ".
					"WHERE kd_kastumer = '$kastkd' ".
					"AND kd = '$pwkd'");

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?kastkd=$kastkd";
	xloc($ke);
	exit();
	}





//set diskon
if ($_POST['btnSET'])
	{
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);
	$ptgl = nosql($_POST['ptgl']);
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);
	$set_diskon = round(nosql($_POST['set_diskon']));

	//update diskon
	mysql_query("UPDATE kastumer_set_diskon SET diskon = '$set_diskon'");

	//update diskon & harga jual baru utk kastumer nantinya
	$qkbg = mysql_query("SELECT kastumer_brg.*, kastumer_brg_detail.kd AS kbkd, ".
							"kastumer_brg_detail.* ".
							"FROM kastumer_brg, kastumer_brg_detail ".
							"WHERE kastumer_brg_detail.kd_kastumer_brg = kastumer_brg.kd ".
							"AND kastumer_brg.kd_kastumer = '$kastkd' ".
							"AND kastumer_brg.kd = '$pwkd' ".
							"ORDER BY kastumer_brg_detail.kd_brg ASC");
	$rkbg = mysql_fetch_assoc($qkbg);


	//looping
	do
		{
		//ambil nilai
		$xkd = nosql($rkbg['kbkd']);
		$xhjual = nosql($rkbg['hrg_jual']);


		//diskon... 'MU+%'
		$p_nil = round($xhjual * 100);
		$p_nil2 = round(100 - $set_diskon);
		$p_nilx = round($p_nil / $p_nil2);
		$x_muhrgx = $p_nilx;


		//nek pembulatan
		$blt50 = substr($x_muhrgx,-2,2);
		$blt50x = round($x_muhrgx - $blt50);

		//50
		if (($blt50 >= 1) AND ($blt50 < 50))
			{
			$x_muhrgx = $blt50x + 50;
			}

		//100
		else if (($blt50 > 50) AND ($blt50 < 100))
			{
			$x_muhrgx = $blt50x + 100;
			}


		//update
		mysql_query("UPDATE kastumer_brg_detail SET hrg_jual = '$xhjual', ".
						"diskon = '$set_diskon', ".
						"hrg_jual_br = '$x_muhrgx' ".
						"WHERE kd = '$xkd'");
		}
	while ($rkbg = mysql_fetch_assoc($qkbg));


	//null-kan
	xfree($qbw);
	xfree($qkbg);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn";
	xloc($ke);
	exit();
	}





//nek simpan detail
if ($_POST['btnSMP'])
	{
	//nilai
	$s = nosql($_POST['s']);
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);
	$ptgl = nosql($_POST['ptgl']);
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);
	$tgl_penawaran = "$pthn:$pbln:$ptgl";

	//cek null
	if ((empty($ptgl)) OR (empty($pbln)) OR (empty($pthn)))
		{
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?kastkd=$kastkd";
		pekem($pesan,$ke);
		}
	else
		{
		//nek baru
		if ($s == "baru")
			{
			//jika benar - benar baru (atau belum ada), ambilkan dari 'set barang umum'
			//cek
			$qcc = mysql_query("SELECT * FROM kastumer_brg ".
									"WHERE kd_kastumer = '$kastkd'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek belum ada
			if ($tcc == 0)
				{
				//baru per tanggal penawaran
				mysql_query("INSERT INTO kastumer_brg(kd, kd_kastumer, tgl_penawaran) VALUES ".
								"('$x', '$kastkd', '$tgl_penawaran')");


				//diskon yang ada
				$qkde = mysql_query("SELECT * FROM kastumer_set_diskon");
				$rkde = mysql_fetch_assoc($qkde);
				$kde_diskon = nosql($rkde['diskon']);


				//data yang akan di-transfer
				$qtup = mysql_query("SELECT * FROM penawaran_brg ".
										"ORDER BY kd_brg ASC");
				$rtup = mysql_fetch_assoc($qtup);
				$ttup = mysql_num_rows($qtup);


				//looping
				do
					{
					//nilai
					$ongko = $ongko + 1;
					$ongkox = md5("$today3$ongko");
					$i_brgkd = nosql($rtup['kd_brg']);
					$i_hjual = nosql($rtup['hrg_jual']);
					$i_diskon = $kde_diskon;


					//diskon... 'MU+%'
					$p_nil = round($i_hjual * 100);
					$p_nil2 = round(100 - $i_diskon);
					$p_nilx = round($p_nil / $p_nil2);
					$x_muhrgx = $p_nilx;


					//nek pembulatan
					$blt50 = substr($x_muhrgx,-2,2);
					$blt50x = round($x_muhrgx - $blt50);

					//50
					if (($blt50 >= 1) AND ($blt50 < 50))
						{
						$x_muhrgx = $blt50x + 50;
						}

					//100
					else if (($blt50 > 50) AND ($blt50 < 100))
						{
						$x_muhrgx = $blt50x + 100;
						}


					//masukkan
					mysql_query("INSERT INTO kastumer_brg_detail(kd, kd_kastumer_brg, kd_brg, hrg_jual, diskon, hrg_jual_br) VALUES ".
									"('$ongkox', '$x', '$i_brgkd', '$i_hjual', '$i_diskon', '$x_muhrgx')");
					}
				while ($rtup = mysql_fetch_assoc($qtup));

				//null-kan
				xfree($qbw);
				xfree($qcc);
				xfree($qtup);
				xclose($koneksi);

				//re-direct
				$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$x&wtgl=$ptgl&wbln=$pbln&wthn=$pthn";
				xloc($ke);
				exit();
				}
			else //jika sudah ada atau sudah pernah buat penawaran, ambil data barang dari tanggal sebelumnya...
				{
				//cek
				$qcc1 = mysql_query("SELECT * FROM kastumer_brg ".
										"WHERE kd_kastumer = '$kastkd' ".
										"AND round(DATE_FORMAT(tgl_penawaran, '%d')) = '$ptgl' ".
										"AND round(DATE_FORMAT(tgl_penawaran, '%m')) = '$pbln' ".
										"AND round(DATE_FORMAT(tgl_penawaran, '%Y')) = '$pthn'");
				$rcc1 = mysql_fetch_assoc($qcc1);
				$tcc1 = mysql_num_rows($qcc1);

				//nek iya
				if ($tcc1 != 0)
					{
					//null-kan
					xfree($qbw);
					xfree($qcc1);
					xclose($koneksi);

					//re-direct
					$pesan = "Tanggal Penawaran Tersebut Sudah Ada. Silahkan Ganti Yang Lain...!!";
					$ke = "$filenya?kastkd=$kastkd";
					pekem($pesan,$ke);
					exit();
					}
				else
					{
					//data yang akan di-transfer, dari tanggal sebelumnya (DESC)
					$qhui = mysql_query("SELECT * FROM kastumer_brg ".
											"WHERE kd_kastumer = '$kastkd' ".
											"ORDER BY tgl_penawaran DESC");
					$rhui = mysql_fetch_assoc($qhui);
					$thui = mysql_num_rows($qhui);
					$hui_kd = nosql($rhui['kd']);


					//insert
					mysql_query("INSERT INTO kastumer_brg(kd, kd_kastumer, tgl_penawaran) VALUES ".
									"('$x', '$kastkd', '$tgl_penawaran')");


					//detailnya....
					$qtup = mysql_query("SELECT * FROM kastumer_brg_detail ".
											"WHERE kd_kastumer_brg = '$hui_kd' ".
											"ORDER BY kd_brg ASC");
					$rtup = mysql_fetch_assoc($qtup);
					$ttup = mysql_num_rows($qtup);


					//looping
					do
						{
						//nilai
						$ongko = $ongko + 1;
						$ongkox = md5("$today3$ongko");
						$i_brgkd = nosql($rtup['kd_brg']);
						$i_hjual = nosql($rtup['hrg_jual']);
						$i_diskon = nosql($rtup['diskon']);
						$i_hjual_br = nosql($rtup['hrg_jual_br']);

						//masukkan
						mysql_query("INSERT INTO kastumer_brg_detail(kd, kd_kastumer_brg, kd_brg, hrg_jual, diskon, hrg_jual_br) VALUES ".
										"('$ongkox', '$x', '$i_brgkd', '$i_hjual', '$i_diskon', '$i_hjual_br')");
						}
					while ($rtup = mysql_fetch_assoc($qtup));



					//null-kan
					xfree($qbw);
					xfree($qcc1);
					xclose($koneksi);

					//re-direct
					$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$x&wtgl=$ptgl&wbln=$pbln&wthn=$pthn";
					xloc($ke);
					exit();
					}
				}
			}


		//nek update
		else
			{
			//update
			mysql_query("UPDATE kastumer_brg ".
							"SET tgl_penawaran = '$tgl_penawaran' ".
							"WHERE kd_kastumer = '$kastkd' ".
							"AND kd = '$pwkd'");

			//null-kan
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn";
			xloc($ke);
			exit();
			}
		}
	}





//nek simpan item
if ($_POST['btnSMP2'])
	{
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);
	$ptgl = nosql($_POST['ptgl']);
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);
	$tgl_penawaran = "$pthn:$pbln:$ptgl";
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);
	$set_diskon = nosql($_POST['set_diskon']);


	//looping
	for($ongko=1;$ongko<=$jml;$ongko++)
		{
		//ambil nilai
		$xkd = "kd";
		$xkd1 = "$xkd$ongko";
		$xkdx = nosql($_POST["$xkd1"]);

		$xdisk = "disk";
		$xdisk1 = "$xdisk$ongko";
		$xdiskx = round(nosql($_POST["$xdisk1"]));

		$xhjual = "hjual";
		$xhjual1 = "$xhjual$ongko";
		$xhjualx = nosql($_POST["$xhjual1"]);

		//nek null
		if (empty($xdiskx))
			{
			$xdiskx = $set_diskon;
			}

		//diskon... 'MU+%'
		$p_nil = round($xhjualx * 100);
		$p_nil2 = round(100 - $xdiskx);
		$p_nilx = round($p_nil / $p_nil2);
		$x_muhrgx = $p_nilx;


		//nek pembulatan
		$blt50 = substr($x_muhrgx,-2,2);
		$blt50x = round($x_muhrgx - $blt50);

		//50
		if (($blt50 >= 1) AND ($blt50 < 50))
			{
			$x_muhrgx = $blt50x + 50;
			}

		//100
		else if (($blt50 > 50) AND ($blt50 < 100))
			{
			$x_muhrgx = $blt50x + 100;
			}


		//update
		mysql_query("UPDATE kastumer_brg_detail SET hrg_jual = '$xhjualx', ".
						"diskon = '$xdiskx', ".
						"hrg_jual_br = '$x_muhrgx' ".
						"WHERE kd = '$xkdx'");
		}

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
	xloc($ke);
	exit();
	}





//nek hapus item
if ($_POST['btnHPS2'])
	{
	//ambil nilai
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);
	$ptgl = nosql($_POST['ptgl']);
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM kastumer_brg_detail ".
						"WHERE kd_kastumer_brg = '$pwkd' ".
						"AND kd = '$kd'");
		}

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
	xloc($ke);
	exit();
	}





//nek tambah item
if ($_POST['btnTBH'])
	{
	//ambil nilai
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);
	$ptgl = nosql($_POST['ptgl']);
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);
	$y_kode = nosql($_POST['y_kode']);
	$page = nosql($_POST['page']);
	$set_diskon = nosql($_POST['set_diskon']);

	//null...?
	if (empty($y_kode))
		{
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!";
		$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//cek
		$qcc = mysql_query("SELECT stock.*, m_brg.* ".
								"FROM stock, m_brg ".
								"WHERE stock.kd_brg = m_brg.kd ".
								"AND m_brg.kode = '$y_kode'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);
		$cc_brgkd = nosql($rcc['kd_brg']);
		$cc_hjual = nosql($rcc['hrg_jual']);
		$cc_hjual_br = round(($cc_hjual * 100) / (100 - $set_diskon));

		//nek pembulatan
		$blt50 = substr($cc_hjual_br,-2,2);
		$blt50x = round($cc_hjual_br - $blt50);

		//50
		if (($blt50 >= 1) AND ($blt50 < 50))
			{
			$cc_hjual_br = $blt50x + 50;
			}

		//100
		else if (($blt50 > 50) AND ($blt50 < 100))
			{
			$cc_hjual_br = $blt50x + 100;
			}


		//nek null
		if ($tcc == 0)
			{
			$pesan = "Barang dengan Kode = '$y_kode', Tidak Ada. Harap Diulangi...!";
			$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
			pekem($pesan,$ke);
			exit();
			}
		//nek ada
		else
			{
			//jika sudah ada di-daftar
			$qcc1 = mysql_query("SELECT * FROM kastumer_brg_detail ".
									"WHERE kd_kastumer_brg = '$pwkd' ".
									"AND kd_brg = '$cc_brgkd'");
			$rcc1 = mysql_fetch_assoc($qcc1);
			$tcc1 = mysql_num_rows($qcc1);

			//nek iya
			if ($tcc1 != 0)
				{
				$pesan = "Kode Barang : $y_kode, Sudah Ada. Silahkan Ganti Yang Lain...!";
				$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//insert
				mysql_query("INSERT INTO kastumer_brg_detail(kd, kd_kastumer_brg, kd_brg, hrg_jual, diskon, hrg_jual_br) VALUES ".
								"('$x', '$pwkd', '$cc_brgkd', '$cc_hjual', '$set_diskon', '$cc_hjual_br')");

				//auto-kembali
				$ke = "$filenya?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
				xloc($ke);
				exit();
				}
			}
		}
	}





//print penawaran
if ($_POST['btnPWR'])
	{
	//ambil nilai
	$kastkd = nosql($_POST['kastkd']);
	$pwkd = nosql($_POST['pwkd']);
	$ptgl = nosql($_POST['ptgl']);
	$pbln = nosql($_POST['pbln']);
	$pthn = nosql($_POST['pthn']);


	//null-kan
	xfree($qbw);
	xclose($koneksi);


	//ke print
	$ke = "set_penawaran_kast_prt.php?s=detail&kastkd=$kastkd&pwkd=$pwkd&wtgl=$ptgl&wbln=$pbln&wthn=$pthn&page=$page";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();


echo '<script type="text/javascript" src="'.$sumber.'/inc/js/dhtmlwindow_adm.js"></script>
<script type="text/javascript" src="'.$sumber.'/inc/js/modal.js"></script>
<script type="text/javascript">

function open_brg()
	{
	brg_window=dhtmlmodal.open(\'Barang\',
	\'iframe\',
	\'popup_brg.php?kastkd='.$kastkd.'\',
	\'Daftar Barang\',
	\'width=720px,height=325px,center=1,resize=0,scrolling=0\')

	brg_window.onclose=function()
		{
		var kodex=this.contentDoc.getElementById("kodex");

		document.formx.y_kode.value=kodex.value;
		document.formx.y_kode.focus();
		return true
		}
	}
</script>';



//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/down_enter.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
require("../../inc/menu/adm_cek.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form method="post" name="formx">
<table width="600" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';
xheadline($judul);
echo '</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warna02.'">
<td>
<strong>Kastumer : </strong>';
echo "<select name=\"kastumer\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qsupx = mysql_query("SELECT * FROM m_kastumer ".
						"WHERE kd = '$kastkd'");
$rsupx = mysql_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['singkatan']);


echo '<option value="'.$supx_kd.'" selected>'.$supx_nm.'</option>';

//query
$qsup = mysql_query("SELECT * FROM m_kastumer ".
						"WHERE kd <> '$kastkd' ".
						"ORDER BY singkatan ASC");
$rsup = mysql_fetch_assoc($qsup);

do
	{
	$sup_kd = nosql($rsup['kd']);
	$sup_sing = balikin($rsup['singkatan']);

	echo '<option value="'.$filenya.'?kastkd='.$sup_kd.'">'.$sup_sing.'</option>';
	}
while ($rsup = mysql_fetch_assoc($qsup));

echo '</select>,

<strong>Tanggal Penawaran : </strong>';
echo "<select name=\"pwtgl\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtru = mysql_query("SELECT DATE_FORMAT(kastumer_brg.tgl_penawaran, '%d') AS wtgl, ".
						"DATE_FORMAT(kastumer_brg.tgl_penawaran, '%m') AS wbln, ".
						"DATE_FORMAT(kastumer_brg.tgl_penawaran, '%Y') AS wthn, ".
						"kastumer_brg.* ".
						"FROM kastumer_brg ".
						"WHERE kd_kastumer = '$kastkd' ".
						"AND kd = '$pwkd'");
$rtru = mysql_fetch_assoc($qtru);
$tru_tgl = nosql($rtru['wtgl']);
$tru_bln = nosql($rtru['wbln']);
$tru_thn = nosql($rtru['wthn']);
$tru_kd = nosql($rtru['kd']);


//jumlah e...
$qyun = mysql_query("SELECT * FROM kastumer_brg_detail ".
						"WHERE kd_kastumer_brg = '$tru_kd'");
$ryun = mysql_fetch_assoc($qyun);
$tyun = mysql_num_rows($qyun);

echo '<option selected>'.$tru_tgl.' '.$arrbln1[$tru_bln].' '.$tru_thn.' => ['.$tyun.' Item].</option>';

//data
$qtrux = mysql_query("SELECT DATE_FORMAT(tgl_penawaran, '%d') AS ptgl, ".
							"DATE_FORMAT(tgl_penawaran, '%m') AS pbln, ".
							"DATE_FORMAT(tgl_penawaran, '%Y') AS pthn, ".
							"kastumer_brg.* ".
							"FROM kastumer_brg ".
							"WHERE kd_kastumer = '$kastkd' ".
							"AND kd <> '$pwkd' ".
							"ORDER BY tgl_penawaran DESC");
$rtrux = mysql_fetch_assoc($qtrux);

do
	{
	$i_ptgl = nosql($rtrux['ptgl']);
	$i_pbln = nosql($rtrux['pbln']);
	$i_pthn = nosql($rtrux['pthn']);
	$i_kkbrg = nosql($rtrux['kd']);

	//jumlahnya
	$qyukx = mysql_query("SELECT * FROM kastumer_brg_detail ".
							"WHERE kd_kastumer_brg = '$i_kkbrg'");
	$ryukx = mysql_fetch_assoc($qyukx);
	$tyukx = mysql_num_rows($qyukx);

	echo '<option value="'.$filenya.'?kastkd='.$kastkd.'&pwkd='.$i_kkbrg.'&wtgl='.$i_ptgl.'&wbln='.$i_pbln.'&wthn='.$i_pthn.'">
	'.$i_ptgl.' '.$arrbln1[$i_pbln].' '.$i_pthn.' => ['.$tyukx.' Item].</option>';
	}
while ($rtrux = mysql_fetch_assoc($qtrux));

echo '</select>
<input name="s" type="hidden" value="'.$s.'">
<input name="kastkd" type="hidden" value="'.nosql($_REQUEST['kastkd']).'">
<input name="pwkd" type="hidden" value="'.nosql($_REQUEST['pwkd']).'">
<input name="btnBR" type="submit" value="BARU">
</td>
</tr>
</table>';

//nek masih do null
if (empty($kastkd))
	{
	echo "<strong>Kastumer Belum Dipilih...!!</strong>";
	}
else if ((empty($wtgl)) AND (empty($s)))
	{
	echo "<strong>Tgl. Penawaran Belum Dipilih...!!</strong>";
	}
else
	{
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="'.$warnaover.'">
	<tr>
	<td>
	<strong>Tgl. Penawaran : </strong>
	<select name="ptgl" '.$x_enter4.'>
	<option value="'.$tru_tgl.'" selected>'.$tru_tgl.'</option>';
	for ($i=1;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}

	echo '</select>
	<select name="pbln" '.$x_enter4.'>
	<option value="'.$tru_bln.'" selected>'.$arrbln1[$tru_bln].'</option>';
	for ($j=1;$j<=12;$j++)
		{
		echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
		}

	echo '</select>
	<select name="pthn" '.$x_enter4x.'>
	<option value="'.$tru_thn.'" selected>'.$tru_thn.'</option>';

	//query
	$qthn3 = mysql_query("SELECT * FROM m_tahun ".
							"ORDER BY tahun DESC");
	$rthn3 = mysql_fetch_assoc($qthn3);

	do
		{
		$x_thn3 = nosql($rthn3['tahun']);
		echo '<option value="'.$x_thn3.'">'.$x_thn3.'</option>';
		}
	while ($rthn3 = mysql_fetch_assoc($qthn3));

	echo '</select>
	<input name="btnHPS" type="submit" value="HAPUS">
	<input name="btnSMP" type="submit" value="SIMPAN & DETAIL >>>">
	</td>
	<td align="right">
	<input name="btnPWR" type="submit" value="Print Penawaran">
	</td>
	</tr>
	</table>
	<br>';


	//nek detail
	if ($s == "detail")
		{
		//query diskon
		$qdik = mysql_query("SELECT * FROM kastumer_set_diskon");
		$rdik = mysql_fetch_assoc($qdik);
		$dik_diskon = nosql($rdik['diskon']);


		//query data
		$p = new Pager();
		$start = $p->findStart($limit);

		$sqlcount = "SELECT kastumer_brg_detail.*, kastumer_brg_detail.kd AS kbkd, ".
						"m_brg.*, kastumer_brg.* ".
						"FROM kastumer_brg_detail, kastumer_brg, m_brg ".
						"WHERE kastumer_brg_detail.kd_brg = m_brg.kd ".
						"AND kastumer_brg_detail.kd_kastumer_brg = kastumer_brg.kd ".
						"AND kastumer_brg_detail.kd_kastumer_brg = '$pwkd' ".
						"ORDER BY m_brg.nama ASC";

		$sqlresult = $sqlcount;

		$count = mysql_num_rows(mysql_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysql_fetch_array($result);


		echo '<table width="600" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		Kode Barang :
		<input name="y_kode" type="text" value="" size="10" '.$x_item.'>
		<input name="btnTBH" type="submit" value="SIMPAN >>>">
		</td>
		<td align="right">
		Diskon :
		<input name="set_diskon" type="text" value="'.$dik_diskon.'" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)">%
		<input name="btnSET" type="submit" value="SET">
		</td>
		</tr>
		</table>
		<table width="600" border="1" cellspacing="0" cellpadding="3">
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="1%">&nbsp;</td>
		<td width="50"><strong><font color="'.$warnatext.'">Kode</font></strong></td>
		<td><strong><font color="'.$warnatext.'">Nama Barang</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">Satuan</font></strong></td>
		<td width="70"><strong><font color="'.$warnatext.'">Diskon</font></strong></td>
		<td width="75"><strong><font color="'.$warnatext.'">Harga</font></strong></td>
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
				$y_kd = nosql($data['kbkd']);
				$y_brgkd = nosql($data['kd_brg']);
				$y_kode = nosql($data['kode']);
				$y_nama = balikin($data['nama']);
				$y_katkd = nosql($data['kd_kategori']);
				$y_merkkd = nosql($data['kd_merk']);
				$y_stkd = nosql($data['kd_satuan']);
				$y_diskon = nosql($data['diskon']);
				$y_hrg = nosql($data['hrg_jual_br']);


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



				//pageup
				$nil = $nomer - 1;

				if ($nil < 1)
					{
					$nil = 1;
					}

				if ($nil > $limit)
					{
					$nil = $limit;
					}

				//pagedown
				$nild = $nomer + 1;

				if ($nild < 1)
					{
					$nild = $nild + 1;
					}

				if ($nild > $limit)
					{
					$nild = $limit;
					}


				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$y_kd.'">
				<input type="checkbox" name="item'.$nomer.'" value="'.$y_kd.'">
				</td>
				<td>'.$y_kode.'</td>
				<td>'.$y_nama.'</td>
				<td>'.$y_satuan.'</td>
				<td>
				<input name="hjual'.$nomer.'" type="hidden" value="'.$stk_hjual.'">
				<input name="disk'.$nomer.'" type="text" value="'.$y_diskon.'" size="2" maxlength="2" style="text-align:right"
				onKeyPress="return numbersonly(this, event)"
				onKeyUp="k_kur1=Math.round(document.formx.hjual'.$nomer.'.value * 100);
				k_kur2=100 - eval(document.formx.disk'.$nomer.'.value);
				k_kurx=Math.round(k_kur1/k_kur2);
				document.formx.muhrg'.$nomer.'.value=eval(k_kurx);"
				onKeyDown="var keyCode = event.keyCode;
				if (keyCode == 38)
					{
					document.formx.disk'.$nil.'.focus();
					}

				if (keyCode == 40)
					{
					document.formx.disk'.$nild.'.focus();
					}

				if (keyCode == 13)
					{
					document.formx.btnSMP2.focus();
					document.formx.btnSMP2.submit();
					}
				" '.$x_enter3.'>%
				</td>
				<td>
				<input name="muhrg'.$nomer.'" type="text" value="'.$d_muhrg.'" size="10" class="input" style="text-align:right" readonly>
				</td>
				</tr>';
				}
			while ($data = mysql_fetch_assoc($result));
			}


		echo '</table>
		<table width="600" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="400">
		<input name="jml" type="hidden" value="'.$count.'">
		<input name="page" type="hidden" value="'.$page.'">
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$limit.')">
		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnHPS2" type="submit" value="HAPUS">
		<input name="btnSMP2" type="submit" value="SIMPAN">
		</td>
		<td align="right">
		<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
		</td>
		</tr>
		</table>';
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
xclose($koneksi);
exit();
?>
