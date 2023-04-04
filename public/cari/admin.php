<div class="card">
						<!-- <div class="card-header">
							<h5 class="mb-0"><?= $title ?></h5>
						</div> -->

						<div class="">
                            <table class="table table-hover datatable-highlight">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Pengguna</th>
										<th>Jns. Kelamin</th>
										<th>HP</th>
										<th>Username</th>
										<th>Group</th>
										<th class="text-center">Act</th>
									</tr>
								</thead>
								<tbody class="datapencarian">
									<?php
                                        $nodata = 1;
                                        $sdata = $this->db->query("SELECT a.*, b.nm_jk, c.nm_agama, d.`nm_group` FROM users a LEFT JOIN jk b ON a.id_jk = b.id_jk LEFT JOIN agama c ON a.id_agama = c.id_agama LEFT JOIN `group` d ON a.`id_group` = d.`id_group` WHERE (a.nama LIKE '%".$hasil."%' OR a.email LIKE '%".$hasil."%' OR a.username LIKE '%".$hasil."%') ORDER BY a.nama ASC");
                                        
                                        foreach($sdata->result_array() as $ddata){
                                            $groupnya	= "";
											$group_ex	= explode(".",$ddata['groupdef']);
											$sgropx		= $this->db->get("group");
											foreach($sgropx->result_array() as $dgropx){
												if(in_array($dgropx['id_group'], $group_ex)){
													$groupnya	.= "<div class='fw-bold text-uppercase'>".$dgropx['nm_group']."</div>";
												}
											}
                                            
                                            if(!empty($ddata['gambar'])){
                                                $gambaru = base_url("berkas/user/".$ddata['gambar']);
                                            }else{
                                                $gambaru = base_url('assets/images/default.png');
                                            }
                                            echo"
                                                <tr>
                                                    <td class='text-center'>".$nodata.".</td>
                                                    <td class='fw-bold'><img src='".$gambaru."' class='w-40px h-40px rounded-pill mx-2' alt='...'> ".$ddata['nama']."</td>
                                                    <td>".$ddata['nm_jk']."</td>
                                                    <td>".$ddata['hp']."</td>
                                                    <td class='fw-bold'>".$ddata['username']."</td>
                                                    <td>".$groupnya."</td>
                                                    <td class='text-center'>
                                                        <a href='".base_url("users/admin/detail/".enkrip($ddata['no_user']))."' class='btn btn-dark' target='_blank'>
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