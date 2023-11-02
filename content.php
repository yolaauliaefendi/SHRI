		<!-- begin #content -->
		<div id="content" class="content <?=$_GET[full]?>">
            <?php
            $fdm = 'modul/master';
            $fdl = 'modul/laporan';
            $fdt = 'modul/transaksi';
            $fd = 'modul';
            if(!empty($_GET['act'])){
                $p=$_GET['act'];
                include ($fd.'/'.$p.'.php');
            }
            elseif (!empty($_GET['actm'])) {
             	$p=$_GET['actm'];
                include ($fdm.'/'.$p.'.php');
            }
            elseif (!empty($_GET['actt'])) {
                $p=$_GET['actt'];
                include ($fdt.'/'.$p.'.php');
            }elseif (!empty($_GET['actl'])) {
                $p=$_GET['actl'];
                include ($fdl.'/'.$p.'.php');
            }
            else{
            	include ($fd.'/dashboard.php');
            }
            ?>
		</div>
		<!-- end #content -->