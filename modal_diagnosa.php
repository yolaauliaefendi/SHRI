                            <div class="modal fade" id="modal-dialog1">
                                <div class="modal-dialog" style="max-width:50%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Data Diagnosa</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                        <table id="lookup1" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="1%" data-orderable="false">No</th>
                                                    <th width="20%" data-orderable="false">Diagnosa</th>
                                                    <th width="10%" data-orderable="false">Kode Icd-10</th>
                                                    <th width="10%" data-orderable="false">Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $nz = 0;
                                                $sqlz = mysql_query("select * from tbldiagnosa where NA = 'N'");
                                                while ($vz = mysql_fetch_array($sqlz)) { $nz++;
                                            ?>
                                                <tr class="pilihPenyakit" data-idpenyakit="<?=$vz[IDDiagnosa]?>" data-nmpenyakit="<?=$vz[Nama]?>">
                                                    <td><?=$nz?></td>
                                                    <td><a href="#"><?=$vz[Nama]?></a></td>
                                                    <td><?=$vz[KodeICD]?></td>
                                                    <td><?=$vz[Deskripsi]?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>