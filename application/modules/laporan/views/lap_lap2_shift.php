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
                <tr style="font-size: 8pt">
                  <th>Tanggal</th>
                  <th>Petugas <br/> Penj.Tiket</th>
                  <th>Terminal</th>
                  <?php foreach($trayek->result_array() as $r) { ?>
                  <th><?php echo $r['nama_trayek']."<br/>"."Rp ".number_format($r['tarif']);?></th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
            <?php
               $no = 1; 
               foreach($list->result_array() as $rows) {
                  // echo $shifts."<br/>".$rows['DAY']."<br/>".$trk;
            ?> 
                <tr>
                        <td style="text-align:center"><b><?php echo $rows['DAY']; ?></b></td>
                </tr> 
            <?php
               $counter_1 = $this->laporan_model->get_counter($shifts,$rows['DAY'],$trk,$trmnl);
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
                      <p><?php echo number_format($this->laporan_model->sum_lap2($rows['DAY'], $r['id_trayek'], $shifts, 'qty', $row['created_by'], $trmnl));?></p>
                        
                      <p><?php echo "Rp".number_format($this->laporan_model->sum_lap2($rows['DAY'], $r['id_trayek'], $shifts, 'total', $row['created_by'], $trmnl));?></p>
                  </td>
                  <?php } ?>
                  <td style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                      <?php      
                               $subtotal_qty = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnl, $row['created_by'], $shifts,'qty');
                              echo "<p>Rp ".number_format($subtotal_qty)."</p>";
                              $subtotal = $this->laporan_model->sum_lap2_samping($rows['DAY'], $trmnl, $row['created_by'], $shifts,'total');
                              echo "<p>Rp ".number_format($subtotal)."</p>";
                              
                 
                        ?>
                  </td>
                </tr>
               <?php $no++; }} ?>
                            <tr style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                    <td colspan="3">
                <center><b>SUB TOTAL</b></center>
                    </td>
                        <?php   foreach($trayek->result_array() as $r) {
                                $subttl = $this->laporan_model->sum_lap2_bawah($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],$trmnl,$shifts,"total");
                                $subqty = $this->laporan_model->sum_lap2_bawah($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],$trmnl,$shifts,"qty");
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
                <button type="button" class="btn btn-primary" onclick="cetak_lap2_shift()"><i class="fa fa-send"></i> Cetak </button>
                </div>
            </div>
            
            
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>