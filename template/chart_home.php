<?php
$_MIN = 500;
$p_month = array();
$p_sum = array();
$p_year = 0;
for($i=1;$i<=6;$i++){
  $tmp = array();
  $sum = 0;
  $hpenjualan = $database->get_results("SELECT MONTH(`tb_penjualan`.tgl_jual) AS month, YEAR(`tb_penjualan`.tgl_jual) AS year, (SELECT SUM(td.jumlah) FROM `tb_detail_penjualan` AS td JOIN `tb_penjualan` tp ON tp.id_transaksi=td.id_transaksi WHERE tp.`tgl_jual`=`tb_penjualan`.`tgl_jual` GROUP BY tp.`tgl_jual`) AS jumlah FROM `tb_penjualan` WHERE MONTH(`tb_penjualan`.tgl_jual)='".$i."'");
  foreach($hpenjualan as $row){
      $tmp[] = $row->jumlah;
      $sum += $row->jumlah;
      $year = $row->year;
  }
  $p_sum [$i] = $sum; 
  //print_r($tmp);
  $p_month[$i] = implode(',', $tmp);
}
?>
<script type="text/javascript">
$(function () {
    $('#home_chart').highcharts({
        title: {
            text: 'Rata - Rata Penjualan Perbulan',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Penjualan'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '',
            data: [<?php echo implode($p_sum, ",");?>]
        }]
    });
});
</script>
<div id="home_chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>