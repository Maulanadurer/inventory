<?php
require('../fpdf17/fpdf.php');
require_once "../config/SimplePDO.php";
require_once "../config/conf_file.php";


class PDF extends FPDF
{

function LoadData()
{

	SimplePDO::set_options( array(
	     'host' => host, 
	     'user' => user, 
	     'password' => password, 
	     'database' => database ));
	$database = SimplePDO::getInstance();

	// $row = $database->get_row( "SELECT ts.*, tp.* FROM tb_pemesanan tp JOIN tb_supplier ts ON ts.kode_supplier=tp.kode_suplier WHERE tp.kode_pesan = ? ", array($_GET['kode']) );
	$rows = $database->get_results("SELECT tdp.*, tb.* FROM tb_detail_pemesanan AS tdp JOIN tb_barang tb ON tb.kode_barang=tdp.kode_barang WHERE tdp.kode_pesan='".$_GET['kode']."'");
	return $rows;
}

// Colored table
function FancyTable($header, $data)
{
	// Colors, line width and bold font
	$this->SetFillColor(80,80,80);
	$this->SetTextColor(255);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Header
	$w = array(20, 35, 90, 45);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	$i = 1;
	$sum = 0;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$i,'LR',0,'C',$fill);
		$this->Cell($w[1],6,$row->kode_barang,'LR',0,'L',$fill);
		$this->Cell($w[2],6,$row->nama_barang,'LR',0,'L',$fill);
		$this->Cell($w[3],6,$row->qty,'LR',0,'L',$fill);
		$this->Ln();
		$fill = !$fill;
		$i++;
		$sum += $row->qty;
	}
	// Closing line
	// $this->Cell($w,6,$i,'LR',0,'C',$fill);
	$this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
// Column headings
$header = array('No', 'Kode Barang', 'Nama Barang', 'Jumlah');
// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>
