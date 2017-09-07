<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <center><h3 class="box-title"><b>REKAP SETORAN DINAS COUNTER TERMINAL BANDARA</b></h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="example1" class=" table table-bordered" style="font-family: calibri">
                <thead>
                <tr style="font-size: 9pt">
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
                </tbody>
              </table>
                <br/><br/>
                <div class="col-xs-10">
                <button type="button" class="btn btn-primary" onclick="cetak_lap3()"><i class="fa fa-send"></i> Cetak </button>
                </div>
            </div>
            
            
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>