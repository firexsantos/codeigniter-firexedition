<div class="card">
						<!-- <div class="card-header">
							<h5 class="mb-0"><?= $title ?></h5>
						</div> -->

						<div class="">
                            <table class="table table-hover datatable-highlight">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Penyedia</th>
										<th>Nama Pekerjaan</th>
										<th>Tahun Anggaran</th>
										<th>Perangkat Daerah</th>
										<!-- <th>Jenis Pekerjaan</th> -->
										<th>Metode Pemilihan</th>
										<!-- <th>Waktu Pelaksanaan</th>
										<th>Tgl. Kontrak</th> -->
										<th class="text-center">Act</th>
									</tr>
								</thead>
								<tbody class="datapencarian">
									<?php
                                        $nodata = 1;
                                        $sdata = $this->db->query("SELECT a.*, b.`nm_opd`, c.`nm_modpilih`, d.`nm_pekerjaanjns` FROM pekerjaan a LEFT JOIN opd b ON a.`id_opd` = b.`id_opd` LEFT JOIN modpilih c ON a.`id_modpilih` = c.`id_modpilih` LEFT JOIN pekerjaanjns d ON a.`id_pekerjaanjns` = d.`id_pekerjaanjns` WHERE a.status = 'final' AND (a.nm_penyedia LIKE '%".$hasil."%' OR a.nm_pekerjaan LIKE '%".$hasil."%') ORDER BY a.no_pekerjaan DESC");
                                        
                                        foreach($sdata->result_array() as $ddata){
                                            echo"
                                                <tr>
                                                    <td class='text-center'>".$nodata.".</td>
                                                    <td>".$ddata['nm_penyedia']."</td>
                                                    <td>".$ddata['nm_pekerjaan']."</td>
                                                    <td>".$ddata['tahun']."</td>
                                                    <td>".$ddata['nm_opd']."</td>
                                                    <!--<td>".$ddata['nm_pekerjaanjns']."</td>-->
                                                    <td>".$ddata['nm_modpilih']."</td>
                                                    <!--<td>".$ddata['waktu_pekerjaan']." Hari Kalender</td>
                                                    <td>".tgl_indo($ddata['tgl_kontrak'])."</td>-->
                                                    <td class='text-center'>
                                                        <a href='".base_url("pekerjaan/detail/".enkrip($ddata['no_pekerjaan']))."' class='btn btn-dark' target='_blank'>
                                                            <i class='ph-eye me-2'></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            ";
                                            $nodata++;
                                        }
                                    ?>
								</tbody>
							</table>
						</div>
					</div>