<section style="margin: 15px 15px 15px 15px; font-family: calibri">
            <div class="box-header">
                <br/>
                <h4 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h4>
                <h4 class="box-title"> TANGGAL <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4);?>, Semua Terminal/Semua Counter/Semua Kasir</h4>
                <br/>
            </div>
            <div class="box-body table-responsive no-padding">
                <table id="example1" class=" table table-bordered" style="font-family: calibri">
                <thead>
                <tr style="font-size: 8pt; background-color: #f4f4f4; color: black">
                  <th>No</th>
                  <th>POOL</th>
                  <?php foreach($this->member_model->getMasterFilter('trayek','deleted_at IS NULL','id_trayek','asc')->result_array() as $r) { ?>
                  <th><?php echo $r['nama_trayek']."<br/>"."Rp ".number_format($r['tarif']);?></th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
            <?php
               $no=1;
               foreach($pool->result_array() as $row) {
            ?>
                <tr style="font-size: 8pt">
                  <td><?php echo $no;?></td>
                  <td style="text-transform: uppercase"><?php echo $row['nama_pool']; ?></td>
                      <?php foreach($this->member_model->getMasterFilter('trayek','deleted_at IS NULL','id_trayek','asc')->result_array() as $r) { ?>
                  <td style="tet-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap3($tgl_awal, $tgl_akhir, $r['id_trayek'],$row['id_pool'], "qty"));?></p>
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap3($tgl_awal, $tgl_akhir, $r['id_trayek'], $row['id_pool'], "total"));?></p>
                  </td>
                  <?php } ?>
                </tr>
                <?php $no++; } ?>                
                <tr style="font-size: 8pt; background-color: #f4f4f4; color: black; font-weight: bold">
                    <td colspan="2">
                        <b>SUB TOTAL</b>
                    </td>
                        <?php   foreach($this->member_model->getMasterFilter('trayek','deleted_at IS NULL','id_trayek','asc')->result_array() as $r) {
                                $subttl = $this->laporan_model->sum_lap1($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],"total");
                                $subqty = $this->laporan_model->sum_lap1($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],"qty");
                        ?>
                    <td>
                        <p><?php echo number_format($subqty);?></p>
                        <p><?php echo "Rp ".number_format($subttl);?></p>
                    </td>
                        <?php } ?>
                </tr>
                
                </tbody>
              </table>
            </div>
</section>
