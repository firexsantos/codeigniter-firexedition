<div class="card">
						<!-- <div class="card-header">
							<h5 class="mb-0"><?= $title ?></h5>
						</div> --><div class="">
                            <table class="table table-hover datatable-highlight">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Nama Personel</th>
										<th>NIK</th>
										<th>Jenis Keterampilan SKA/SKT</th>
										<th>Nomor Registrasi SKA/SKT</th>
										<th class="text-center">Act</th>
									</tr>
								</thead>
								<tbody class="datapencarian">
									<?php
                                        $nodata = 1;
                                        $sdata = $this->db->query("SELECT a.* FROM pekerjaan_ta a LEFT JOIN pekerjaan b ON a.no_pekerjaan = b.no_pekerjaan WHERE b.status = 'final' AND (a.nm_ta LIKE '%".$hasil."%' OR a.nik LIKE '%".$hasil."%' OR a.noreg LIKE '%".$hasil."%')");
                                        foreach($sdata->result_array() as $ddata){
                                            echo"
                                                <tr>
                                                    <td class='text-center'>".$nodata.".</td>
                                                    <td>".$ddata['nm_ta']."</td>
                                                    <td>".$ddata['nik']."</td>
                                                    <td>".$ddata['jns_keterampilan']."</td>
                                                    <td>".$ddata['noreg']."</td>
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