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

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/admks.php");
$tpl = LoadTpl("../template/kasir.html");


//nilai
$filenya = "index.php";
$diload = "open_ks(); return false";
$judul = "Pembuat Nota";
$judulku = "[$kasir_session : $username2_session] ==> $judul  ";





//isi *START
ob_start();


//popup
echo '<script type="text/javascript" src="'.$sumber.'/inc/js/dhtmlwindow_admks.js"></script>
<script type="text/javascript" src="'.$sumber.'/inc/js/modal.js"></script>
<script type="text/javascript">
function open_ks()
	{
	ks_window=dhtmlmodal.open(\'Buat NOTA\',
	\'iframe\',
	\'nota.php\',
	\'Buat NOTA [Petugas : '.$username2_session.']\',
	\'width=970px,height=450px,center=1,resize=0,scrolling=0\');
	}

function open_pass()
	{
	pass_window=dhtmlmodal.open(\'Ganti Password\',
	\'iframe\',
	\'pass.php\',
	\'Ganti Password\',
	\'width=400px,height=320px,center=1,resize=0,scrolling=0\');
	}
</script>';


//no-right
echo '<TABLE WIDTH=800 BORDER=0 CELLPADDING=0 CELLSPACING=0>
<TR>
<TD>
<IMG SRC="'.$sumber.'/img/nota_01.gif" WIDTH=292 HEIGHT=30 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/nota_02.gif" WIDTH=290 HEIGHT=30 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/nota_03.gif" WIDTH=218 HEIGHT=30 ALT="">
</TD>
</TR>
<TR>
<TD>
<a href="#" title="Buat NOTA"><IMG SRC="'.$sumber.'/img/nota_04.gif" WIDTH=292 HEIGHT=184 ALT="Buat NOTA" border="0" onClick="open_ks(); return false"></a>
</TD>
<TD>
<a href="#" title="Ganti Password"><IMG SRC="'.$sumber.'/img/nota_05.gif" WIDTH=290 HEIGHT=184 ALT="Ganti Password" border="0" onClick="open_pass(); return false"></a>
</TD>
<TD>
<a href="../logout.php" title="LogOut..."><IMG SRC="'.$sumber.'/img/nota_06.gif" WIDTH=218 HEIGHT=184 ALT="LogOut..." border="0"></a>
</TD>
</TR>
<TR>
<TD ROWSPAN=3>
<IMG SRC="'.$sumber.'/img/nota_07.gif" WIDTH=292 HEIGHT=118 ALT="">
</TD>
<TD ROWSPAN=3>
<IMG SRC="'.$sumber.'/img/nota_08.gif" WIDTH=290 HEIGHT=118 ALT="">
</TD>
<TD>
<IMG SRC="'.$sumber.'/img/nota_09.gif" WIDTH=218 HEIGHT=81 ALT="">
</TD>
</TR>
<TR>
<TD background="'.$sumber.'/img/nota_10.gif" align="right" height="23">
<font color="#FFFFFF">Petugas => <strong>'.$username2_session.'</strong> &nbsp;</font>
</TD>
</TR>
<TR>
<TD>
<IMG SRC="'.$sumber.'/img/nota_11.gif" WIDTH=218 HEIGHT=14 ALT="">
</TD>
</TR>
</TABLE>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//null-kan
xfree($qbw);
xclose($koneksi);
exit();
?>