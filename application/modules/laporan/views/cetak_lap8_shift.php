<section style="margin: 15px 15px 15px 15px; font-family: calibri">
            <div class="box-header">
                <br/>
                <center><h4 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h4></center>
                <center><h4 class="box-title"> TANGGAL <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4).", ".$comt_ter." / ".$shift;?></h4></center>
                <br/><br/>
            </div>

            <div class="box-body table-responsive no-padding">
                              <table id="example1" class=" table table-bordered" style="font-family: calibri">
<thead>
                <tr style="font-size: 9pt">
                  <th>Tanggal</th>
                  <th>Petugas <br/> Penj.Tiket</th>
                  <?php foreach($trm->result_array() as $r) { ?>
                  <th><?php echo $r['nama_terminal'];?></th>
                  <?php } ?>
                  <th>SUBTOTAL</th>
                </tr>
                </thead>
                <tbody>
            <?php
               $no = 1; 
               foreach($list->result_array() as $rows) {
                  // echo $shifts."<br/>".$rows['DAY']."<br/>".$trk;
            ?> 
                <tr>
                        <td><b><?php echo $rows['DAY']; ?></b></td>
                </tr>                 
            <?php
               $counter_1 = $this->laporan_model->get_counter_lap8('1',$rows['DAY'],$trmnl);
               foreach($counter_1->result_array() as $row) {
               if($row['counter']) {$counter=$row['counter'];} else { $counter = "-";}
               if($row['trmnl']) {$terminal=$row['trmnl'];} else { $terminal = "-";}
            ?>
                <tr style="font-size: 8pt">
                  <td></td>
                  <td><?php echo $counter; ?></td>
                      <?php foreach($trm->result_array() as $r) { ?>
                  <td style="text-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap8($rows['DAY'],$row['created_by'], "qty", $shifts, $r['id_terminal']));?></p>
                        
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap8($rows['DAY'],$row['created_by'], "total", $shifts, $r['id_terminal']));?></p>
                  </td>
                  <?php } ?>
                  <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                               $subtotal_qty = $this->laporan_model->sum_lap8_samping($rows['DAY'], $row['created_by'], $shifts,'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap8_samping($rows['DAY'], $row['created_by'], $shifts,'total');
                              echo "<p>Rp ".number_format($subtotal)."</p>";
                              
                 
                        ?>
                  </td>
                </tr>
               <?php $no++; }} ?>
                 <tr style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                    <td colspan="2">
                <center><b>SUB TOTAL</b></center>
                    </td>
                        <?php   foreach($trm->result_array() as $r) {
                                $subttl = $this->laporan_model->sum_lap8_bawah($this->uri->segment(3),$this->uri->segment(4),$r['id_terminal'],$shifts,"total");
                                $subqty = $this->laporan_model->sum_lap8_bawah($this->uri->segment(3),$this->uri->segment(4),$r['id_terminal'],$shifts,"qty");
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
