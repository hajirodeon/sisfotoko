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
$filenya = "faq.php";
$judul = "F.A.Q";



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
<strong>F.A.Q</strong>
</font>
</big>
<hr>
</p>

<p>
<strong>Apa Itu SISFO-TOKO ?</strong>
<br>
SISFO-TOKO adalah Sistem Informasi manajemen Toko, yang mempunyai konsep OPEN SOURCE berdasarkan pada FREEDOM SOFTWARE dengan layanan berbayar (komersial).
</p>

<p>
<strong>FREE SOFTWARE tidak sama dengan FREEWARE(Gratis)</strong>
<br>
FREE SOFTWARE yang juga sering disebut FREEDOM SOFTWARE, tidak punya arti yang sama maupun ada kaitan dengan FREEWARE(Gratis).
Kata \'FREE\' disini lebih ditekankan pada \'FREEDOM\' atau \'Bebas\'. Kebebasan ini lebih dari sekedar FREEWARE atau gratis,
tapi juga kebebasan dalam lisensi, kebebasan dalam mengembangkan lagi, kebebasan dalam modifikasi,
kebebasan dalam duplikasi dan distribusi, dan sebagainya.
Silahkan lihat bagian FILOSOFI.

</p>
<p>
<strong>Lisensi Apa Yang Dianut ?</strong>
<br>
Yang kami anut adalah GNU/GPL Version 2, June 1991.
</p>

<p>
<strong>Seperti Apa Sistem Informasinya ?</strong>
<br>
Sistem informasi ini berbasis Web. Menggunakan teknologi PHP dengan database MySQL. Sehingga untuk instalasi dan menjalankannya
dibutuhkan sebuah 	Web Server seperti Apache yang telah ter-Plugin PHP, MySQL Server dan PhpMyAdmin untuk meng-Import Database-nya.
Karena berbasis Web, sehingga bisa 	dipasang pada berbagai jenis Sistem Operasi. Yang pasti harus menggunakan sebuah browser seperti
FireFox, IE atau lainnya.
</p>

<p>
<strong>Apakah Ini Program Jadi ?</strong>
<br>
Kami tidak pernah menyediakan atau menyebut proyek - proyek atau hasil karya yang ada disini adalah program atau produk jadi. Sebab
yang ada disini adalah segala hal yang masih dimungkinkan untuk dikembangkan secara terus - menerus. Pengembangan tersebut tidak
hanya dilakukan oleh kami saja, tapi Anda pun bisa mengembangkan sendiri. Kecuali jika Anda kesulitan untuk mengembangkan lebih lanjut,
atau ada spesifikasi khusus yang perlu ditambahkan (kastumisasi), maka pengerjaan tersebut akan dikenakan biaya, yang kesepakatannya bisa dibicarakan lebih lanjut.
</p>

<p>
<strong>Bagaimana Jika Ada Yang Menginginkan Spesifikasi Khusus atau Kastumisasi ?</strong>
<br>
Bagi yang punya keinginan seperti ini, berarti telah menganggap proyek - proyek disini adalah suatu sampel. Karena membutuhkan
spesifikasi khusus, kami bisa mempertimbangkannya. Tentu saja akan dikenai dengan biaya kastumisasi, yang besarnya sesuai
dengan kesepakatan.
</p>

<p>
<strong>Apakah Tidak Merusak Tatanan Usaha Software Lainnya ?</strong>
<br>
Menurut kami, kami tidak merusak tatanan yang ada. Walau konsep kami terasa ekstrem bagi kalangan pengusaha <em>software</em> di Indonesia,
tapi kami telah mengambil pilihan. Sebab rejeki dan gaya bisnis memang mempunyai jalur yang berbeda - beda.
Lisensi <em>software</em> pun bermacam - macam, jadi ini adalah salah satu dari beragam pilihan yang bisa dipilih oleh para
konsumen/netter/pemakai. Jikalau memang tidak menyukai yang FREE SOFTWARE, Anda pun bisa mengambil layanan kastumisasi untuk
kebutuhan sendiri yang tentunya akan memberikan kepuasan tersendiri. Dan bila Anda tidak menyukai proyek - proyek yang ada disini,
Anda bisa beralih ke tempat lain tanpa ada beban dan tanggungan dari kami.
</p>

