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
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/window.html");

nocache;

//nilai
$filenya = "kastumer_entry_edit.php";
$diload = "document.formx.nama.focus();";
$judul = "Edit Data Kastumer";
$judulku = $judul;
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//nek enter
$x_enter = 'onkeypress="return handleEnter(this, event)"';



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}



//jika edit
if ($s == "edit")
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysql_query("SELECT * FROM m_kastumer ".
						"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);

	$nama = balikin($rowx['nama']);
	$singkatan = balikin($rowx['singkatan']);
	$alamat = balikin($rowx['alamat']);
	$telp = balikin($rowx['telp']);
	$hp = balikin($rowx['hp']);
	$fax = balikin($rowx['fax']);
	$email = balikin($rowx['email']);
	$cp_nama = balikin($rowx['cp_nama']);
	$cp_alamat = balikin($rowx['cp_alamat']);
	$cp_telp = balikin($rowx['cp_telp']);
	$cp_hp = balikin($rowx['cp_hp']);
	$cp_fax = balikin($rowx['cp_fax']);
	$cp_email = balikin($rowx['cp_email']);
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$nama = cegah($_POST['nama']);
	$singkatan = cegah($_POST['singkatan']);
	$alamat = cegah($_POST['alamat']);
	$telp = cegah($_POST['telp']);
	$hp = cegah($_POST['hp']);
	$fax = cegah($_POST['fax']);
	$email = cegah($_POST['email']);
	$cp_nama = cegah($_POST['cp_nama']);
	$cp_alamat = cegah($_POST['cp_alamat']);
	$cp_telp = cegah($_POST['cp_telp']);
	$cp_hp = cegah($_POST['cp_hp']);
	$cp_fax = cegah($_POST['cp_fax']);
	$cp_email = cegah($_POST['cp_email']);


	//nek null
	if ((empty($nama)) OR (empty($alamat)) OR (empty($telp)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{ ///cek
		$qcc = mysql_query("SELECT * FROM m_kastumer ".
								"WHERE nama = '$nama'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);


		//nek duplikasi, lebih dari 1
		if ($tcc > 1)
			{
			//null-kan
			xfree($qcc);
			xclose($koneksi);

			//re-direct
			$pesan = "Ditemukan Duplikasi Kastumer : $nama. Harap Segera Diperhatikan...!!";
			pekem($pesan,$filenya);
			exit();
			}
		else
			{
			//jika update
			if ($s == "edit")
				{
				mysql_query("UPDATE m_kastumer SET nama = '$nama', ".
								"singkatan = '$singkatan', ".
								"alamat = '$alamat', ".
								"telp = '$telp', ".
								"hp = '$hp', ".
								"fax = '$fax', ".
								"email = '$email', ".
								"cp_nama = '$cp_nama', ".
								"cp_alamat = '$cp_alamat', ".
								"cp_telp = '$cp_telp', ".
								"cp_hp = '$cp_hp', ".
								"cp_fax = '$cp_fax', ".
								"cp_email = '$cp_email' ".
								"WHERE kd = '$kd'");

				//null-kan
				xfree($qcc);
				xclose($koneksi);

				//re-direct --> close
				echo "<script>
				parent.edit_window.onClose();
				parent.edit_window.hide();
				</script>";
				}
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();






//require
require("../../inc/js/jumpmenu.js");
require("../../inc/js/down_enter.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td>';
xheadline($judul);
echo '</td>
</tr>
</table>
<br>

<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top">
<td>
Nama : <br>
<input name="nama" type="text" value="'.$nama.'" size="30" '.$x_enter.'><br>
Singkatan : <br>
<input name="singkatan" type="text" value="'.$singkatan.'" size="20" '.$x_enter.'>
</td>
<td>
Alamat : <br>
<input name="alamat" type="text" value="'.$alamat.'" size="30" '.$x_enter.'><br>
Telp. : <br>
<input name="telp" type="text" value="'.$telp.'" size="15" '.$x_enter.'>
</td>
<td>
HP. : <br>
<input name="hp" type="text" value="'.$hp.'" size="20" '.$x_enter.'><br>
FAX. : <br>
<input name="fax" type="text" value="'.$fax.'" size="20" '.$x_enter.'>
</td>
<td>
E-Mail : <br>
<input name="email" type="text" value="'.$email.'" size="15" '.$x_enter.'><br>

</td>
</tr>
<tr>
<td>
<br>
</td>
</tr>
<tr>
<td>
<strong>Contact Person : </strong>
</td>
</tr>

<tr>
<td>
Nama : <br>
<input name="cp_nama" type="text" value="'.$cp_nama.'" size="30" '.$x_enter.'><br>
Alamat : <br>
<input name="cp_alamat" type="text" value="'.$cp_alamat.'" size="30" '.$x_enter.'><br>
</td>
<td>
Telp. : <br>
<input name="cp_telp" type="text" value="'.$cp_telp.'" size="15" '.$x_enter.'><br>
HP. : <br>
<input name="cp_hp" type="text" value="'.$cp_hp.'" size="20" '.$x_enter.'><br>
</td>
<td>
FAX. : <br>
<input name="cp_fax" type="text" value="'.$cp_fax.'" size="20" '.$x_enter.'><br>
E-Mail : <br>
<input name="cp_email" type="text" value="'.$cp_email.'" size="15"><br>
</td>
</tr>
</table>

<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kd.'">
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
<input name="btnKLR" type="submit" value="TUTUP" onClick="parent.edit_window.onClose();parent.edit_window.hide();">
</form>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>