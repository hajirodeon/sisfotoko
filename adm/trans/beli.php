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
$supkd = nosql($_REQUEST['supkd']);
$belkd = nosql($_REQUEST['belkd']);
$y_kode = nosql($_REQUEST['y_kode']);
$y_nama = balikin($_REQUEST['y_nama']);
$y_hrg_lama = nosql($_REQUEST['y_hrg_lama']);
$s = nosql($_REQUEST['s']);
$a = nosql($_REQUEST['a']);
$yuk = nosql($_REQUEST['yuk']);
$filenya = "beli.php";


$judul = "Pembelian";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);


//focus & attribut
if (empty($supkd))
	{
	$diload = "document.formx.supplier.focus();";
	$attribut = "disabled";
	$tgldit_attr = "disabled";
	}
else if (empty($xtgl1))
	{
	$diload = "document.formx.xtgl1.focus();";
	$attribut = "disabled";
	$tgldit_attr = "disabled";
	}
else if (empty($xbln1))
	{
	$diload = "document.formx.xbln1.focus();";
	$attribut = "disabled";
	$tgldit_attr = "disabled";
	}
else if (empty($xthn1))
	{
	$diload = "document.formx.xthn1.focus();";
	$attribut = "disabled";
	$tgldit_attr = "disabled";
	}
else if (empty($belkd))
	{
	$diload = "document.formx.fak.focus();";
	$attribut = "";
	$tgldit_attr = "disabled";
	}
else if ($s == "baru")
	{
	$diload = "document.formx.nofak.focus();";
	$attribut = "disabled";
	$tgldit_attr = "disabled";
	}
else if ($yuk == "tgldit")
	{
	$diload = "document.formx.g_tgl.focus();";
	$attribut = "disabled";
	}
else if ($yuk == "detail")
	{
	$diload = "document.formx.y_kode.focus();";
	$attribut = "";
	}
else
	{
	$diload = "document.formx.nofak.focus();";
	$attribut = "";
	}



//yuk detail
if ($yuk == "detail")
	{
	if (empty($y_kode))
		{
		$diload = "document.formx.y_kode.focus();";
		}
	else
		{
		$diload = "document.formx.y_hrg.focus();";
		}
	}






//nek simpan, enter
$x_enter = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP.focus();
	document.formx.btnSMP.submit();
	}"';

//nek simpan item, enter
$x_enter2 = 'onKeyDown="return handleEnter(this, event)"';
$x_enter2x = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP2.focus();
	document.formx.btnSMP2.submit();
	}

if (keyCode == 45)
	{
	open_brg();
	return false
	}"';




//nek simpan daftar item, enter
$x_enter3 = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP3.focus();
	document.formx.btnSMP3.submit();
	}"';

//nek simpan ganti tgl.beli, enter
$x_enter4 = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnTGLSAV.focus();
	document.formx.btnTGLSAV.submit();
	}"';


//nek input pilih item & enter
//13 = "ENTER"
//45 = "INSERT"
$x_item = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 45)
	{
	open_brg();
	return false
	}"';




