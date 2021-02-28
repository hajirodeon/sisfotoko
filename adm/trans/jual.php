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
$kastkd = nosql($_REQUEST['kastkd']);
$jukd = nosql($_REQUEST['jukd']);
$s = nosql($_REQUEST['s']);
$xnofak = nosql($_REQUEST['xnofak']);
$yuk = nosql($_REQUEST['yuk']);
$y_kode = nosql($_REQUEST['y_kode']);
$y_hjual = nosql($_REQUEST['y_hjual']);
$y_hjual_br = nosql($_REQUEST['y_hjual_br']);
$y_diskon = nosql($_REQUEST['y_diskon']);
$filenya = "jual.php";



$judul = "Penjualan";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$xtgl1 = nosql($_REQUEST['xtgl1']);
$xbln1 = nosql($_REQUEST['xbln1']);
$xthn1 = nosql($_REQUEST['xthn1']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//focus & attribut
if (empty($kastkd))
	{
	$diload = "document.formx.kastumer.focus();";
	$attribut = "disabled";
	}
else if (empty($xtgl1))
	{
	$diload = "document.formx.xtgl1.focus();";
	$attribut = "disabled";
	}
else if (empty($xbln1))
	{
	$diload = "document.formx.xbln1.focus();";
	$attribut = "disabled";
	}
else if (empty($xthn1))
	{
	$diload = "document.formx.xthn1.focus();";
	$attribut = "disabled";
	}
else if (empty($jukd))
	{
	$diload = "document.formx.fak.focus();";
	$attribut = "";
	}
else if ($s == "baru")
	{
	$diload = "document.formx.btnSMP.focus();";
	$attribut = "disabled";
	}
else if ($yuk == "detail")
	{
	$diload = "document.formx.y_kode.focus();";
	$attribut = "";
	}
else
	{
	$diload = "document.formx.btnSMP.focus();";
	$attribut = "disabled";
	}


//focus
if (!empty($y_kode))
	{
	$diload = "document.formx.y_qty.focus();";
	}




//nek simpan, enter
$x_enter = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP.focus();
	document.formx.btnSMP.submit();
	}"';

//nek simpan item, enter
$x_enter2 = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP2.focus();
	document.formx.btnSMP2.submit();
	}"';

//nek simpan daftar item, enter
$x_enter3 = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnSMP3.focus();
	document.formx.btnSMP3.submit();
	}"';

$x_enter4 = 'onKeyDown="return handleEnter(this, event)"';


//nek input pilih item & enter
//13 = "ENTER"
//45 = "INSERT"
$x_item = 'onKeyDown="var keyCode = event.keyCode;
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








