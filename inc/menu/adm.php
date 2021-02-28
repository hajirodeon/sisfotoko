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


//nilai
$maine = "$sumber/adm/index.php";


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<UL class="menulist" id="listMenuRoot">
<table bgcolor="#E4D6CC" width="100%" border="0" cellspacing="0" cellpadding="5">
<tr>
<td>';





//home //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<LI>
<a href="'.$maine.'" title="Home"><strong>Home</strong></a>
</LI>';





//setting ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<LI>
<A href="#"><strong>SETTING</strong>&nbsp;&nbsp;</A>
<UL>';

echo '<LI>
<a href="'.$sumber.'/adm/s/pass.php" title="Ganti Password">Ganti Password</a>
</LI>';

//jika admin, ada reset password untuk pengelola
if ($username1_session == "admin")
	{
	echo '<LI>
	<a href="'.$sumber.'/adm/s/pengelola_user.php" title="User Pengelola">User Pengelola</a>
	</LI>
	<LI>
	<a href="'.$sumber.'/adm/s/pembuat_nota.php" title="Pembuat Nota">Pembuat Nota</a>
	</LI>';
	}


echo '</UL>';



//jika user ADMIN, semua menu aktif
if ($username1_session == "admin")
	{
	//menu dan sub menu
	$qmn = mysqli_query($koneksi, "SELECT DISTINCT(no) FROM akses_menu");
	$rmn = mysqli_fetch_assoc($qmn);

	do
		{
		$nox = $nox + 1;

		//array menu
		$arrmn = array(
	       '1' => 'DATA',
	       '2' => 'STOCK',
		   '3' => 'PEMBELIAN',
		   '4' => 'PENJUALAN',
		   '5' => 'LAPORAN'
		);

		echo '<LI>
		<A href="#"><strong>'.$arrmn[$nox].'</strong>&nbsp;&nbsp;</A>
		<UL>';

		//sub menu
		$qmni = mysqli_query($koneksi, "SELECT * FROM akses_menu ".
								"WHERE no = '$nox' ".
								"ORDER BY no_sub ASC");
		$rmni = mysqli_fetch_assoc($qmni);

		do
			{
			$menu_pathx = $rmni['pathx'];
			$menu_filex = $rmni['filex'];
			$menu_judulx = $rmni['judul'];

			echo "<LI>
			<a href=\"$sumber$menu_pathx$menu_filex\" title=\"$menu_judulx\">$menu_judulx</a>
			</LI>";
			}
		while ($rmni = mysqli_fetch_assoc($qmni));


		echo '</UL>';
		}
	while ($rmn = mysqli_fetch_assoc($qmn));
	}

else //jika user biasa, menu tertentu yg telah di-set saja, yg bisa digunakan.
	{
	//menu dan sub menu
	$qmn = mysqli_query($koneksi, "SELECT DISTINCT(no) FROM akses_menu");
	$rmn = mysqli_fetch_assoc($qmn);

	do
		{
		$nox = $nox + 1;

		//array menu
		$arrmn = array(
	       '1' => 'DATA',
	       '2' => 'STOCK',
		   '3' => 'PEMBELIAN',
		   '4' => 'PENJUALAN',
		   '5' => 'LAPORAN'
		);

		echo '<LI>
		<A href="#"><strong>'.$arrmn[$nox].'</strong>&nbsp;&nbsp;</A>
		<UL>';

		//sub menu
		$qmni = mysqli_query($koneksi, "SELECT akses_admin.*, akses_menu.* ".
								"FROM akses_admin, akses_menu ".
								"WHERE akses_admin.kd_menu = akses_menu.kd ".
								"AND akses_admin.kd_admin = '$kd1_session' ".
								"AND akses_admin.status = 'true' ".
								"AND akses_menu.no = '$nox' ".
								"ORDER BY akses_menu.no_sub ASC");
		$rmni = mysqli_fetch_assoc($qmni);

		do
			{
			$menu_pathx = $rmni['pathx'];
			$menu_filex = $rmni['filex'];
			$menu_judulx = $rmni['judul'];

			echo "<LI>
			<a href=\"$sumber$menu_pathx$menu_filex\" title=\"$menu_judulx\">$menu_judulx</a>
			</LI>";
			}
		while ($rmni = mysqli_fetch_assoc($qmni));


		echo '</UL>';
		}
	while ($rmn = mysqli_fetch_assoc($qmn));
	}


echo '</td>
<td width="10%" align="right">
<LI>
<A href="'.$sumber.'/logout.php" title="Logout / KELUAR"><strong>LogOut</strong></A>
</LI>
</td>
</tr>
</table>

</UL>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>