//nek meh baru /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnBR'])
	{
	//nilai
	$supkd = nosql($_POST['p_supkd']);
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$belkd = $x;

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?supkd=$supkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&belkd=$belkd&s=baru";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//nek ganti tgl.beli ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnTGL'])
	{
	//nilai
	$supkd = nosql($_POST['p_supkd']);
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$belkd = nosql($_POST['p_belkd']);

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?supkd=$supkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&belkd=$belkd&yuk=tgldit";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//nek batal tgl.beli ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnTGLBTL'])
	{
	//nilai
	$supkd = nosql($_POST['p_supkd']);
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$belkd = nosql($_POST['p_belkd']);

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?supkd=$supkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&belkd=$belkd";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//nek simpan tgl.beli baru ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnTGLSAV'])
	{
	//nilai
	$supkd = nosql($_POST['p_supkd']);
	$belkd = nosql($_POST['p_belkd']);

	$g_tgl = nosql($_POST['g_tgl']);
	$g_bln = nosql($_POST['g_bln']);
	$g_thn = nosql($_POST['g_thn']);
	$g_tgl_br = "$g_thn:$g_bln:$g_tgl";


	//ganti tgl. beli
	mysqli_query($koneksi, "UPDATE beli SET tgl_beli = '$g_tgl_br' ".
					"WHERE kd = '$belkd'");

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?supkd=$supkd".
			"&xtgl1=$g_tgl&xbln1=$g_bln&xthn1=$g_thn".
			"&belkd=$belkd";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//hapus pembelian //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnHPS'])
	{
	//nilai
	$belkd = nosql($_POST['p_belkd']);

	//hapus pembelian
	mysqli_query($koneksi, "DELETE FROM beli ".
					"WHERE kd = '$belkd'");

	//kurangi stock dahulu
	$qblu = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
							"WHERE kd_beli = '$belkd' ".
							"ORDER BY kd_brg ASC");
	$rblu = mysqli_fetch_assoc($qblu);

	do
		{
		//ambil nilai
		$nomer = $nomer + 1;
		$brg_kd = nosql($rblu['kd_brg']);
		$brg_qty_gudang = nosql($rblu['qty_gudang']);
		$brg_qty_toko = nosql($rblu['qty_toko']);

		//kurangi stock
		mysqli_query($koneksi, "UPDATE stock SET jml_gudang = jml_gudang - '$brg_qty_gudang', ".
						"jml_toko = jml_toko - '$brg_qty_toko' ".
						"WHERE kd_brg = '$brg_kd'");
		////////////////////////////////////////////////////////////////////////////////
		}
	while ($rblu = mysqli_fetch_assoc($qblu));


	//hapus detail
	mysqli_query($koneksi, "DELETE FROM beli_detail ".
					"WHERE kd_beli = '$belkd'");


	//null-kan
	xfree($qbw);
	xfree($qblu);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?supkd=$supkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//simpan pembelian baru ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP'])
	{
	//nilai
	$s = nosql($_POST['s']);

	//tgl beli
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";

	//jml. hari jatuh tempo
	$hr_jtempo = nosql($_POST['hr_jtempo']);

	//tgl pelunasan
	$lxtgl = nosql($_POST['lxtgl']);
	$lxbln = nosql($_POST['lxbln']);
	$lxthn = nosql($_POST['lxthn']);
	$ltgl = "$lxthn:$lxbln:$lxtgl";

	$supkd = nosql($_POST['p_supkd']);
	$belkd = nosql($_POST['p_belkd']);
	$nofak = nosql($_POST['nofak']);
	$jbyr = nosql($_POST['jbyr']);
	$diskon = nosql($_POST['diskon']);
	$ppn = nosql($_POST['ppn']);
	$total_beli = nosql($_POST['total_beli']);
	$total_diskon = round((($diskon * $total_beli)/100),2);
	$total_diskon2 = $total_beli - $total_diskon;
	$total_ppn = ($total_diskon2 * 100) / (100 - $ppn);
	$total_bayar = round($total_ppn,2);



	//nek simpan baru
	if ($s == "baru")
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM beli ".
								"WHERE kd_supplier = '$supkd' ".
								"AND no_faktur = '$nofak'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//nek ada yg sama
		if ($tcc != 0)
			{
			//null-kan
			xfree($qbw);
			xfree($qcc);
			xclose($koneksi);

			//re-direct
			$pesan = "No. Faktur : $nofak, Sudah Ada. Ganti Yang Lain.";
			$ke = "$filenya?supkd=$supkd".
					"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO beli(kd, tgl_beli, no_faktur, kd_jns_byr, kd_supplier, hr_jtempo, ".
							"tgl_lunas, diskon, total_beli, ".
							"total_diskon, ppn, total_bayar, postdate) VALUES ".
							"('$belkd', '$tgl', '$nofak', '$jbyr', '$supkd', '$hr_jtempo', ".
							"'$ltgl', '$diskon', '$total_beli', ".
							"'$total_diskon', '$ppn', '$total_bayar', '$today')");

			//null-kan
			xfree($qbw);
			xfree($qcc);
			xclose($koneksi);

			//re-direct
			$ke = "$filenya?supkd=$supkd".
						"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
						"&belkd=$belkd&s=edit&yuk=detail";
			xloc($ke);
			exit();
			}
		}

	//nek s=="" ato s=="edit"
	if ((empty($s)) OR ($s == "edit"))
		{
		//query update
		mysqli_query($koneksi, "UPDATE beli SET no_faktur = '$nofak', ".
						"kd_jns_byr = '$jbyr', ".
						"hr_jtempo = '$hr_jtempo', ".
						"tgl_lunas = '$ltgl', ".
						"diskon = '$diskon', ".
						"total_beli = '$total_beli', ".
						"total_diskon = '$total_diskon', ".
						"ppn = '$ppn', ".
						"total_bayar = '$total_bayar' ".
						"WHERE kd = '$belkd'");

		//null-kan
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$ke = "$filenya?supkd=$supkd".
					"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
					"&belkd=$belkd&yuk=detail";
		xloc($ke);
		exit();
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//nek item detail pembelian ////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP2'])
	{
	//nilai
	$s = nosql($_POST['s']);
	$a = nosql($_POST['a']);
	$yuk = nosql($_POST['yuk']);

	//tgl beli
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";

	$supkd = nosql($_POST['p_supkd']);
	$belkd = nosql($_POST['p_belkd']);

	$y_kode = nosql($_POST['y_kode']);

	//harga beli pas belanja
	//ambil dua digit dibelakang koma, jika ada
	$y_hrg = round(nosql($_POST['y_hrg']),2);

	//harga baru setelah diskon.
	//ambil dua digit dibelakang koma, jika ada
	$y_hrg_stl = round(nosql($_POST['y_hrg_stl']),2);


	$y_qty = nosql($_POST['y_qty']);
	$y_qty_gudang = nosql($_POST['y_qty_gudang']);
	$y_qty_toko = nosql($_POST['y_qty_toko']);
	$y_diskon = nosql($_POST['y_diskon']);
	$y_diskon2 = nosql($_POST['y_diskon2']);
	$y_subtotal = round(nosql($_POST['y_subtotal']),2);
	$ke = "$filenya?supkd=$supkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&belkd=$belkd&yuk=detail";

	//barangnya
	$qbrg = mysqli_query($koneksi, "SELECT * FROM m_brg ".
							"WHERE kode = '$y_kode'");
	$rbrg = mysqli_fetch_assoc($qbrg);
	$tbrg = mysqli_num_rows($qbrg);
	$brg_kd = nosql($rbrg['kd']);
	$y_nama = balikin($rbrg['nama']);




	//nek sih null
	if (empty($y_kode))
		{
		//null-kan
		xfree($qbw);
		xfree($qbrg);
		xclose($koneksi);

		//re-direct
		$pesan = "Kode Barang Belum Dimasukkan. Harap Diulangi...!!";
		pekem($pesan,$ke);
		exit();
		}

	if (empty($a))
		{
		//nek ada kode tersebut dan belum isi
		if ($tbrg != 0)
			{
			//ketahui harga beli
			$qstk = mysqli_query($koneksi, "SELECT * FROM stock ".
									"WHERE kd_brg = '$brg_kd'");
			$rstk = mysqli_fetch_assoc($qstk);
			$tstk = mysqli_num_rows($qstk);
			$y_hrg_lama = nosql($rstk['hrg_beli']);


			//re-direct kode. jika barang belum ada.
			$ke = "$filenya?supkd=$supkd".
						"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
						"&belkd=$belkd&yuk=detail&a=isi&y_kode=$y_kode".
						"&y_nama=$y_nama&y_hrg_lama=$y_hrg_lama";
			xloc($ke);
			exit();
			}
		else
			{
			//nek gak ada barang dengan kode tersebut, entry baru aja
			$ke = "beli_brg_entry.php?supkd=$supkd".
						"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
						"&belkd=$belkd&yuk=detail&a=isi&y_kode=$y_kode";
			xloc($ke);
			exit();
			}
		}




	if ($a == "isi")
		{
		//nek input tidak lengkap
		if ((empty($y_hrg_stl)) OR (empty($y_qty)))
			{
			$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
			$ke = "$filenya?supkd=$supkd".
						"&xtgl1=$x-tgl1&xbln1=$xbln1&xthn1=$xthn1".
						"&belkd=$belkd&yuk=detail&y_kode=$y_kode";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//tambahkan ke stock dan ubah harga beli
			mysqli_query($koneksi, "UPDATE stock SET jml_gudang = jml_gudang + '$y_qty_gudang', ".
							"jml_toko = jml_toko + '$y_qty_toko', ".
							"hrg_beli = '$y_hrg_stl' ".
							"WHERE kd_brg = '$brg_kd'");

			//simpan
			mysqli_query($koneksi, "INSERT INTO beli_detail(kd, kd_beli, kd_brg, hrg, qty, qty_gudang, qty_toko, ".
							"diskon, diskon2, subtotal) VALUES ".
							"('$x', '$belkd', '$brg_kd', '$y_hrg', '$y_qty', '$y_qty_gudang', '$y_qty_toko', ".
							"'$y_diskon', '$y_diskon2', '$y_subtotal')");

			//re-direct
			xloc($ke);
			exit();
			}
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//jika hapus detail item pembelian /////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnHPS2'])
	{
	//tgl beli
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";

	$supkd = nosql($_POST['p_supkd']);
	$belkd = nosql($_POST['p_belkd']);


	//data
	$qdata = mysqli_query($koneksi, "SELECT beli_detail.*, beli_detail.kd AS bdkd, m_brg.* ".
							"FROM beli_detail, m_brg ".
							"WHERE beli_detail.kd_brg = m_brg.kd ".
							"AND beli_detail.kd_beli = '$belkd' ".
							"ORDER BY m_brg.kode ASC");
	$rdata = mysqli_fetch_assoc($qdata);

	do
		{
		//ambil nilai
		$nomer = $nomer + 1;
		$yuk = "item";
		$yuhu = "$yuk$nomer";
		$kd = nosql($_POST["$yuhu"]);

		//netralkan dahulu /////////////////////////////////////////////////////////////
		$qcc = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
								"WHERE kd = '$kd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_brg_kd = nosql($rcc['kd_brg']);
		$cc_qty_gudang = nosql($rcc['qty_gudang']);
		$cc_qty_toko = nosql($rcc['qty_toko']);

		//kurangi stock
		mysqli_query($koneksi, "UPDATE stock SET jml_gudang = jml_gudang - '$cc_qty_gudang', ".
						"jml_toko = jml_toko - '$cc_qty_toko' ".
						"WHERE kd_brg = '$cc_brg_kd'");
		////////////////////////////////////////////////////////////////////////////////


		//del /////////////////////////////////////////////////////////////////////////
		mysqli_query($koneksi, "DELETE FROM beli_detail ".
						"WHERE kd = '$kd'");
		///////////////////////////////////////////////////////////////////////////////
		}
	while ($rdata = mysqli_fetch_assoc($qdata));


	//null-kan
	xfree($qbw);
	xfree($qdata);
	xclose($koneksi);


	//auto-kembali
	$ke = "$filenya?supkd=$supkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&belkd=$belkd&yuk=detail";
	xloc($ke);
	exit();
	}



//nek simpan daftar item pembelian /////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP3'])
	{
	//nilai
	//tgl beli
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";
	$supkd = nosql($_POST['p_supkd']);
	$belkd = nosql($_POST['p_belkd']);


	//detail item / barang
	$qdata = mysqli_query($koneksi, "SELECT beli_detail.*, beli_detail.kd AS bdkd, ".
							"m_brg.* ".
							"FROM beli_detail, m_brg ".
							"WHERE beli_detail.kd_brg = m_brg.kd ".
							"AND beli_detail.kd_beli = '$belkd' ".
							"ORDER BY m_brg.kode ASC");
	$rdata = mysqli_fetch_assoc($qdata);


	do
		{
		//ambil nilai
		$ongko = $ongko + 1;

		$xkd = "kd";
		$xkd1 = "$xkd$ongko";
		$xkdx = nosql($_POST["$xkd1"]);

		$xqty = "qty";
		$xqty1 = "$xqty$ongko";
		$xqtyx = nosql($_POST["$xqty1"]);

		$xhrg = "hrg";
		$xhrg1 = "$xhrg$ongko";
		$xhrgx = round(nosql($_POST["$xhrg1"]),2);

		$xchrg = "chrg";
		$xchrg1 = "$xchrg$ongko";
		$xchrgx = round(nosql($_POST["$xchrg1"]),2);

		$xdiskon = "diskon";
		$xdiskon1 = "$xdiskon$ongko";
		$xdiskonx = nosql($_POST["$xdiskon1"]);

		$xcdiskon = "cdiskon";
		$xcdiskon1 = "$xcdiskon$ongko";
		$xcdiskonx = nosql($_POST["$xcdiskon1"]);

		$xdiskony = "diskon2";
		$xdiskony1 = "$xdiskony$ongko";
		$xdiskonyx = nosql($_POST["$xdiskony1"]);

		$xcdiskony = "cdiskon2";
		$xcdiskony1 = "$xcdiskony$ongko";
		$xcdiskonyx = nosql($_POST["$xcdiskony1"]);

		$xbonusy = "bonus";
		$xbonusy1 = "$xbonusy$ongko";
		$xbonusyx = nosql($_POST["$xbonusy1"]);

		//jika ada bonus, true
		if (!empty($xbonusyx))
			{
			$zbonus = "true";
			}
		else
			{
			$zbonus = "false";
			}


		$xhrg_stly = "hrg_stl";
		$xhrg_stly1 = "$xhrg_stly$ongko";
		$xhrg_stlyx = round(nosql($_POST["$xhrg_stly1"]),2);

		$xsubtotal = "subtotal";
		$xsubtotal1 = "$xsubtotal$ongko";
		$xsubtotalx = round(nosql($_POST["$xsubtotal1"]),2);

		$xcsubtotal = "csubtotal";
		$xcsubtotal1 = "$xcsubtotal$ongko";
		$xcsubtotalx = round(nosql($_POST["$xcsubtotal1"]),2);


		//sesuaikan ////////////////////////////////////////////////////////////////////
		$qcc = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
								"WHERE kd = '$xkdx'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_brg_kd = nosql($rcc['kd_brg']);
		$cc_qty_gudang = nosql($rcc['qty_gudang']);
		$cc_qty_toko = nosql($rcc['qty_toko']);
		$cc_qty = nosql($rcc['qty']);



		//nek.... podo jml e...
		if ($cc_qty == $xqtyx)
			{
			//jika ada bonus, true / 1
			if ($zbonus == "true")
				{
				//update
				mysqli_query($koneksi, "UPDATE beli_detail SET hrg = '$xchrgx', ".
								"diskon = '$xcdiskonx', ".
								"diskon2 = '$xcdiskonyx', ".
								"subtotal = '$xcsubtotalx', ".
								"bonus = '$zbonus' ".
								"WHERE kd = '$xkdx'");


				//TIDAK UPDATE STOCK...
				}
			else //bukan bonus
				{
				//update
				mysqli_query($koneksi, "UPDATE beli_detail SET hrg = '$xhrgx', ".
								"diskon = '$xdiskonx', ".
								"diskon2 = '$xdiskonyx', ".
								"subtotal = '$xsubtotalx', ".
								"bonus = '$zbonus' ".
								"WHERE kd = '$xkdx'");

				//update stock
				mysqli_query($koneksi, "UPDATE stock SET hrg_beli = '$xhrg_stlyx' ".
							"WHERE kd_brg = '$cc_brg_kd'");
				}
			}
		else
			{
			//update
			//netralkan yg di gudang, letakkan ke toko
			if ($cc_qty_gudang > 0)
				{
				$nt_qty_gudang = "0";


				//jika ada bonus, true
				if ($zbonus == "true")
					{
					//update
					mysqli_query($koneksi, "UPDATE beli_detail SET qty = '$xqtyx', ".
									"qty_gudang = '$nt_qty_gudang', ".
									"qty_toko = '$xqtyx', ".
									"hrg = '$xchrgx', ".
									"diskon = '$xcdiskonx', ".
									"diskon2 = '$xcdiskonyx', ".
									"subtotal = '$xsubtotalx', ".
									"bonus = '$xbonus' ".
									"WHERE kd = '$xkdx'");


					//TIDAK UPDATE STOCK...
					}
				else
					{
					//update
					mysqli_query($koneksi, "UPDATE beli_detail SET qty = '$xqtyx', ".
									"qty_gudang = '$nt_qty_gudang', ".
									"qty_toko = '$xqtyx', ".
									"hrg = '$xhrgx', ".
									"diskon = '$xdiskonx', ".
									"diskon2 = '$xdiskonyx', ".
									"subtotal = '$xsubtotalx', ".
									"bonus = '$xbonus' ".
									"WHERE kd = '$xkdx'");


					//kurangi stock //netralkan
					mysqli_query($koneksi, "UPDATE stock SET jml_toko = jml_toko - '$cc_qty_toko', ".
									"jml_gudang = jml_gudang - $cc_qty_gudang ".
									"WHERE kd_brg = '$cc_brg_kd'");


					//update stock dan harga beli
					mysqli_query($koneksi, "UPDATE stock SET jml_toko = jml_toko + '$xqtyx', ".
									"hrg_beli = '$xhrg_stlyx' ".
									"WHERE kd_brg = '$cc_brg_kd'");
					}
				}
			else
				{
				//jika ada bonus
				if ($zbonus == "true")
					{
					//update
					mysqli_query($koneksi, "UPDATE beli_detail SET qty = '$xqtyx', ".
									"qty_toko = '$xqtyx', ".
									"hrg = '$xchrgx', ".
									"diskon = '$xcdiskonx', ".
									"diskon2 = '$xcdiskonyx', ".
									"subtotal = '$xcsubtotalx', ".
									"bonus = '$zbonus' ".
									"WHERE kd = '$xkdx'");


					//TIDAK UPDATE STOCK...
					}
				else
					{
					//update
					mysqli_query($koneksi, "UPDATE beli_detail SET qty = '$xqtyx', ".
									"qty_toko = '$xqtyx', ".
									"hrg = '$xhrgx', ".
									"diskon = '$xdiskonx', ".
									"diskon2 = '$xdiskonyx', ".
									"subtotal = '$xsubtotalx', ".
									"bonux = '$zbonus' ".
									"WHERE kd = '$xkdx'");

					//kurangi stock //netralkan
					mysqli_query($koneksi, "UPDATE stock SET jml_toko = jml_toko - '$cc_qty_toko' ".
									"WHERE kd_brg = '$cc_brg_kd'");


					//update stock dan harga beli
					mysqli_query($koneksi, "UPDATE stock SET jml_toko = jml_toko + '$xqtyx', ".
									"hrg_beli = '$xhrg_stlyx' ".
									"WHERE kd_brg = '$cc_brg_kd'");
					}
				}
			}
		////////////////////////////////////////////////////////////////////////////////
		}
	while ($rdata = mysqli_fetch_assoc($qdata));


	//null-kan
	xfree($qbw);
	xfree($qdata);
	xclose($koneksi);


	//auto-kembali
	$ke = "$filenya?supkd=$supkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&belkd=$belkd&yuk=detail";
	xloc($ke);
	exit();
	}



//nek print
if ($_POST['btnPRT'])
	{
	//nilai
	//tgl beli
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$supkd = nosql($_POST['p_supkd']);
	$belkd = nosql($_POST['p_belkd']);

	//null-kan
	xfree($qbw);
	xclose($koneksi);


	//ke print
	$ke = "beli_rpt.php?supkd=$supkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&belkd=$belkd";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//isi *START
ob_start();


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
	\'width=700px,height=325px,center=1,resize=0,scrolling=0\')

	brg_window.onclose=function()
		{
		var kodex=this.contentDoc.getElementById("kodex");

		document.formx.y_kode.value=kodex.value;
		document.formx.y_kode.focus();
		return true
		}
	}


function entry_brg()
	{
	entry_window=dhtmlmodal.open(\'Entry Barang\',
	\'iframe\',
	\'beli_brg_entry.php\',
	\'Entry Barang\',
	\'width=700px,height=325px,center=1,resize=0,scrolling=0\')

	entry_window.onclose=function()
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
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");
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
<strong>Supplier : </strong>';
echo "<select name=\"supplier\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qsupx = mysqli_query($koneksi, "SELECT * FROM m_supplier ".
						"WHERE kd = '$supkd'");
$rsupx = mysqli_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['singkatan']);


echo '<option value="'.$supx_kd.'" selected>'.$supx_nm.'</option>';

//query
$qsup = mysqli_query($koneksi, "SELECT * FROM m_supplier ".
						"WHERE kd <> '$supkd' ".
						"ORDER BY singkatan ASC");
$rsup = mysqli_fetch_assoc($qsup);

do
	{
	$sup_kd = nosql($rsup['kd']);
	$sup_sing = balikin($rsup['singkatan']);

	echo '<option value="'.$filenya.'?supkd='.$sup_kd.'">'.$sup_sing.'</option>';
	}
while ($rsup = mysqli_fetch_assoc($qsup));

echo '</select>,

<strong>Tanggal Beli : </strong>';
echo "<select name=\"xtgl1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xtgl1.'" selected>'.$xtgl1.'</option>';

for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$filenya.'?supkd='.$supkd.'&xtgl1='.$i.'">'.$i.'</option>';
	}

echo '</select>';

echo "<select name=\"xbln1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xbln1.'" selected>'.$arrbln[$xbln1].'</option>';

for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$filenya.'?supkd='.$supkd.'&xtgl1='.$xtgl1.'&xbln1='.$j.'">'.$arrbln[$j].'</option>';
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
	echo '<option value="'.$filenya.'?supkd='.$supkd.'&xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$x_thn.'">'.$x_thn.'</option>';
	}
while ($rthn = mysqli_fetch_assoc($qthn));

echo '</select>,
<strong>No. Faktur : </strong>';
echo "<select name=\"fak\" onChange=\"MM_jumpMenu('self',this,0)\">";

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

echo '<option value="'.$x_belkd.'" selected>'.$x_nofak.' => ['.$x_beli_items.' Item].</option>';

//data
$qtrux = mysqli_query($koneksi, "SELECT * FROM beli ".
						"WHERE round(DATE_FORMAT(tgl_beli, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(tgl_beli, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(tgl_beli, '%Y')) = '$xthn1' ".
						"AND kd <> '$belkd' ".
						"AND kd_supplier = '$supkd' ".
						"ORDER BY round(no_faktur) ASC");
$rtrux = mysqli_fetch_assoc($qtrux);

do
	{
	$i_belkd = nosql($rtrux['kd']);
	$i_nofak = balikin($rtrux['no_faktur']);


	//jumlahnya
	$qyukx = mysqli_query($koneksi, "SELECT * FROM beli_detail ".
							"WHERE kd_beli = '$i_belkd'");
	$ryukx = mysqli_fetch_assoc($qyukx);
	$tyukx = mysqli_num_rows($qyukx);
	$i_beli_items = $tyukx;

	echo '<option value="'.$filenya.'?supkd='.$supkd.''.
	'&xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$xthn1.''.
	'&belkd='.$i_belkd.'">
	'.$i_nofak.' => ['.$i_beli_items.' Item]. </option>';
	}
while ($rtrux = mysqli_fetch_assoc($qtrux));

echo '</select>
<input name="btnTGL" type="submit" value="[Ganti Tgl.]" '.$tgldit_attr.'>
<input name="btnBR" type="submit" value="BARU" '.$attribut.'>
</td>
</tr>
</table>';


//nek ganti tanggal pembelian
if ($yuk=="tgldit")
	{
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr bgcolor="red">
	<td>
	Tgl. Pembelian Baru :
	<select name="g_tgl" '.$x_enter2.'>
	<option value="" selected></option>';
	for ($i=1;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}

	echo '</select>
	<select name="g_bln" '.$x_enter2.'>
	<option value="" selected></option>';
	for ($j=1;$j<=12;$j++)
		{
		echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
		}

	echo '</select>
	<select name="g_thn" '.$x_enter4.'>
	<option value="" selected></option>';

	//query
	$qthn3 = mysqli_query($koneksi, "SELECT * FROM m_tahun ".
							"ORDER BY tahun DESC");
	$rthn3 = mysqli_fetch_assoc($qthn3);

	do
		{
		$x_thn3 = nosql($rthn3['tahun']);
		echo '<option value="'.$x_thn3.'">'.$x_thn3.'</option>';
		}
	while ($rthn3 = mysqli_fetch_assoc($qthn3));

	echo '</select>
	<input name="btnTGLBTL" type="submit" value="BATAL">
	<input name="btnTGLSAV" type="submit" value="SIMPAN">
	</td>
	</tr>
	</table>';
	}



//nek masih do null
if (empty($supkd))
	{
	echo "<strong>Supplier Belum Dipilih...!!</strong>";
	}
else if (empty($xtgl1))
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
else if (empty($belkd))
	{
	echo "<strong>No. Faktur Belum Dipilih...!!</strong>";
	}
else
	{
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
	<strong>No. Faktur : </strong>
	<input name="nofak" type="text" value="'.$e_nofak.'" size="20" '.$x_enter.'>
	<br>
	<br>
	<strong>Jenis Pembayaran : </strong>
	<select name="jbyr">
	<option value="'.$e_jns_byr_kd.'" selected>'.$e_jns_byr_nm.'</option>';

	//query
	$qjei = mysqli_query($koneksi, "SELECT * FROM m_jns_byr ".
							"WHERE kd <> '$e_jns_byr_kd' ".
							"ORDER BY jns_byr ASC");
	$rjei = mysqli_fetch_assoc($qjei);

	do
		{
		$jei_kd = nosql($rjei['kd']);
		$jei_nm = balikin($rjei['jns_byr']);

		echo '<option value="'.$jei_kd.'">'.$jei_nm.'</option>';
		}
	while ($rjei = mysqli_fetch_assoc($qjei));

	echo '</select>
	<br>
	<br>
	<strong>Jatuh Tempo : </strong>
	<input name="hr_jtempo" type="text" value="'.$e_hr_jtempo.'" size="3" onKeyPress="return numbersonly(this, event)"  '.$x_enter.'>
	Hari
	</td>
    <td>
	<strong>Tgl. Pelunasan :</strong>
	<select name="lxtgl">
	<option value="'.$e_ltgl.'" selected>'.$e_ltgl.'</option>';
	for ($i=1;$i<=31;$i++)
		{
		echo '<option value="'.$i.'">'.$i.'</option>';
		}

	echo '</select>
	<select name="lxbln">
	<option value="'.$e_lbln.'" selected>'.$arrbln1[$e_lbln].'</option>';
	for ($j=1;$j<=12;$j++)
		{
		echo '<option value="'.$j.'">'.$arrbln[$j].'</option>';
		}

	echo '</select>
	<select name="lxthn">
	<option value="'.$e_lthn.'" selected>'.$e_lthn.'</option>';

	//query
	$qthn3 = mysqli_query($koneksi, "SELECT * FROM m_tahun ".
							"ORDER BY tahun DESC");
	$rthn3 = mysqli_fetch_assoc($qthn3);

	do
		{
		$x_thn3 = nosql($rthn3['tahun']);
		echo '<option value="'.$x_thn3.'">'.$x_thn3.'</option>';
		}
	while ($rthn3 = mysqli_fetch_assoc($qthn3));

	echo '</select>
	<br>
	<br>
	<strong>Total : </strong>Rp.
	<input name="total_beli" type="text" value="'.$e_total_beli.'" size="15" class="input" style="text-align:right" readonly>
	<br>
	<br>

	<strong>Diskon :</strong>
	<input name="diskon" type="text" value="'.$e_diskon.'" size="5" maxlength="5" style="text-align:right"
	onKeyUp="dknx = (document.formx.diskon.value * document.formx.total_beli.value) / 100;
	dknx2 = eval(document.formx.total_beli.value - dknx);
	dkny1 = dknx2 * 100;
	dkny2 = eval(100 - document.formx.ppn.value);
	dkny3 = dkny1 / dkny2;
	document.formx.total_bayar.value = dkny3;"
	'.$x_enter.'>%
	</td>


	<td>
	<strong>PPN :</strong>
	<input name="ppn" type="text" value="'.$e_ppn.'" size="2" maxlength="2" onKeyPress="return numbersonly(this, event)" style="text-align:right"
	onKeyUp="dknx = (document.formx.diskon.value * document.formx.total_beli.value) / 100;
	dknx2 = eval(document.formx.total_beli.value - dknx);
	dkny1 = dknx2 * 100;
	dkny2 = eval(100 - document.formx.ppn.value);
	dkny3 = dkny1 / dkny2;
	document.formx.total_bayar.value = dkny3;"
	'.$x_enter.'>%
	<br>
	<br>
	<strong>Total Bayar :</strong> Rp.
	<input name="total_bayar" type="text" value="'.$e_total_bayar.'" size="15" class="input" style="text-align:right" readonly>
	</td>
	</tr>
	</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
    <td>
	<input name="btnHPS" type="submit" value="HAPUS">
	<input name="btnSMP" type="submit" value="SIMPAN & DETAIL >>>">
	</td>
    <td align="right">
	<input name="btnPRT" type="submit" value="PRINT">
	</td>
	</tr>
	</table>
	<br>
	<br>
	<br>';


	//nek detail
	if ($yuk == "detail")
		{
		//nek null
		if (empty($y_nama))
			{
			$y_nama = "-";
			}

		if (empty($y_hrg_lama))
			{
			$y_hrg_lama = "-";
			}



		//input item
		echo '<strong>Kode Barang : </strong>
		<input name="y_kode" type="text" value="'.$y_kode.'" size="15" '.$x_enter2x.'>,

		<strong>Nama Barang : </strong>
		<input name="y_nama" type="text" value="'.$y_nama.'" size="20" class="input" readonly> ,

		<strong>Harga Barang (Lama) : </strong>Rp.
		<input name="y_hrg_lama" type="text" value="'.$y_hrg_lama.'" size="10" class="input" style="text-align:right" readonly> ,

		<br>

		<strong>Harga : </strong>Rp.
		<input name="y_hrg" type="text" value="'.$y_hrg_lama.'" size="10" style="text-align:right"
		onKeyUp="document.formx.y_subtotal.value=eval(document.formx.y_qty.value * document.formx.y_hrg.value);
		document.formx.y_hrg_stl.value = eval(document.formx.y_subtotal.value/document.formx.y_qty.value);"
		'.$x_enter2.'> ,

		<strong>Qty. Total :</strong>
		<input name="y_qty" type="text" value="" size="5" style="text-align:right"
		onKeyUp="document.formx.y_subtotal.value=eval(document.formx.y_qty.value * document.formx.y_hrg.value);
		document.formx.y_hrg_stl.value = eval(document.formx.y_subtotal.value/document.formx.y_qty.value);"
		onKeyPress="return numbersonly(this, event)"
		'.$x_enter2.'>,

		<strong>Qty. Gudang :</strong>
		<input name="y_qty_gudang" type="text" value="" size="5" style="text-align:right"
		onKeyUp="document.formx.y_qty_toko.value=Math.round(document.formx.y_qty.value - document.formx.y_qty_gudang.value);
		if (document.formx.y_qty_toko.value < 0)
			{
			document.formx.y_qty_toko.value = 0;
			}"
		onKeyPress="return numbersonly(this, event)"
		'.$x_enter2.'>,

		<strong>Qty. Toko :</strong>
		<input name="y_qty_toko" type="text" value="" size="5" style="text-align:right"
		onKeyUp="document.formx.y_qty_gudang.value=Math.round(document.formx.y_qty.value - document.formx.y_qty_toko.value);
		if (document.formx.y_qty_gudang.value < 0)
			{
			document.formx.y_qty_gudang.value = 0;
			}"
		onKeyPress="return numbersonly(this, event)"
		'.$x_enter2.'>,
		<br>

		<strong>Diskon #1 :</strong>
		<input name="y_diskon" type="text" value="" size="5" style="text-align:right" maxlength="5"
		onKeyUp="dknx = (document.formx.y_diskon.value * (document.formx.y_qty.value * document.formx.y_hrg.value)) / 100;
		tot_dknx = (document.formx.y_qty.value * document.formx.y_hrg.value) - dknx;
		document.formx.y_subtotal.value = eval(tot_dknx);
		document.formx.y_hrg_stl.value = eval(document.formx.y_subtotal.value/document.formx.y_qty.value);" '.$x_enter2.'>%,

		<strong>Diskon #2 :</strong>
		<input name="y_diskon2" type="text" value="" size="5" style="text-align:right" maxlength="5"
		onKeyUp="dknx1 = (document.formx.y_diskon.value * (document.formx.y_qty.value * document.formx.y_hrg.value)) / 100;
		tot_dknx1 = (document.formx.y_qty.value * document.formx.y_hrg.value) - dknx1;
		dknx2 = (document.formx.y_diskon2.value * tot_dknx1) / 100;
		tot_dknx2 = tot_dknx1 - dknx2;
		document.formx.y_subtotal.value = eval(tot_dknx2);
		document.formx.y_hrg_stl.value = eval(document.formx.y_subtotal.value/document.formx.y_qty.value);"
		onKeyDown="var keyCode = event.keyCode;
		if (keyCode == 13)
			{
			document.formx.btnSMP2.focus();
			document.formx.btnSMP2.submit();
			}">%,


		<strong>SubTotal : </strong>Rp.
		<input name="y_subtotal" type="text" value="" size="15" class="input" style="text-align:right" readonly>
		<br>

		<strong>Harga Beli Setelah Diskon : </strong>Rp.
		<input name="y_hrg_stl" type="text" value="" size="15" class="input" style="text-align:right" readonly>
		<br>

		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnSMP2" type="submit" value="BARU">
		[INSERT : Pilih Kode Barang].
		<br>
		<br>';


		//detail item / barang
		$qdata = mysqli_query($koneksi, "SELECT beli_detail.*, beli_detail.kd AS bdkd, ".
								"m_brg.* ".
								"FROM beli_detail, m_brg ".
								"WHERE beli_detail.kd_brg = m_brg.kd ".
								"AND beli_detail.kd_beli = '$belkd' ".
								"ORDER BY beli_detail.bonus DESC, m_brg.kode ASC");
		$rdata = mysqli_fetch_assoc($qdata);
		$rcount = mysqli_num_rows($qdata);

		echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1%">&nbsp;</td>
    	<td width="10%"><strong>Kode</strong></td>
    	<td><strong>Nama Barang</strong></td>
    	<td width="10%"><strong>Merk</strong></td>
		<td width="10%"><strong>Qty</strong></td>
		<td width="10%"><strong>Harga</strong></td>
		<td width="10%"><strong>Diskon #1</strong></td>
		<td width="10%"><strong>Diskon #2</strong></td>
		<td width="5%"><strong>SubTotal</strong></td>
		<td width="5%"><strong>Bonus</strong></td>
		</tr>';

		//nek gak nul
		if ($rcount != "0")
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
				$d_brgkd = nosql($rdata['kd_brg']);
				$d_satuan_kd = nosql($rdata['kd_satuan']);
				$d_merk_kd = nosql($rdata['kd_merk']);
				$d_nama = balikin($rdata['nama']);
				$d_qty = nosql($rdata['qty']);
				$d_qty_gudang = nosql($rdata['qty_gudang']);
				$d_qty_toko = nosql($rdata['qty_toko']);
				$d_hrg = nosql($rdata['hrg']);
				$d_diskon = nosql($rdata['diskon']);
				$d_diskon2 = nosql($rdata['diskon2']);
				$d_subtotal = nosql($rdata['subtotal']);

				$d_chrg = nosql($rdata['hrg']);
				$d_cdiskon = nosql($rdata['diskon']);
				$d_cdiskon2 = nosql($rdata['diskon2']);
				$d_csubtotal = nosql($rdata['subtotal']);

				$d_bonus = nosql($rdata['bonus']);
				$d_hrg_stl = round(($d_subtotal/$d_qty),2);


				//satuan
				$q_stu = mysqli_query($koneksi, "SELECT * FROM m_satuan ".
										"WHERE kd = '$d_satuan_kd'");
				$r_stu = mysqli_fetch_assoc($q_stu);

				//merk
				$q_me = mysqli_query($koneksi, "SELECT * FROM m_merk ".
										"WHERE kd = '$d_merk_kd'");
				$r_me = mysqli_fetch_assoc($q_me);

				//sub nilai
				$d_satuan = balikin($r_stu['satuan']);
				$d_merk = balikin($r_me['merk']);

				//bonus --> checked
				if ($d_bonus == "true")
					{
					$ck_bonus = "checked";
					$ck_status = "disabled";
					$d_hrg = "0";
					$d_diskon = "0";
					$d_diskon2 = "0";
					$d_subtotal = "0";
					}
				else
					{
					$ck_bonus = "";
					$ck_status = "";
					}




				//pageup
				$nil = $nomer - 1;

				if ($nil < 1)
					{
					$nil = 1;
					}

				if ($nil > $rcount)
					{
					$nil = $rcount;
					}

				//pagedown
				$nild = $nomer + 1;

				if ($nild < 1)
					{
					$nild = $nild + 1;
					}

				if ($nild > $rcount)
					{
					$nild = $rcount;
					}

				echo "<tr bgcolor=\"$warna\" onkeyup=\"this.bgColor='$warnaover';\" onkeydown=\"this.bgColor='$warna';\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$d_kd.'">
				<input type="checkbox" name="item'.$nomer.'" value="'.$d_kd.'">
				</td>
		    		<td>'.$d_kode.'</td>
		    		<td>'.$d_nama.'</td>
				<td>'.$d_merk.'</td>

			    <td>
				<input name="qty_toko'.$nomer.'" type="hidden" value="'.$d_qty_toko.'">
				<input name="qty_gudang'.$nomer.'" type="hidden" value="'.$d_qty_gudang.'">
				<input name="qty'.$nomer.'" type="text" value="'.$d_qty.'" size="5" style="text-align:right"
				onKeyPress="return numbersonly(this, event)"
				onKeyUp="dknx1 = (document.formx.diskon'.$nomer.'.value * (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value)) / 100;
				tot_dknx1 = (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value) - dknx1;
				dknx2 = (document.formx.diskon2'.$nomer.'.value * tot_dknx1) / 100;
				tot_dknx2 = tot_dknx1 - dknx2;
				document.formx.subtotal'.$nomer.'.value = eval(tot_dknx2);
				document.formx.hrg_stl'.$nomer.'.value = eval(document.formx.subtotal'.$nomer.'.value/document.formx.qty'.$nomer.'.value);"
				onKeyDown="var keyCode = event.keyCode;
				if (keyCode == 38)
					{
					document.formx.qty'.$nil.'.focus();
					}

				if (keyCode == 40)
					{
					document.formx.qty'.$nild.'.focus();
					}

				if (keyCode == 39)
					{
					document.formx.hrg'.$nomer.'.focus();
					}

				if (keyCode == 13)
					{
					document.formx.btnSMP3.focus();
					document.formx.btnSMP3.submit();
					}
				" '.$x_enter3.'>'.$d_satuan.'
				</td>
				<td>
				<input name="chrg'.$nomer.'" type="hidden" value="'.$d_chrg.'">
				<input name="hrg'.$nomer.'" type="text" value="'.$d_hrg.'" size="10" style="text-align:right"
				onKeyUp="dknx1 = (document.formx.diskon'.$nomer.'.value * (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value)) / 100;
				tot_dknx1 = (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value) - dknx1;
				dknx2 = (document.formx.diskon2'.$nomer.'.value * tot_dknx1) / 100;
				tot_dknx2 = tot_dknx1 - dknx2;
				document.formx.subtotal'.$nomer.'.value = eval(tot_dknx2);
				document.formx.hrg_stl'.$nomer.'.value = eval(document.formx.subtotal'.$nomer.'.value/document.formx.qty'.$nomer.'.value);"
				onKeyDown="var keyCode = event.keyCode;
				if (keyCode == 38)
					{
					document.formx.hrg'.$nil.'.focus();
					}

				if (keyCode == 40)
					{
					document.formx.hrg'.$nild.'.focus();
					}

				if (keyCode == 37)
					{
					document.formx.qty'.$nomer.'.focus();
					}

				if (keyCode == 39)
					{
					document.formx.diskon'.$nomer.'.focus();
					}

				if (keyCode == 13)
					{
					document.formx.btnSMP3.focus();
					document.formx.btnSMP3.submit();
					}
				" '.$x_enter3.' '.$ck_status.'>
				</td>
				<td>
				<input name="cdiskon'.$nomer.'" type="hidden" value="'.$d_cdiskon.'">
				<input name="diskon'.$nomer.'" type="text" value="'.$d_diskon.'" size="5" maxlength="5" style="text-align:right"
				onKeyUp="dknx = (document.formx.diskon'.$nomer.'.value * (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value)) / 100;
				tot_dknx = (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value) - dknx;
				document.formx.subtotal'.$nomer.'.value = eval(tot_dknx);
				document.formx.hrg_stl'.$nomer.'.value = eval(document.formx.subtotal'.$nomer.'.value/document.formx.qty'.$nomer.'.value);"
				onKeyDown="var keyCode = event.keyCode;
				if (keyCode == 38)
					{
					document.formx.diskon'.$nil.'.focus();
					}

				if (keyCode == 40)
					{
					document.formx.diskon'.$nild.'.focus();
					}

				if (keyCode == 37)
					{
					document.formx.hrg'.$nomer.'.focus();
					}

				if (keyCode == 39)
					{
					document.formx.diskon2'.$nomer.'.focus();
					}

				if (keyCode == 13)
					{
					document.formx.btnSMP3.focus();
					document.formx.btnSMP3.submit();
					}
				" '.$x_enter3.' '.$ck_status.'>%
				</td>

				<td>
				<input name="cdiskon2'.$nomer.'" type="hidden" value="'.$d_cdiskon2.'">
				<input name="diskon2'.$nomer.'" type="text" value="'.$d_diskon2.'" size="5" maxlength="5" style="text-align:right"
				onKeyUp="dknx1 = (document.formx.diskon'.$nomer.'.value * (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value)) / 100;
				tot_dknx1 = (document.formx.qty'.$nomer.'.value * document.formx.hrg'.$nomer.'.value) - dknx1;
				dknx2 = (document.formx.diskon2'.$nomer.'.value * tot_dknx1) / 100;
				tot_dknx2 = tot_dknx1 - dknx2;
				document.formx.subtotal'.$nomer.'.value = eval(tot_dknx2);
				document.formx.hrg_stl'.$nomer.'.value = eval(document.formx.subtotal'.$nomer.'.value/document.formx.qty'.$nomer.'.value);"
				onKeyDown="var keyCode = event.keyCode;
				if (keyCode == 38)
					{
					document.formx.diskon2'.$nil.'.focus();
					}

				if (keyCode == 40)
					{
					document.formx.diskon2'.$nild.'.focus();
					}

				if (keyCode == 37)
					{
					document.formx.diskon'.$nomer.'.focus();
					}

				if (keyCode == 13)
					{
					document.formx.btnSMP3.focus();
					document.formx.btnSMP3.submit();
					}
				" '.$x_enter3.' '.$ck_status.'>%
				</td>
				<td>
				<input name="hrg_stl'.$nomer.'" type="hidden" value="'.$d_hrg_stl.'">
				<input name="csubtotal'.$nomer.'" type="hidden" value="'.$d_csubtotal.'">
				<input name="subtotal'.$nomer.'" type="text" value="'.$d_subtotal.'" size="10"
				class="input" style="text-align:right" readonly '.$ck_status.'>
				</td>
				<td align="center">
				<input type="checkbox" name="bonus'.$nomer.'" value="'.$d_kd.'" onClick="
				if (document.formx.bonus'.$nomer.'.checked==true)
					{
					document.formx.hrg'.$nomer.'.value=0;
					document.formx.diskon'.$nomer.'.value=0;
					document.formx.diskon2'.$nomer.'.value=0;
					document.formx.subtotal'.$nomer.'.value=0;
					document.formx.hrg'.$nomer.'.disabled=true;
					document.formx.diskon'.$nomer.'.disabled=true;
					document.formx.diskon2'.$nomer.'.disabled=true;
					document.formx.subtotal'.$nomer.'.disabled=true;
					}
				else
					{
					document.formx.hrg'.$nomer.'.value=document.formx.chrg'.$nomer.'.value;
					document.formx.diskon'.$nomer.'.value=document.formx.cdiskon'.$nomer.'.value;
					document.formx.diskon2'.$nomer.'.value=document.formx.cdiskon2'.$nomer.'.value;
					document.formx.subtotal'.$nomer.'.value=document.formx.csubtotal'.$nomer.'.value;
					document.formx.hrg'.$nomer.'.disabled=false;
					document.formx.diskon'.$nomer.'.disabled=false;
					document.formx.diskon2'.$nomer.'.disabled=false;
					document.formx.subtotal'.$nomer.'.disabled=false;
					}
				" '.$ck_bonus.'>
				</td>
				</tr>';
				}
			while ($rdata = mysqli_fetch_assoc($qdata));
			}

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$rcount.')">
		<input name="btnRST" type="reset" value="BATAL">
		<input name="btnHPS2" type="submit" value="HAPUS">
		<input name="btnSMP3" type="submit" value="SIMPAN">
		</td>
		</tr>
		</table>';
		}
	}






echo '<input name="p_xtgl1" type="hidden" value="'.$xtgl1.'">
<input name="p_xbln1" type="hidden" value="'.$xbln1.'">
<input name="p_xthn1" type="hidden" value="'.$xthn1.'">
<input name="p_belkd" type="hidden" value="'.$belkd.'">
<input name="p_supkd" type="hidden" value="'.$supkd.'">
<input name="p_nofak" type="hidden" value="'.$nofak.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="a" type="hidden" value="'.$a.'">
<input name="yuk" type="hidden" value="'.$yuk.'">
<br>
<br>
<br>
</form>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>