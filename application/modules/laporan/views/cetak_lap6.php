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
                <tr style="font-size: 9pt">
                  <th>No</th>
                  <th>Petugas <br/> Penj.Tiket</th>
                  <th>Terminal</th>
                  <?php foreach($this->member_model->getMasterFilter('pool_grup','deleted_at IS NULL','id_grup','asc')->result_array() as $r) { ?>
                  <th><?php echo $r['nama_grup']."<br/>"."Rp ".number_format($r['tarif']);?></th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                <tr style="font-size: 9pt; font-weight: bold;  background-color: #b8b8b8">
                   <td colspan="4"><center>PAGI/ SHIFT I</center></td>
                </tr>
            <?php
               $no=1;
               foreach($counter_1->result_array() as $row) {
            ?>
                <tr style="font-size: 8pt">
                  <td><?php echo $no;?></td>
                  <td><?php echo $row['counter']; ?></td>
                  <td><?php echo $row['trmnl']; ?></td>
                      <?php foreach($this->member_model->getMasterFilter('pool_grup','deleted_at IS NULL','id_grup','asc')->result_array() as $r) { ?>
                  <td style="tet-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap5($tgl_awal, $tgl_akhir, $r['id_grup'], $row['id_counter'], "qty","1"));?></p>
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap5($tgl_awal, $tgl_akhir, $r['id_grup'], $row['id_counter'], "total","1"));?></p>
                  </td>
                  <?php } ?>
                </tr>
                <?php $no++; } ?>
                
                <!-- SHIFT II -->
                
                <tr style="font-size: 9pt; font-weight: bold;  background-color: #b8b8b8">
                   <td colspan="4"><center>SIANG/ SHIFT II</center></td>
                </tr>
            <?php
               $no=1;
               foreach($counter_2->result_array() as $row) {
            ?>
                <tr style="font-size: 8pt">
                  <td><?php echo $no;?></td>
                  <td><?php echo $row['counter']; ?></td>
                  <td><?php echo $row['trmnl']; ?></td>
                      <?php foreach($this->member_model->getMasterFilter('pool_grup','deleted_at IS NULL','id_grup','asc')->result_array() as $r) { ?>
                  <td style="tet-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap5($tgl_awal, $tgl_akhir, $r['id_grup'], $row['id_counter'], "qty","2"));?></p>
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap5($tgl_awal, $tgl_akhir, $r['id_grup'], $row['id_counter'], "total","2"));?></p>
                  </td>
                  <?php } ?>
                </tr>
                <?php $no++; } ?>
                <tr style="font-size: 8pt; background-color: #f4f4f4; color: black">
                    <td colspan="3">
                        <center><b>SUB TOTAL</b></center>
                    </td>
                        <?php   foreach($this->member_model->getMasterFilter('pool_grup','deleted_at IS NULL','id_grup','asc')->result_array() as $r) {
                                $subttl = $this->laporan_model->ttl_lap5($this->uri->segment(3),$this->uri->segment(4),$r['id_grup'],"total");
                                $subqty = $this->laporan_model->ttl_lap5($this->uri->segment(3),$this->uri->segment(4),$r['id_grup'],"qty");
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
