<section style="margin: 15px 15px 15px 15px; font-family: calibri">
            <div class="box-header">
                <br/>
                <center><h4 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h4></center>
                <center><h4 class="box-title"> TANGGAL <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4).", ".$comt_t." / ".$comt_ter." / ".$shift;?></h4></center>
                <br/><br/>
            </div>

            <div class="box-body table-responsive no-padding">
<table id="example1" class=" table table-bordered" style="font-family: calibri">
                <thead>
                <tr style="font-size: 9pt">
                  <th>Tanggal</th>
                  <th>Petugas <br/> Penj.Tiket</th>
                  <th>Terminal</th>
                  <?php foreach($trayek->result_array() as $r) { ?>
                  <th><?php echo $r['nama_trayek']."<br/>"."Rp ".number_format($r['tarif']);?></th>
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
                        <td colspan="2"><b><?php echo $rows['DAY']; ?></b></td>
                </tr>                 
                <tr style="font-size: 9pt;">
                    
                    <td colspan="3" style="font-weight: bold;  background-color: #f3f3f3"><center>PAGI/ SHIFT I</center></td>
                </tr>
            <?php
               $counter_1 = $this->laporan_model->get_counter('1',$rows['DAY'],$trk,$trmnl);
               foreach($counter_1->result_array() as $row) {
               if($row['counter']) {$counter=$row['counter'];} else { $counter = "-";}
               if($row['trmnl']) {$terminal=$row['trmnl'];} else { $terminal = "-";}
            ?>
                <tr style="font-size: 8pt">
                  <td></td>
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $terminal; ?></td>
                      <?php foreach($trayek->result_array() as $r) { ?>
                  <td style="text-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap2($rows['DAY'], $r['id_trayek'], '1', 'qty', $row['created_by'],$trmnl));?></p>
                        
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap2($rows['DAY'], $r['id_trayek'], '1', 'total', $row['created_by'],$trmnl));?></p>
                  </td>
                  <?php } ?>
                <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                              $subtotal_qty = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnl, $row['created_by'], "1",'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnl, $row['created_by'], "1",'total');
                              echo "<p>Rp ".number_format($subtotal)."</p>";
                              
                 
                        ?>
                  </td>
                </tr>
               <?php $no++; } ?>
                
                <!-- SHIFT II -->
                
                <tr style="font-size: 9pt;">
                   
                    <td colspan="3" style="font-weight: bold;  background-color: #f3f3f3"><center>SIANG/ SHIFT II</center></td>
                </tr> 
            <?php
               $counter_2 = $this->laporan_model->get_counter('2',$rows['DAY'],$trk,$trmnl);
               foreach($counter_2->result_array() as $row) {
               if($row['counter']) {$counter=$row['counter'];} else { $counter = "-";}
               if($row['trmnl']) {$terminal=$row['trmnl'];} else { $terminal = "-";}
            ?>
                <tr style="font-size: 8pt">
                  <td></td>
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $terminal; ?></td>
                      <?php foreach($trayek->result_array() as $r) { ?>
                  <td style="text-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap2($rows['DAY'], $r['id_trayek'], '2', 'qty', $row['created_by'],$trmnl));?></p>
                        
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap2($rows['DAY'], $r['id_trayek'], '2', 'total', $row['created_by'],$trmnl));?></p>
                  </td>
                  <?php } ?>
                <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                              $subtotal_qty = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnl, $row['created_by'], "2",'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnl, $row['created_by'], "2",'total');
                              echo "<p>Rp ".number_format($subtotal)."</p>";
                              
                 
                        ?>
                  </td>                 
                </tr>
               <?php $no++; }} ?>
                <tr style="font-size: 8pt; background-color: #f4f4f4; color: black;text-align: right">
                    <td colspan="3">
                <center><b>SUB TOTAL</b></center>
                    </td>
                        <?php   foreach($trayek->result_array() as $r) {
                                $subttl = $this->laporan_model->sum_lap1($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],$trmnl,"total");
                                $subqty = $this->laporan_model->sum_lap1($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],$trmnl,"qty");
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
