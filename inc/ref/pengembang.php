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


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
$tpl = LoadTpl("../../template/login_adm.html");


nocache;

//nilai
$filenya = "pengembang.php";
$judul = "Pengembang";



//isi *START
ob_start();

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="600" border="0" cellspacing="5" cellpadding="0">
<tr valign="top">
<td>

<p>
<hr>
<big>
<font color="violet">
<strong>Pengembang/Penulis/Programmer/Pencipta SISFO-TOKO</strong>
</font>
</big>
<hr>
</p>

<p align="right">
<strong>URL : </strong>
<br>
<em>http://omahbiasawae.com</em>
<br>
<em>http://hajirodeon.wordpress.com</em>
<br>
<br>

<strong>E-Mail : </strong>
<br>
<em>hajirodeon@yahoo.com, hajirodeon@gmail.com</em>
<br>
<br>

<strong>HP/SMS/WA/TELEGRAM : </strong>
<br>
081-829-88-54.
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<p align="right">
Salam,
<br>
<br>
<strong>Agus Muhajir, S.Kom</strong>
<br>
[<em>SISFO-TOKO Developer</em>].
</p>

<hr>
<input name="btnKLR" type="button" value="KELUAR >>" onClick="ajaxwin4.close();">
<hr>
<br>
</td>
</tr>
</table>
</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>