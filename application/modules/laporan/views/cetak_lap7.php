<section style="margin: 15px 15px 15px 15px; font-family: calibri; width:30%">
            <div class="box-header">
                <center><h4 class="box-title"><b>DAMRI BASOETTA</b></h4></center>
                <center><h4 class="box-title"><b>PENJUALAN REKAP</b></h4></center>
                <center><h5 class="box-title"> TANGGAL <?php echo $this->uri->segment(3). " S/D ".$this->uri->segment(4).", ".$comt_ter." / ".$shift;?></h5></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="example1" class=" table table-bordered" style="font-family: calibri">
                <thead>
                <tr style="font-size: 9pt">
                  <th>TRAYEK</th>
                  <th>QTY</th>
                  <th>TARIF</th>
                  <th>NILAI</th>
                </tr>
                </thead>
                <tbody>

            <?php
               $no=1;
               foreach($dk->result_array() as $row) {
            ?>
                <tr>
                    <td><b><?php echo $row['nama_grup'];?></b></td>  
                </tr>
            <?php 
                $id = $row['id_grup'];
               
                $trayek = $this->laporan_model->lap7($tgl_awal,$tgl_akhir,$id,$where);
                foreach($trayek->result_array() as $r) {
                    $ttl = $r['qty']*$r['tarif'];
                    $subtotal+=$ttl;
            ?>
                <tr style="font-size: 8pt">
                  <td><?php echo $r['nama_trayek'];?></td>
                  <td style="text-align: right"><?php echo $r['qty']; ?></td>
                  <td style="text-align: right"><?php echo number_format($r['tarif']); ?></td>
                  <td style="text-align: right"><?php echo "Rp ".number_format($ttl); ?></td>
                </tr>
                <?php $no++;}  }?>
                <tr style="font-size: 8pt; background-color: #f9f8f8; color: #666666; font-weight: bold;text-align: right">
                    <td >SUBTOTAL</td>
                    <td style="text-align: right"><?php echo "Rp ".number_format($subtotal);?></td>
                </tr>
                </tbody>
              </table>
            </div>

</section>
