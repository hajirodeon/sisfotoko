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
$filenya = "filosofi.php";
$judul = "Filosofi";



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
<strong>Filosofi</strong>
</font>
</big>
<hr>
</p>

<p>
<ul>
<li>
Setiap pengguna komputer, seharusnya mendapat kebebasan untuk menjalankan, meng-<em>copy</em>, mendistribusikan, mempelajari, berbagi, melakukan
perubahan dan meningkatkan <em>software</em> mereka untuk banyak tujuan, tanpa harus membayar lisensi.
</li>
<br>

<li>
Setiap pengguna komputer, seharusnya diberikan kesempatan yang sama untuk menggunakan <em>software</em>, meskipun mereka bekerja dalam kondisi
ketidakmampuan, keterpurukan, kegagalan atau cacat.
</li>
<br>

<li>
Setiap pengguna komputer, seharusnya tahu dan mengerti tentang makna dari <em>Copyleft</em> dan <em>GNU/GPL</em>.
</li>
<br>

<li>
Setiap pengguna komputer, seharusnya tahu dan mengerti bahwa ilmu pengetahuan adalah milik bersama. Dan tidak akan berkurang walau telah
diberikan kepada siapapun, justru pengetahuan akan semakin bertambah.
</li>
<br>

<li>
Setiap pengguna komputer, seharusnya tahu dan mengerti bahwa dengan mengamalkannya secara ikhlas, berarti termasuk Ibadah.
</li>
</ul>
</p>


<hr>
<input name="btnKLR" type="button" value="KELUAR >>" onClick="ajaxwin1.close();">
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