<p>
<strong>Bagaimana Donasinya ?</strong>
<br>
Anda dapat melakukan Donasi/Sumbangan, jika ternyata produk kami tersebut, terasa sangat membantu, bermanfaat dan percaya kepada kami.
Khususnya bagi mereka yang menerapkan SISFO-TOKO pada suatu Usaha Toko yang bersangkutan dan berhasil. Donasi sekitar Rp. 500.000,00
(LIMA RATUS RIBU RUPIAH). Pada dasarnya, donasi ini hanyalah untuk kepentingan kelangsungan <em>project idealist</em> ini.
<br>
<br>
Kirimkan donasi tersebut via rekening :
<br>
<br>
<font color="blue">
<em>
BANK MANDIRI Cab. PEMUDA Semarang,
<br>
A/N : AGUS MUHAJIR,
<br>
No. Rek : 135-00-0403665-1.
</em>
</font>
<br>
<br>
Bila donasi telah dikirim, segeralah konfirmasi via email : hajirodeon@yahoo.com, hajirodeon@gmail.com atau HP/SMS : (081)829-88-54.
</p>

<p>
<strong>Untuk Apa Donasi Tersebut ?</strong>
<br>
Donasi yang ada akan digunakan untuk segala kebutuhan pengembangan Sistem Informasi dan biaya operasional lainnya.
</p>

<p>
<strong>Apa Saja Layanannya ?</strong>
<br>
<ul>
<li>
<strong>Kastumisasi</strong>. Suatu perubahan pada konten yang tidak menyeluruh (bukan dalam tahap pembuatan total atau dari awal),
dikarenakan penyesuaian sedikit dengan sistem manual/tradisional/nonkomputer yang ada. Dikenakan biaya sebesar
Rp. 3.000.000,00 (TIGA JUTA RUPIAH). Pengerjaan selama 1(SATU) bulan. Pembayaran 2(DUA) kali. Pekerjaan dan revisi dikirimkan via email
tiap minggu, sampai selesai. Garansi 6(ENAM) bulan.
</li>
</ul>
</p>

<p>
<strong>Jikalau Tidak Menyukai Layanan Yang Ada, Bagaimana ?</strong>
<br>
Kami berusaha untuk memberikan kepuasan pelanggan semaksimal mungkin, tapi jikalau kondisinya sudah berubah dan apa yang kami lakukan
tidak bisa memberikan porsi yang optimal, maka Anda bisa mempercayakan kepada pengusaha <em>software</em> lain atau rekan lain yang
bisa memenuhi harapan Anda.
</p>

<p>
<strong>Kapan Suatu Versi Terbaru Diturunkan ?</strong>
<br>
Setiap aplikasi atau sistem informasi, tentu melalui tahap penyempurnaan terus - menerus. Versi terbaru segera diturunkan setelah
mendapatkan masukan, saran dan laporan bugs dari para pemakai. Rilis rutin sekitar tiap tahun sekali.
</p>

<p>
<strong>Sampai Kapan Proyek Ini Berakhir ?</strong>
<br>
Proyek ini tidak akan pernah berakhir, akan berjalan terus. Bahkan akan selalu bermunculan inovasi - inovasi baru.
</p>

<p>
<strong>Apa Target Yang Ingin Dicapai atau cita - citanya ?</strong>
<br>
Kami mempunyai target atau cita - cita agar semua pengguna komputer baik untuk kebutuhan perseorangan maupun kelompok, dalam
penggunaan rumahan sampai dengan instansi formal maupun tidak formal, menggunakan Sistem Informasi OPEN SOURCE yang berdasarkan
pada FREE SOFTWARE.
</p>

<p>
<strong>Mungkinkah Suatu Saat Tidak Gratis Lagi ?</strong>
<br>
Tidak. Selamanya <em>project - project</em> yang ada disini adalah gratis dan bebas.
Yang tidak gratis dan tidak bebas, hanyalah pada layanan dan kastumisasi.
</p>

<hr>
<input name="btnKLR" type="button" value="KELUAR >>" onClick="ajaxwin3.close();">
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