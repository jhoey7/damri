<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <center><h3 class="box-title"><b>LAPORAN RUPIAH PENJUALAN COUNTER di BANDARA Dan TERMINAL LUAR</b></h3></center>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="example1" class=" table table-bordered" style="font-family: calibri;">
                <thead>
                <tr style="font-size: 10pt">
                  <th>No</th>
                  <th>URAIAN</th>
                  <th>PEMASUKAN</th>
                  <th>PENGELUARAN</th>
                </tr>
                </thead>
                <tbody>
            <?php
               $no=1;
               $ttl = 0;
               foreach($pool->result_array() as $row) {
                   $total = $this->laporan_model->sum_lap4($tgl_awal, $tgl_akhir, $row['id_pool'], "total");
                   $ttl+=$total;
            ?>
                <tr style="font-size: 10pt">
                  <td><?php echo $no;?></td>
                  <td style="text-transform: uppercase"><?php echo $row['nama_pool']; ?></td>
                  <td style="text-align: right;"><?php echo "Rp ".number_format($total);?></td>
                  <td><?php echo "";?></td>
                </tr>
                <?php $no++; } ?>
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold">TOTAL</td>
                    <td style="text-align: right; font-weight: bold"><?php echo "Rp ".number_format($ttl);?></td>
                    <td style="text-align: right; font-weight: bold"><?php echo "";?></td>
                </tr>
                </tbody>
              </table>
                <br/><br/>
                <div class="col-xs-10">
                <button type="button" class="btn btn-primary" onclick="cetak_lap4()"><i class="fa fa-send"></i> Cetak </button>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>