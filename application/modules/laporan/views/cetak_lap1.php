<section style="margin: 15px 15px 15px 15px">
            <div class="box-header">
                <br/>
                <h4 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h4>
                <h4 class="box-title"> PERIODE <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4)." , ". $comt_t." / ".$comt_ter;?></h4>
                <br/>
            </div>

            <table id="example1" class=" table table-bordered">
                <thead>
                <tr style="font-size: 9pt;text-align: right">
                  <th>Tanggal</th>
                  <?php foreach($trayek->result_array() as $r) { ?>
                  <th><?php echo $r['nama_trayek']."<br/>"."Rp ".number_format($r['tarif']);?></th>
                  <?php } ?>
                  <th >TOTAL</th>
                </tr>
                </thead>
                <tbody>
            <?php
               $no=1;
               foreach($list->result_array() as $row) { ?>
                <tr style="font-size: 8pt">
                  <td><?php echo $row['DAY']; ?></td>
                  <?php foreach($trayek->result_array() as $r) {
                    $ttl = $this->laporan_model->lap1($r['id_trayek'],$row['DAY'],$terminal);
                    if($ttl > 0) { $total = "Rp ".number_format($ttl); }
                    else { $total = '-'; }
                  ?>
                  <td style="text-align: right"><?php echo $total;?></td>
                  <?php } ?>
                  <td style="font-size: 8pt; background-color: #f4f4f4; color: black; font-weight: bold;text-align: right">
                      <?php      
                              $subtotal = $this->laporan_model->sum_lap_samping($row['DAY'], $trk, $terminal, 'total'); 
                              echo "Rp ".number_format($subtotal);
                 
                        ?>
                  </td>
                </tr>
                <?php $no++; } ?>               
                <tr style="font-size: 8pt; background-color: #f4f4f4; color: black; font-weight: bold;text-align: right">
                    <td>
                        <b>SUB TOTAL</b>
                    </td>
                        <?php   foreach($trayek->result_array() as $r) {
                                $subttl = $this->laporan_model->sum_lap1($this->uri->segment(3),$this->uri->segment(4),$r['id_trayek'],$terminal,"total");
                        ?>
                        <td><?php echo "Rp ".number_format($subttl);?></td>
                        <?php } ?>
                </tr>
                </tbody>
              </table>
</section>
