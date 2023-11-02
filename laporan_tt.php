            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="?act=dashboard&actv=d">Home</a></li>
                <li class="breadcrumb-item active">Laporan Tempat Tidur</li>
            </ol>

            <h1 class="page-header">Laporan Tempat Tidur</h1>
                        
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
                            <h4 style="color: inherit; font-size: 12px; line-height: 20px; margin-bottom: 0; margin-top: 0;">Laporan Tempat Tidur</h4>
                        </div>

                        <div class="panel-body">
                            <table id="data-table-default" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">No</th>
                                                    <th width="20%" data-orderable="false">Kamar</th>
                                                    <th width="20%" data-orderable="false">Kelas</th>
                                                    <th width="20%" data-orderable="false">Jumlah TT</th>
                                                    <th width="20%" data-orderable="false">Jumlah TT Pakai</th>
                                                    <th width="20%" data-orderable="false">Jumlah TT Kosong</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                $sqld = mysql_query("SELECT
  `tblruang_kelas`.`IDRuangKelas`,
  `tblruang_kelas`.`IDRuangan`,
  `tblruangan`.`NamaRuangan`,
  `tblruang_kelas`.`IDKelas`,
  `tblkelas`.`NamaKelas`,
  `tblruang_kelas`.`JumlahTT`,
  `tblruang_kelas`.`Jml_TTPakai`,
  `tblruang_kelas`.`NA`,
    `tblruang_kelas`.`JumlahTT` - `tblruang_kelas`.`Jml_TTPakai` as TTKosong
FROM
  `tblruang_kelas`
  INNER JOIN `tblruangan` ON `tblruangan`.`IDRuangan` =
`tblruang_kelas`.`IDRuangan`
  INNER JOIN `tblkelas` ON `tblruang_kelas`.`IDKelas` = `tblkelas`.`IDKelas`");
                                                while ($vdat = mysql_fetch_array($sqld)) { $no++;
                                            ?>
                                                <tr <?php if ($vdat[NA] == "Y") { echo 'style="color: red"'; } ?>>
                                                    <td><?=$no?></td>
                                                    <td><?=$vdat[NamaRuangan]?></td>
                                                    <td><?=$vdat[NamaKelas]?></td>
                                                    <td><?=$vdat[JumlahTT]?></td>
                                                    <td><?=$vdat[Jml_TTPakai]?></td>
                                                    <td><?=$vdat[TTKosong]?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>  
                        </div>
                    </div>
                </div>
            </div>
