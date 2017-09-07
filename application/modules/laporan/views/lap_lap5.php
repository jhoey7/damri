<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <center><h3 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h3></center>
                <center><h4 class="box-title"> TANGGAL <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4).", ".$comt_t." / ".$comt_ter." / ".$shift;?></h4></center>
                <br/><br/>
            </div>
            <!-- /.box-header -->
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
                <tr style="font-size: 9pt;">
                    
                    <td colspan='3' style="font-weight: bold;  background-color: #f3f3f3"><center>PAGI/ SHIFT I</center></td>
                </tr>
            <?php
               $counter_1 = $this->laporan_model->get_counter_lap5('1',$rows['DAY'],$grup,$trmnl);
               foreach($counter_1->result_array() as $row) {
               if($row['counter']) {$counter=$row['counter'];} else { $counter = "-";}
               if($row['trmnl']) {$terminal=$row['trmnl'];} else { $terminal = "-";}
               
               if($trmnl=='0') {$trmnal = $row['id_terminal'];} else { $trmnal = $trmnl; }
            ?>
                <tr style="font-size: 8pt">
                  <td></td>
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $terminal; ?></td>
                      <?php foreach($gr->result_array() as $r) { ?>
                  <td style="text-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap5($rows['DAY'], $r['id_grup'], $row['created_by'], "qty", "1",$trmnal));?></p>
                        
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap5($rows['DAY'], $r['id_grup'], $row['created_by'], "total", "1",$trmnal));?></p>
                  </td>
                  <?php } ?>
                  <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                               $subtotal_qty = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnal, $row['created_by'], "1",'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnal, $row['created_by'], "1",'total');
                              echo "<p>Rp ".number_format($subtotal)."</p>";
                              
                 
                        ?>
                  </td>
                </tr>
               <?php $no++; } ?>
                
                <!-- SHIFT II -->
                
                <tr style="font-size: 9pt;">
                 
                    <td colspan='3' style="font-weight: bold;  background-color: #f3f3f3"><center>SIANG/ SHIFT II</center></td>
                </tr> 
            <?php
               $counter_2 = $this->laporan_model->get_counter_lap5('2',$rows['DAY'],$grup,$trmnl);
               foreach($counter_2->result_array() as $row) {
               if($row['counter']) {$counter=$row['counter'];} else { $counter = "-";}
               if($row['trmnl']) {$terminal=$row['trmnl'];} else { $terminal = "-";}
              
               if($trmnl=='0') {$trmnal = $row['id_terminal'];} else { $trmnal = $trmnl; }
               
            ?>
                <tr style="font-size: 8pt">
                  <td></td>
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $terminal; ?></td>
                      <?php foreach($gr->result_array() as $r) { ?>
                  <td style="text-align: right">
                      <p><?php echo number_format($this->laporan_model->sum_lap5($rows['DAY'], $r['id_grup'], $row['created_by'], "qty", "2",$trmnal));?></p>
                        
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap5($rows['DAY'], $r['id_grup'], $row['created_by'], "total", "2",$trmnal));?></p>
                  </td>
                  <?php } ?>
                   <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                               $subtotal_qty = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnal, $row['created_by'], "2",'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnal, $row['created_by'], "2",'total');
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
                <br/><br/>
                <div class="col-xs-10">
                <button type="button" class="btn btn-primary" onclick="cetak_lap5()"><i class="fa fa-send"></i> Cetak </button>
                </div>
            </div>
            
            
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>