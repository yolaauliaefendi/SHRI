<ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Laporan Rekapitulasi SHRI</li>
            </ol>

            <h1 class="page-header">Laporan Rekapitulasi Sensus Harian Rawat Inap</h1>
                        
            <div class="row">
                <div class="col-lg-12 ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-heading ui-sortable-handle">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Laporan Rekapitulasi SHRI</h4>
                        </div>

                        <div class="panel-body">
                                        <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" rowspan="2" data-orderable="false"><div align="center">No</div></th>
                                                    <th width="40%" rowspan="2" data-orderable="false">Jenis Pelayanan</th>
                                                    <th width="10%" rowspan="2" data-orderable="false">Jumlah TT</th>
                                                    <th colspan="6" data-orderable="false" style="text-align: center;">Perincian Tempat Tidur Per Kelas</th>
                                                </tr>
                                                <tr>
                                                    <th width="8%" data-orderable="false">VVIP</th>
                                                    <th width="8%" data-orderable="false">VIP</th>
                                                    <th width="8%" data-orderable="false">I</th>
                                                    <th width="8%" data-orderable="false">II</th>
                                                    <th width="8%" data-orderable="false">III</th>
                                                    <th width="8%" data-orderable="false">Kelas Khusus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("SELECT
  `tblruang_kelas`.`IDRuangKelas`,
  `tblruang_kelas`.`IDKelas`,
  `tbljenispelayanan`.`Nama`,
  `tblruang_kelas`.`JumlahTT`,
  Sum(`tblruang_kelas`.`JumlahTT`) AS `TotalTT`,
  `tblruang_kelas`.`IDRuangan`
FROM
  `tblruang_kelas`
  INNER JOIN `tblruangan` ON `tblruang_kelas`.`IDRuangan` =
`tblruangan`.`IDRuangan`
  INNER JOIN `tbljenispelayanan` ON `tblruangan`.`IDJenisPelayanan` =
`tbljenispelayanan`.`IDJenisPelayanan`
WHERE `tblruang_kelas`.`NA` = 'N'
GROUP BY
  `tblruang_kelas`.`IDRuangan`");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                            ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$vdat[Nama]?></td>
                                                    <td><?=$vdat[TotalTT]?></td>
                                                    <td>
                                                        <?php
                                                            $q1 = mysql_query("select * from tblruang_kelas where IDKelas=1 and IDRuangan = '$vdat[IDRuangan]'");
                                                            $v1 = mysql_fetch_array($q1);
                                                            if (isset($v1[JumlahTT])) {
                                                                echo $v1[JumlahTT];
                                                            }else{
                                                                echo "0";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $q2 = mysql_query("select JumlahTT from tblruang_kelas where IDKelas=2 and IDRuangan = '$vdat[IDRuangan]'");
                                                            $v2 = mysql_fetch_array($q2);

                                                            if (isset($v2[JumlahTT])) {
                                                                echo $v2[JumlahTT];
                                                            }else{
                                                                echo "0";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $q3 = mysql_query("select JumlahTT from tblruang_kelas where IDKelas=3 and IDRuangan = '$vdat[IDRuangan]'");
                                                            $v3 = mysql_fetch_array($q3);
                                                            if (isset($v3[JumlahTT])) {
                                                                echo $v3[JumlahTT];
                                                            }else{
                                                                echo "0";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $q4 = mysql_query("select JumlahTT from tblruang_kelas where IDKelas=4 and IDRuangan = '$vdat[IDRuangan]'");
                                                            $v4 = mysql_fetch_array($q4);
                                                            if (isset($v4[JumlahTT])) {
                                                                echo $v4[JumlahTT];
                                                            }else{
                                                                echo "0";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $q5 = mysql_query("select JumlahTT from tblruang_kelas where IDKelas=5 and IDRuangan = '$vdat[IDRuangan]'");
                                                            $v5 = mysql_fetch_array($q5);
                                                            if (isset($v5[JumlahTT])) {
                                                                echo $v5[JumlahTT];
                                                            }else{
                                                                echo "0";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $q6 = mysql_query("select JumlahTT from tblruang_kelas where IDKelas=6 and IDRuangan = '$vdat[IDRuangan]'");
                                                            $v6 = mysql_fetch_array($q6);
                                                            if (isset($v6[JumlahTT])) {
                                                                echo $v6[JumlahTT];
                                                            }else{
                                                                echo "0";
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                    </div>
                </div>
            </div>
