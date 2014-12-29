<?php
require('../fpdf17/fpdf.php');
require_once "../config/SimplePDO.php";
require_once "../config/conf_file.php";


class PDF extends FPDF
{
	// $params = array(
	//      'host' => host, 
	//      'user' => user, 
	//      'password' => password, 
	//      'database' => database
	// );
// Load data
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

// Simple table
function BasicTable($header, $data)
{
	// Header
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

// Better table
function ImprovedTable($header, $data)
{
	// Column widths
	$w = array(40, 35, 40, 45);
	// Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR');
		$this->Cell($w[1],6,$row[1],'LR');
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->Ln();
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
	// Colors, line width and bold font
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
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
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$i,'LR',0,'C',$fill);
		$this->Cell($w[1],6,$row->kode_barang,'LR',0,'L',$fill);
		$this->Cell($w[2],6,$row->nama_barang,'LR',0,'L',$fill);
		$this->Cell($w[3],6,$row->qty,'LR',0,'L',$fill);
		$this->Ln();
		$fill = !$fill;
		$i++;
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
// Column headings
$header = array('No', 'Kode Barang', 'Nama Barang', 'Jumlah');
// Data loading
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',14);
// $pdf->AddPage();
// $pdf->BasicTable($header,$data);
// $pdf->AddPage();
// $pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>