//nek meh baru /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnBR'])
	{
	//nilai
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$jukd = $x;

	//today
	$waru2 = $today3;

	$xnofak = $waru2;

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?kastkd=$kastkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&jukd=$jukd&xnofak=$xnofak&s=baru";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//hapus penjualan //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnHPS'])
	{
	//nilai
	$jukd = nosql($_POST['p_jukd']);

	//jual
	mysqli_query($koneksi, "DELETE FROM jual ".
					"WHERE kd = '$jukd'");


	//
	$qdt = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
							"WHERE kd_jual = '$jukd' ".
							"ORDER BY kd ASC");
	$rdt = mysqli_fetch_assoc($qdt);
	$tdt = mysqli_num_rows($qdt);

	//looping hapus detail
	do
		{
		//ambil nilai
		$kd = nosql($rdt['kd']);

		//netralkan dahulu /////////////////////////////////////////////////////////////
		$qcc = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
								"WHERE kd = '$kd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_brg_kd = nosql($rcc['kd_brg']);
		$cc_qty_gudang = nosql($rcc['qty_gudang']);
		$cc_qty_toko = nosql($rcc['qty_toko']);

		//tambahkan stock
		mysqli_query($koneksi, "UPDATE stock SET jml_gudang = jml_gudang + '$cc_qty_gudang', ".
						"jml_toko = jml_toko + '$cc_qty_toko' ".
						"WHERE kd_brg = '$cc_brg_kd'");
		////////////////////////////////////////////////////////////////////////////////


		//del /////////////////////////////////////////////////////////////////////////
		mysqli_query($koneksi, "DELETE FROM jual_detail ".
						"WHERE kd = '$kd'");
		///////////////////////////////////////////////////////////////////////////////
		}
	while ($rdt = mysqli_fetch_assoc($qdt));



	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	$ke = "$filenya?kastkd=$kastkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1";
	xloc($ke);
	exit();
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//simpan penjualan baru ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP'])
	{
	//nilai
	$s = nosql($_POST['s']);

	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl1 = "$xthn1:$xbln1:$xtgl1";

	//tgl bayar
	$lxtgl = nosql($_POST['lxtgl']);
	$lxbln = nosql($_POST['lxbln']);
	$lxthn = nosql($_POST['lxthn']);
	$ltgl = "$lxthn:$lxbln:$lxtgl";

	$kastkd = nosql($_POST['p_kastkd']);
	$jukd = nosql($_POST['p_jukd']);
	$nofak = nosql($_POST['nofak']);
	$jbyr = nosql($_POST['jbyr']);
	$total_jual = nosql($_POST['total_jual']);



	//nek simpan baru
	if ($s == "baru")
		{
		//cek
		$qcc = mysqli_query($koneksi, "SELECT * FROM jual ".
								"WHERE no_faktur = '$nofak'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);

		//nek ada
		if ($tcc != 0)
			{
			//random ulang
			//random, ambil 3 aja
			$waru = substr($nirand,0,3);

			//today
			$waru2 = "$today3$waru";

			$nofakx = $waru2;

			//masuk
			mysqli_query($koneksi, "INSERT INTO jual(kd, kd_kastumer, no_faktur, tgl_jual, total_jual, ".
							"kd_jns_byr, tgl_bayar, postdate) VALUES ".
							"('$jukd', '$kastkd', '$nofakx', '$tgl1', '$total_jual', ".
							"'$jbyr', '$ltgl', '$today')");
			}
		else
			{
			mysqli_query($koneksi, "INSERT INTO jual(kd, kd_kastumer, no_faktur, tgl_jual, total_jual, ".
							"kd_jns_byr, tgl_bayar, postdate) VALUES ".
							"('$jukd', '$kastkd', '$nofak', '$tgl1', '$total_bayar', ".
							"'$jbyr', '$ltgl', '$today')");
			}



		//null-kan
		xfree($qbw);
		xfree($qcc);
		xclose($koneksi);

		//re-direct
		$ke = "$filenya?kastkd=$kastkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&jukd=$jukd&s=edit&yuk=detail";
		xloc($ke);
		exit();
		}

	//nek s=="" ato s=="edit"
	if ((empty($s)) OR ($s == "edit"))
		{
		mysqli_query($koneksi, "UPDATE jual SET total_jual = '$total_jual', ".
						"kd_jns_byr = '$jbyr', ".
						"tgl_bayar = '$ltgl', ".
						"postdate = '$today' ".
						"WHERE kd = '$jukd'");

		//null-kan
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$ke = "$filenya?kastkd=$kastkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&jukd=$jukd&yuk=detail";
		xloc($ke);
		exit();
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//nek item detail penjualan ////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP2'])
	{
	//nilai
	$s = nosql($_POST['s']);
	$yuk = nosql($_POST['yuk']);

	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";

	$kastkd = nosql($_POST['p_kastkd']);
	$jukd = nosql($_POST['p_jukd']);

	$y_kode = nosql($_POST['y_kode']);
	$y_qty = nosql($_POST['y_qty']);

	//nek input tidak lengkap
	if (empty($y_kode))
		{
		//null-kan
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Kode Barang Masih Kosong. Harap Diulangi...!!";
		$ke = "$filenya?kastkd=$kastkd".
				"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
				"&jukd=$jukd&yuk=detail";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//barangnya telah di-set...?
		$qbrg = mysqli_query($koneksi, "SELECT kastumer_brg.*, kastumer_brg_detail.*, ".
								"m_brg.*, m_brg.kd AS mbkd ".
								"FROM kastumer_brg, kastumer_brg_detail, m_brg ".
								"WHERE kastumer_brg_detail.kd_kastumer_brg = kastumer_brg.kd ".
								"AND kastumer_brg_detail.kd_brg = m_brg.kd ".
								"AND kastumer_brg.kd_kastumer = '$kastkd' ".
								"AND m_brg.kode = '$y_kode' ".
								"ORDER BY kastumer_brg.tgl_penawaran DESC");
		$rbrg = mysqli_fetch_assoc($qbrg);
		$tbrg = mysqli_num_rows($qbrg);

		$brg_kd = nosql($rbrg['mbkd']);
		$brg_hrg_jual = nosql($rbrg['hrg_jual_br']);
		$brg_hrg_jual_br = $brg_hrg_jual;
		$brg_diskon = nosql($rbrg['diskon']);
		$subtotal = round($y_qty * $brg_hrg_jual_br);

		//nek ada
		if ($tbrg != 0)
			{
			//cek, sudah ada atau belum
			$qcc = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
									"WHERE kd_jual = '$jukd' ".
									"AND kd_brg = '$brg_kd'");
			$rcc = mysqli_fetch_assoc($qcc);
			$tcc = mysqli_num_rows($qcc);

			//jika iya
			if ($tcc != 0)
				{
				//null-kan
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Barang dengan Kode : $y_kode, Sudah Ada. Silahkan Ganti Yang Lain...!";
				$ke = "$filenya?kastkd=$kastkd".
						"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
						"&jukd=$jukd&yuk=detail";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				//cek lagi, kodenya
				if ((!empty($y_kode)) AND (empty($y_qty)))
					{
					//null-kan
					xfree($qbw);
					xclose($koneksi);

					//re-direct
					$ke = "$filenya?kastkd=$kastkd".
							"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
							"&jukd=$jukd&yuk=detail&y_kode=$y_kode&y_hjual=$brg_hrg_jual_br&y_diskon=$brg_diskon";
					xloc($ke);
					exit();
					}
				else
					{
					//deteksi, jmlx > dari stock
					$qcc1 = mysqli_query($koneksi, "SELECT * FROM stock ".
											"WHERE kd_brg = '$brg_kd'");
					$rcc1 = mysqli_fetch_assoc($qcc1);
					$jml_cc1 = nosql($rcc1['jml_gudang'] + $rcc1['jml_toko']);
					$jml_min = nosql($rcc1['jml_min']);

					//nek jmlx lebih...
					if ($y_qty >= $jml_cc1)
						{
						//null-kan
						xfree($qbw);
						xclose($koneksi);

						//re-direct
						$pesan = "Jumlah Item Melebihi Jumlah Stock Yang Ada. Harap Dipehatikan...!!";
						pekem($pesan,$ke);
						exit();
						}
					else
						{
						//kurangi stock
						//deteksi
						$qdtx = mysqli_query($koneksi, "SELECT * FROM stock ".
												"WHERE kd_brg = '$brg_kd'");
						$rdtx = mysqli_fetch_assoc($qdtx);
						$dtx_toko = nosql($rdtx['jml_toko']);
						$dtx_gudang = nosql($rdtx['jml_gudang']);

						//nek mencukupi
						if ($dtx_toko > $y_qty)
							{
							$s_gudang = 0;
							$s_toko =  $y_qty;

							mysqli_query($koneksi, "UPDATE stock ".
											"SET jml_toko = jml_toko - '$s_toko' ".
											"WHERE kd_brg = '$brg_kd'");


							//simpan
							mysqli_query($koneksi, "INSERT INTO jual_detail(kd, kd_jual, kd_brg, qty, qty_gudang, qty_toko, ".
											"hrg_jual, hrg_jual_br, diskon, subtotal) VALUES ".
											"('$x', '$jukd', '$brg_kd', '$y_qty', '$s_gudang', '$s_toko', ".
											"'$brg_hrg_jual', '$brg_hrg_jual_br', '$brg_diskon', '$subtotal')");
							}
						else if ($dtx_toko < $y_qty)
							{
							$s_gudang = $y_qty - $dtx_toko; //sisa utk gudang
							$s_toko = $y_qty - $s_gudang; //sisa utk toko

							//update toko
							mysqli_query($koneksi, "UPDATE stock ".
											"SET jml_toko = jml_toko - '$s_toko' ".
											"WHERE kd_brg = '$brg_kd'");

							//update gudang
							mysqli_query($koneksi, "UPDATE stock ".
											"SET jml_gudang = jml_gudang - '$s_gudang' ".
											"WHERE kd_brg = '$brg_kd'");


							//simpan
							mysqli_query($koneksi, "INSERT INTO jual_detail(kd, kd_jual, kd_brg, qty, qty_gudang, qty_toko, ".
											"hrg_jual, hrg_jual_br, diskon, subtotal) VALUES ".
											"('$x', '$jukd', '$brg_kd', '$y_qty', '$s_gudang', '$s_toko', ".
											"'$brg_hrg_jual', '$brg_hrg_jual_br', '$brg_diskon', '$subtotal')");
							}


						//null-kan
						xfree($qbw);
						xclose($koneksi);

						//re-direct
						$ke = "$filenya?kastkd=$kastkd".
								"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
								"&jukd=$jukd&yuk=detail";
						xloc($ke);
						exit();
						}
					}
				}
			}
		else
			{
			//null-kan
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			$pesan = "Tidak Ada Kode Barang : $y_kode. Harap Cek Penawaran Tanggal Terakhir. Silahkan Diulangi...!!";
			$ke = "$filenya?kastkd=$kastkd".
					"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
					"&jukd=$jukd&yuk=detail";
			pekem($pesan,$ke);
			exit();
			}
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//jika hapus detail item penjualan /////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnHPS2'])
	{
	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";

	$kastkd = nosql($_POST['p_kastkd']);
	$jukd = nosql($_POST['p_jukd']);
	$page = nosql($_POST['page']);

	for($nomer=1;$nomer<=$limit;$nomer++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$nomer";
		$kd = nosql($_POST["$yuhu"]);

		//netralkan dahulu /////////////////////////////////////////////////////////////
		$qcc = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
								"WHERE kd = '$kd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_brg_kd = nosql($rcc['kd_brg']);
		$cc_qty_gudang = nosql($rcc['qty_gudang']);
		$cc_qty_toko = nosql($rcc['qty_toko']);

		//tambahkan stock
		mysqli_query($koneksi, "UPDATE stock SET jml_gudang = jml_gudang + '$cc_qty_gudang', ".
						"jml_toko = jml_toko + '$cc_qty_toko' ".
						"WHERE kd_brg = '$cc_brg_kd'");
		////////////////////////////////////////////////////////////////////////////////


		//del /////////////////////////////////////////////////////////////////////////
		mysqli_query($koneksi, "DELETE FROM jual_detail ".
						"WHERE kd = '$kd'");
		///////////////////////////////////////////////////////////////////////////////
		}

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?kastkd=$kastkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&jukd=$jukd&yuk=detail";
	xloc($ke);
	exit();
	}



//nek simpan daftar item penjualan /////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP3'])
	{
	//nilai
	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl = "$xthn1:$xbln1:$xtgl1";

	$kastkd = nosql($_POST['p_kastkd']);
	$jukd = nosql($_POST['p_jukd']);

	$page = nosql($_POST['page']);

	if ((empty($page)) OR ($page == "0"))
		{
		$page = "1";
		}


	for($ongko=1;$ongko<=$limit;$ongko++)
		{
		//ambil nilai
		$xkd = "kd";
		$xkd1 = "$xkd$ongko";
		$xkdx = nosql($_POST["$xkd1"]);

		$xhrg = "hrg";
		$xhrg1 = "$xhrg$ongko";
		$xhrgx = nosql($_POST["$xhrg1"]);

		$xqty = "qty";
		$xqty1 = "$xqty$ongko";
		$xqtyx = nosql($_POST["$xqty1"]);

		$xdisk = "disk";
		$xdisk1 = "$xdisk$ongko";
		$xdiskx = nosql($_POST["$xdisk1"]);

		$xhrg = "hrg";
		$xhrg1 = "$xhrg$ongko";
		$xhrgx = nosql($_POST["$xhrg1"]);

		$xmuhrg = "muhrg";
		$xmuhrg1 = "$xmuhrg$ongko";
		$xmuhrgx = nosql($_POST["$xmuhrg1"]);

		$xsubtotal = "subtotal";
		$xsubtotal1 = "$xsubtotal$ongko";
		$xsubtotalx = nosql($_POST["$xsubtotal1"]);


		//netralkan dahulu /////////////////////////////////////////////////////////////
		$qcc = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
								"WHERE kd = '$xkdx'");
		$rcc = mysqli_fetch_assoc($qcc);
		$tcc = mysqli_num_rows($qcc);
		$cc_brg_kd = nosql($rcc['kd_brg']);
		$cc_qty_gudang = nosql($rcc['qty_gudang']);
		$cc_qty_toko = nosql($rcc['qty_toko']);

		//jumlahkan stock
		mysqli_query($koneksi, "UPDATE stock SET jml_gudang = jml_gudang + '$cc_qty_gudang', ".
						"jml_toko = jml_toko + '$cc_qty_toko' ".
						"WHERE kd_brg = '$cc_brg_kd'");
		////////////////////////////////////////////////////////////////////////////////



		//sesuaikan ////////////////////////////////////////////////////////////////////
		//lakukan sekarang .......................................................................
		//deteksi, jmlx > dari stock
		$qcc1 = mysqli_query($koneksi, "SELECT * FROM stock ".
								"WHERE kd_brg = '$cc_brg_kd'");
		$rcc1 = mysqli_fetch_assoc($qcc1);
		$jml_cc1 = nosql($rcc1['jml_gudang'] + $rcc1['jml_toko']);
		$jml_min = nosql($rcc1['jml_min']);

		//nek xqtyx lebih...
		if ($xqtyx >= $jml_cc1)
			{
			//null-kan
			xfree($qcc);
			xfree($qcc1);

			//re-direct
			$pesan = "Jumlah Item Melebihi Jumlah Stock Yang Ada. Harap Dipehatikan...!!";
			pekem($pesan,$ke);
			exit();
			}
		else
			{
			//kurangi stock toko
			//deteksi
			$qdtx = mysqli_query($koneksi, "SELECT * FROM stock ".
									"WHERE kd_brg = '$cc_brg_kd'");
			$rdtx = mysqli_fetch_assoc($qdtx);
			$dtx_toko = nosql($rdtx['jml_toko']);
			$dtx_gudang = nosql($rdtx['jml_gudang']);

			//nek mencukupi
			if ($dtx_toko > $xqtyx)
				{
				$s_gudang = 0;
				$s_toko =  $xqtyx;

				mysqli_query($koneksi, "UPDATE stock ".
								"SET jml_toko = jml_toko - '$s_toko' ".
								"WHERE kd_brg = '$cc_brg_kd'");
				}
			else if ($dtx_toko < $xqtyx)
				{
				$s_gudang = $xqtyx - $dtx_toko; //sisa utk gudang
				$s_toko =  $xqtyx - $s_gudang; //sisa utk toko

				//update toko
				mysqli_query($koneksi, "UPDATE stock ".
								"SET jml_toko = jml_toko - '$s_toko' ".
								"WHERE kd_brg = '$cc_brg_kd'");

				//update gudang
				mysqli_query($koneksi, "UPDATE stock ".
								"SET jml_gudang = jml_gudang - '$s_gudang' ".
								"WHERE kd_brg = '$cc_brg_kd'");
				}

			//subtotal baru
			$cc_subtotal_x = round($xqtyx * $xmuhrgx);

			//update detail
			mysqli_query($koneksi, "UPDATE jual_detail SET qty = '$xqtyx', ".
							"qty_toko = '$s_toko', ".
							"qty_gudang = '$s_gudang', ".
							"hrg_jual = '$xhrgx', ".
							"diskon = '$xdiskx', ".
							"hrg_jual_br = '$xmuhrgx', ".
							"subtotal = '$cc_subtotal_x' ".
							"WHERE kd_jual = '$jukd' ".
							"AND kd_brg = '$cc_brg_kd'");
			}
		////////////////////////////////////////////////////////////////////////////////
		}

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//auto-kembali
	$ke = "$filenya?kastkd=$kastkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&jukd=$jukd&yuk=detail";
	xloc($ke);
	exit();
	}



//nek surat pengantar
if ($_POST['btnSP'])
	{
	//nilai
	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$kastkd = nosql($_POST['p_kastkd']);
	$jukd = nosql($_POST['p_jukd']);


	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl1 = "$xthn1:$xbln1:$xtgl1";

	//tgl bayar
	$lxtgl = nosql($_POST['lxtgl']);
	$lxbln = nosql($_POST['lxbln']);
	$lxthn = nosql($_POST['lxthn']);
	$ltgl = "$lxthn:$lxbln:$lxtgl";

	$nofak = nosql($_POST['nofak']);
	$jbyr = nosql($_POST['jbyr']);
	$total_jual = nosql($_POST['total_jual']);


	//update
	mysqli_query($koneksi, "UPDATE jual SET total_jual = '$total_jual', ".
						"kd_jns_byr = '$jbyr', ".
						"tgl_bayar = '$ltgl', ".
						"postdate = '$today' ".
						"WHERE kd = '$jukd'");


	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//ke print
	$ke = "jual_sp.php?kastkd=$kastkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&jukd=$jukd";
	xloc($ke);
	exit();
	}



//nek kwitansi
if ($_POST['btnKWI'])
	{
	//nilai
	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$kastkd = nosql($_POST['p_kastkd']);
	$jukd = nosql($_POST['p_jukd']);


	//tgl jual
	$xtgl1 = nosql($_POST['p_xtgl1']);
	$xbln1 = nosql($_POST['p_xbln1']);
	$xthn1 = nosql($_POST['p_xthn1']);
	$tgl1 = "$xthn1:$xbln1:$xtgl1";

	//tgl bayar
	$lxtgl = nosql($_POST['lxtgl']);
	$lxbln = nosql($_POST['lxbln']);
	$lxthn = nosql($_POST['lxthn']);
	$ltgl = "$lxthn:$lxbln:$lxtgl";

	$nofak = nosql($_POST['nofak']);
	$jbyr = nosql($_POST['jbyr']);
	$total_jual = nosql($_POST['total_jual']);


	//update
	mysqli_query($koneksi, "UPDATE jual SET total_jual = '$total_jual', ".
						"kd_jns_byr = '$jbyr', ".
						"tgl_bayar = '$ltgl', ".
						"postdate = '$today' ".
						"WHERE kd = '$jukd'");

	//null-kan
	xfree($qbw);
	xclose($koneksi);

	//ke print
	$ke = "jual_kwi.php?kastkd=$kastkd".
			"&xtgl1=$xtgl1&xbln1=$xbln1&xthn1=$xthn1".
			"&jukd=$jukd";
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
	\'jual_popup_brg.php?kastkd='.$kastkd.'\',
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
<strong>Kastumer : </strong>';
echo "<select name=\"kastumer\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qsupx = mysqli_query($koneksi, "SELECT * FROM m_kastumer ".
						"WHERE kd = '$kastkd'");
$rsupx = mysqli_fetch_assoc($qsupx);
$supx_kd = nosql($rsupx['kd']);
$supx_nm = balikin($rsupx['singkatan']);


echo '<option value="'.$supx_kd.'" selected>'.$supx_nm.'</option>';

//query
$qsup = mysqli_query($koneksi, "SELECT * FROM m_kastumer ".
						"WHERE kd <> '$kastkd' ".
						"ORDER BY singkatan ASC");
$rsup = mysqli_fetch_assoc($qsup);

do
	{
	$sup_kd = nosql($rsup['kd']);
	$sup_sing = balikin($rsup['singkatan']);

	echo '<option value="'.$filenya.'?kastkd='.$sup_kd.'">'.$sup_sing.'</option>';
	}
while ($rsup = mysqli_fetch_assoc($qsup));

echo '</select>,

<strong>Tanggal Jual : </strong>';
echo "<select name=\"xtgl1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xtgl1.'" selected>'.$xtgl1.'</option>';

for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$filenya.'?kastkd='.$kastkd.'&xtgl1='.$i.'">'.$i.'</option>';
	}

echo '</select>';

echo "<select name=\"xbln1\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$xbln1.'" selected>'.$arrbln[$xbln1].'</option>';

for ($j=1;$j<=12;$j++)
	{
	echo '<option value="'.$filenya.'?kastkd='.$kastkd.'&xtgl1='.$xtgl1.'&xbln1='.$j.'">'.$arrbln[$j].'</option>';
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
	echo '<option value="'.$filenya.'?kastkd='.$kastkd.'&xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$x_thn.'">'.$x_thn.'</option>';
	}
while ($rthn = mysqli_fetch_assoc($qthn));

echo '</select>,
<strong>No. Faktur : </strong>';
echo "<select name=\"fak\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qtru = mysqli_query($koneksi, "SELECT * FROM jual ".
						"WHERE round(DATE_FORMAT(tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%Y')) = '$xthn1' ".
						"AND kd = '$jukd'");
$rtru = mysqli_fetch_assoc($qtru);
$x_jukd = $jukd;
$x_nofak = nosql($rtru['no_faktur']);


//terpilih --> total item
$qtru2 = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
						"WHERE kd_jual = '$jukd'");
$rtru2 = mysqli_fetch_assoc($qtru2);
$ttru2 = mysqli_num_rows($qtru2);
$x_jual_items = nosql($ttru2);

echo '<option value="'.$x_jukd.'" selected>'.$x_nofak.' => ['.$x_jual_items.' Item].</option>';

//data
$qtrux = mysqli_query($koneksi, "SELECT * FROM jual ".
						"WHERE round(DATE_FORMAT(tgl_jual, '%d')) = '$xtgl1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%m')) = '$xbln1' ".
						"AND round(DATE_FORMAT(tgl_jual, '%Y')) = '$xthn1' ".
						"AND kd <> '$jukd' ".
						"AND kd_kastumer = '$kastkd' ".
						"ORDER BY round(no_faktur) ASC");
$rtrux = mysqli_fetch_assoc($qtrux);

do
	{
	$i_jukd = nosql($rtrux['kd']);
	$i_nofak = balikin($rtrux['no_faktur']);


	//jumlahnya
	$qyukx = mysqli_query($koneksi, "SELECT * FROM jual_detail ".
							"WHERE kd_jual = '$i_jukd'");
	$ryukx = mysqli_fetch_assoc($qyukx);
	$tyukx = mysqli_num_rows($qyukx);
	$i_jual_items = $tyukx;

	echo '<option value="'.$filenya.'?kastkd='.$kastkd.''.
	'&xtgl1='.$xtgl1.'&xbln1='.$xbln1.'&xthn1='.$xthn1.''.
	'&jukd='.$i_jukd.'">
	'.$i_nofak.' => ['.$i_jual_items.' Item]. </option>';
	}
while ($rtrux = mysqli_fetch_assoc($qtrux));

echo '</select>
<input name="btnBR" type="submit" value="BARU" '.$attribut.'>
</td>
</tr>
</table>';


//nek masih do null
if (empty($kastkd))
	{
	echo "<strong>Kastumer Belum Dipilih...!!</strong>";
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
else if (empty($jukd))
	{
	echo "<strong>No. Faktur Belum Dipilih...!!</strong>";
	}
else
	{
	//query view
	$qteh = mysqli_query($koneksi, "SELECT jual.*, DATE_FORMAT(jual.tgl_bayar, '%d') AS ltgl, ".
							"DATE_FORMAT(jual.tgl_bayar, '%m') AS lbln, ".
							"DATE_FORMAT(jual.tgl_bayar, '%Y') AS lthn ".
							"FROM jual ".
							"WHERE jual.kd = '$jukd'");
	$rteh = mysqli_fetch_assoc($qteh);
	$e_nofak = nosql($rteh['no_faktur']);
	$e_jns_byr_kd = nosql($rteh['kd_jns_byr']);
	$e_ltgl = nosql($rteh['ltgl']);
	$e_lbln = nosql($rteh['lbln']);
	$e_lthn = nosql($rteh['lthn']);

	//jenis pembayaran
	$qjby = mysqli_query($koneksi, "SELECT * FROM m_jns_byr ".
							"WHERE kd = '$e_jns_byr_kd'");
	$rjby = mysqli_fetch_assoc($qjby);
	$e_jns_byr_nm = balikin($rjby['jns_byr']);


	//nek null baru
	if ($s == "baru")
		{
		$e_nofak = $xnofak;
		}
	else
		{
		$e_nofak = $x_nofak;
		}





	//total sementara
	$qduwi = mysqli_query($koneksi, "SELECT SUM(subtotal) AS subtotal ".
							"FROM jual_detail ".
							"WHERE kd_jual = '$jukd'");
	$rduwi = mysqli_fetch_assoc($qduwi);

	$e_total_jual = nosql($rduwi['subtotal']);



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
	<tr>
	<td>
	<strong>No. Faktur : </strong>
	<input name="nofak" type="text" value="'.$e_nofak.'" size="25" class="input" readonly>,

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

	echo '</select>,

	<strong>Tgl. Bayar :</strong>
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

	echo '</select>,
	<strong>Total : </strong>Rp.
	<input name="total_jual" type="text" value="'.$e_total_jual.'" size="15" class="input" style="text-align:right" readonly>,00
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
	<input name="btnSP" type="submit" value="Surat Pengantar">
	<input name="btnKWI" type="submit" value="Kwitansi">
	</td>
	</tr>
	</table>
	<br>
	<br>
	<br>';


	//nek detail
	if ($yuk == "detail")
		{
		//brg e...
		$qbee = mysqli_query($koneksi, "SELECT * FROM m_brg ".
								"WHERE kode = '$y_kode'");
		$rbee = mysqli_fetch_assoc($qbee);
		$bee_nama = balikin($rbee['nama']);

		//input item
		echo '<strong>Kode Barang : </strong>
		<input name="y_kode" type="text" value="'.$y_kode.'" size="10" '.$x_item.'>,

		<strong>Nama Barang : </strong>
		<input name="y_brg" type="text" value="'.$bee_nama.'" size="30" class="input" readonly>,

		<br>

		<strong>Harga Jual : </strong>
		Rp.<input name="y_hjual" type="text" value="'.$y_hjual.'" size="10" style="text-align:right" class="input" readonly>,00 ,

		<strong>Qty. :</strong>
		<input name="y_qty" type="text" value="" size="5" style="text-align:right"
		onKeyUp="document.formx.y_subtotal.value=Math.round(document.formx.y_qty.value * document.formx.y_hjual.value);"
		onKeyPress="return numbersonly(this, event)"
		'.$x_enter2.'>

		<strong>SubTotal :</strong>
		Rp.<input name="y_subtotal" type="text" value="" size="10" style="text-align:right" class="input" readonly>,00

		<br>


		<input name="btnBTL" type="reset" value="BATAL">
		<input name="btnSMP2" type="submit" value="SIMPAN >>>">
		[INSERT : Pilih Kode Barang].
		<br>
		<br>';


		//detail item / barang
		$qdti = mysqli_query($koneksi, "SELECT jual_detail.*, jual_detail.kd AS bdkd, ".
								"m_brg.*, m_satuan.*, stock.* ".
								"FROM jual_detail, m_brg, m_satuan, stock ".
								"WHERE jual_detail.kd_brg = m_brg.kd ".
								"AND m_brg.kd_satuan = m_satuan.kd ".
								"AND stock.kd_brg = jual_detail.kd_brg ".
								"AND jual_detail.kd_jual = '$jukd' ".
								"ORDER BY m_brg.kode ASC");
		$rdti = mysqli_fetch_assoc($qdti);
		$tdti = mysqli_num_rows($qdti);

		echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="1%">&nbsp;</td>
		<td width="10%"><strong>Kode</strong></td>
		<td><strong>Nama Barang</strong></td>
		<td width="10%" align="center"><strong>Qty.</strong></td>
		<td width="5%" align="center"><strong>Harga</strong></td>
		<td width="5%" align="center"><strong>SubTotal</strong></td>
		</tr>';

		//nek gak nul
		if ($tdti != "0")
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
				$d_kd = nosql($rdti['bdkd']);
				$d_brgkd = nosql($rdti['kd_brg']);
				$d_kode = nosql($rdti['kode']);
				$d_nama = balikin($rdti['nama']);
				$d_satuan = balikin($rdti['satuan']);
				$d_qty = nosql($rdti['qty']);
				$d_qty_x = $d_qty;

				$d_hrg = nosql($rdti['hrg_jual']);
				$d_hrg_br = nosql($rdti['hrg_jual_br']);
				$d_diskon = nosql($rdti['diskon']);
				$d_muhrg = $d_hrg_br;

				//subtotal
				$d_subtotal = round($d_muhrg * $d_qty_x);




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

				echo "<tr bgcolor=\"$warna\" onkeyup=\"this.bgColor='$warnaover';\" onkeydown=\"this.bgColor='$warna';\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$d_kd.'">
				<input type="checkbox" name="item'.$nomer.'" value="'.$d_kd.'">
				</td>
				<td>'.$d_kode.'</td>
				<td>'.$d_nama.'</td>
				<td>
				<input name="qty'.$nomer.'" type="text" value="'.$d_qty_x.'" size="5" style="text-align:right"
				onKeyPress="return numbersonly(this, event)"
				onKeyUp="document.formx.subtotal'.$nomer.'.value=Math.round(document.formx.qty'.$nomer.'.value * document.formx.muhrg'.$nomer.'.value);"
				onKeyDown="var keyCode = event.keyCode;
				if (keyCode == 38)
					{
					document.formx.qty'.$nil.'.focus();
					}

				if (keyCode == 40)
					{
					document.formx.qty'.$nild.'.focus();
					}

				if (keyCode == 13)
					{
					document.formx.btnSMP3.focus();
					document.formx.btnSMP3.submit();
					}
				" '.$x_enter3.'>'.$d_satuan.'
				</td>
				<td>
				<input name="hrg'.$nomer.'" type="hidden" value="'.$d_hrg.'">
				<input name="disk'.$nomer.'" type="hidden" value="'.$d_diskon.'">
				<input name="muhrg'.$nomer.'" type="text" value="'.$d_muhrg.'" size="10" class="input" style="text-align:right" readonly>
				</td>
				<td>
				<input name="subtotal'.$nomer.'" type="text" value="'.$d_subtotal.'" size="10" class="input" style="text-align:right" readonly>
				</td>
				</tr>';
				}
			while ($rdti = mysqli_fetch_assoc($qdti));
			}

		echo '</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$tdti.')">
		<input name="btnRST" type="reset" value="BATAL">
		<input name="btnHPS2" type="submit" value="HAPUS">
		<input name="btnSMP3" type="submit" value="SIMPAN">
		</td>
		</tr>
		</table>';
		}
	}


echo '<input name="page" type="hidden" value="'.$page.'">
<input name="p_xtgl1" type="hidden" value="'.$xtgl1.'">
<input name="p_xbln1" type="hidden" value="'.$xbln1.'">
<input name="p_xthn1" type="hidden" value="'.$xthn1.'">
<input name="p_jukd" type="hidden" value="'.$jukd.'">
<input name="p_kastkd" type="hidden" value="'.$kastkd.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="yuk" type="hidden" value="'.$yuk.'">
<br>
<br>
<br>
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