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
$filenya = "supplier.php";
$judul = "Data Supplier";
$judulku = "[$admin_session : $username1_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


//tombol "INSERT"=45, utk. ke pencarian
$dikeydown = "var keyCode = event.keyCode;
if (keyCode == 45)
	{
	document.formx.katcari.focus();
	}";

//nek enter
$x_enter = 'onkeypress="return handleEnter(this, event)"';

//nek enter, ke cari
$x_enter2 = 'onKeyDown="var keyCode = event.keyCode;
if (keyCode == 13)
	{
	document.formx.btnCRI.focus();
	}"';



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}





//jika hapus
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
		mysqli_query($koneksi, "DELETE FROM m_supplier ".
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


//jika cari
if (($_POST['btnCRI']) OR ($_POST['kunci']))
	{
	$katcari = nosql($_POST['katcari']);
	$kunci = cegah($_POST['kunci']);

	//nek null
	if ((empty($katcari)) OR (empty($kunci)))
		{
		//re-direct
		$pesan = "Anda Belum Memasukkan Kata Kunci Pencarian. Harap Diulangi...!!";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//nek nama ==> c01
		if ($katcari == "c01")
			{
			$sqlcount = "SELECT * FROM m_supplier ".
							"WHERE nama LIKE '%$kunci%' ".
							"ORDER BY nama ASC";

			$sqlresult = $sqlcount;

			$count = mysqli_num_rows(mysqli_query($sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			}

		//nek alamat ==> c02
		if ($katcari == "c02")
			{
			$sqlcount = "SELECT * FROM m_supplier ".
							"WHERE alamat LIKE '%$kunci%' ".
							"ORDER BY alamat ASC";

			$sqlresult = $sqlcount;

			$count = mysqli_num_rows(mysqli_query($sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			}

		//nek telp ==> c03
		if ($katcari == "c03")
			{
			$sqlcount = "SELECT * FROM m_supplier ".
							"WHERE telp LIKE '%$kunci%' ".
							"ORDER BY telp ASC";

			$sqlresult = $sqlcount;

			$count = mysqli_num_rows(mysqli_query($sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			}

		//nek email ==> c04
		if ($katcari == "c04")
			{
			$sqlcount = "SELECT * FROM m_supplier ".
							"WHERE email LIKE '%$kunci%' ".
							"ORDER BY email ASC";

			$sqlresult = $sqlcount;

			$count = mysqli_num_rows(mysqli_query($sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			}
		}
	}
else
	{
	$sqlcount = "SELECT * FROM m_supplier ".
					"ORDER BY nama ASC";

	$sqlresult = $sqlcount;

	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	}



//require
echo '<script type="text/javascript" src="'.$sumber.'/inc/js/dhtmlwindow_adm.js"></script>
<script type="text/javascript" src="'.$sumber.'/inc/js/modal.js"></script>
<script type="text/javascript">
function open_entry()
	{
	entry_window=dhtmlmodal.open(\'Entry Data Supplier\',
	\'iframe\',
	\'supplier_entry.php\',
	\'Entry Data Supplier\',
	\'width=900px,height=275px,center=1,resize=0,scrolling=0\');

	entry_window.onClose=function()
		{
		location.href=\''.$filenya.'\';

		return true
		}
	}

function open_edit()
	{
	edit_window=dhtmlmodal.open(\'Edit Data Supplier\',
	\'iframe\',
	\'supplier_entry_edit.php\',
	\'Edit Data Supplier\',
	\'width=900px,height=275px,center=1,resize=0,scrolling=0\');

	edit_window.onClose=function()
		{
		location.href=\''.$filenya.'\';

		return true
		}
	}
</script>';

//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/down_enter.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/listmenu.js");
require("../../inc/menu/adm.php");
require("../../inc/menu/adm_cek.php");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>';
xheadline($judul);
echo ' [<a href="" onClick="open_entry(); return false">ENTRY Data</a>]</td>
<td align="right">
<select name="katcari">
<option value="" selected></option>
<option value="c01">Nama</option>
<option value="c02">Alamat</option>
<option value="c03">Telp.</option>
<option value="c04">E-Mail</option>
</select>

<input name="kunci" type="text" size="10" '.$x_enter2.'>
<input name="btnCRI" type="submit" value="CARI">
<input name="btnRST" type="submit" value="RESET">
</td>
</tr>
</table>

<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr valign="top" bgcolor="'.$warnaheader.'">
<td>&nbsp;</td>
<td>&nbsp;</td>
<td width="150"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Singkatan</font></strong></td>
<td><strong><font color="'.$warnatext.'">Alamat</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">Telp.</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Hp.</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Fax.</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">E-Mail</font></strong></td>
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
		$kd = nosql($data['kd']);
		$nama = balikin($data['nama']);
		$singkatan = balikin($data['singkatan']);
		$alamat = balikin($data['alamat']);
		$telp = balikin($data['telp']);
		$hp = balikin($data['hp']);
		$fax = balikin($data['fax']);
		$email = balikin($data['email']);

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td width="5">
		<input type="checkbox" name="item'.$nomer.'" value="'.$kd.'">
        </td>
		<td width="5">
		<a href="#" onClick="edit_window=dhtmlmodal.open(\'Edit Data Supplier\', \'iframe\', \'supplier_entry_edit.php?s=edit&kd='.$kd.'\', \'Edit Data Supplier\', \'width=900px,height=275px,center=1,resize=0,scrolling=0\');
		edit_window.onClose=function()
			{
			location.href=\''.$filenya.'\';

			return true
			}"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
		</td>
		<td>'.$nama.'</td>
		<td>'.$singkatan.'</td>
		<td>'.$alamat.'</td>
		<td>'.$telp.'</td>
		<td>'.$hp.'</td>
		<td>'.$fax.'</td>
		<td>'.$email.'</td>
        </tr>';
		}
	while ($data = mysqli_fetch_assoc($result));
	}


echo '</table>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="263">
<input name="jml" type="hidden" value="'.$count.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
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