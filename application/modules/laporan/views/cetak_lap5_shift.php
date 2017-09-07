<section style="margin: 15px 15px 15px 15px; font-family: calibri">
            <div class="box-header">
                <br/>
                <center><h4 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h4></center>
                <center><h4 class="box-title"> TANGGAL <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4).", ".$comt_t." / ".$comt_ter." / ".$shift;?></h4></center>
                <br/>
            </div>

            <div class="box-body table-responsive no-padding">
                <table id="example1" class=" table table-bordered" style="font-family: calibri">
                <thead>
                <tr style="font-size: 9pt">
                  <th>Tanggal</th>
                  <th>Petugas <br/> Penj.Tiket</th>
                  <th>Terminal</th>
                  <?php foreach($gr->result_array() as $r) { ?>
                  <th><?php echo $r['nama_grup']."<br/>"."Rp ".number_format($r['tarif']);?></th>
                  <?php } ?>
                  <th style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold">SUBTOTAL</th>
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
               $counter_1 = $this->laporan_model->get_counter_lap5($shifts,$rows['DAY'],$grup,$trmnl);
               foreach($counter_1->result_array() as $row) {
               if($row['counter']) {$counter=$row['counter'];} else { $counter = "-";}
               if($row['trmnl']) {$terminal=$row['trmnl'];} else { $terminal = "-";}
               
               if($trmnl=='0') {$trmnal = $row['id_terminal'];} else { $trmnal = $trmnl; }
            ?>
                <tr style="font-size: 8pt">
                  <td></td>
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $terminal; ?></td>
                      <?php foreach($gr->result_array() as $r) { 
                      
                          $total_qty = $this->laporan_model->sum_lap5($rows['DAY'], $r['id_grup'], $row['created_by'], "qty", $shifts,$trmnal);
                          $total = $this->laporan_model->sum_lap5($rows['DAY'], $r['id_grup'], $row['created_by'], "total", $shifts,$trmnal);
                      ?>
                  <td style="text-align: right">
                      <p><?php echo number_format($total_qty);?></p>
                        
                      <p><?php echo "Rp".number_format($total);?></p>
                  </td>
                  <?php } ?>
                  <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                               $subtotal_qty = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnal, $row['created_by'], $shifts,'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnal, $row['created_by'], $shifts,'total');
                              echo "<p>Rp ".number_format($subtotal)."</p>";
                              
                 
                        ?>
                  </td>
                </tr>
               <?php $no++; }} ?>

                <tr style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                    <td colspan="3">
                <center><b>SUB TOTAL</b></center>
                    </td>
                        <?php   foreach($gr->result_array() as $r) {
                                $subttl = $this->laporan_model->sum_lap5_bawah($this->uri->segment(3),$this->uri->segment(4),$r['id_grup'],$trmnl,$shifts,"total");
                                $subqty = $this->laporan_model->sum_lap5_bawah($this->uri->segment(3),$this->uri->segment(4),$r['id_grup'],$trmnl,$shifts,"qty");
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
