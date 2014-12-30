<?php
require('../fpdf17/fpdf.php');
require_once "../config/SimplePDO.php";
require_once "../config/conf_file.php";


class PDF extends FPDF
{

	function LoadData($content)
	{
		$row = "";
		SimplePDO::set_options( array(
		     'host' => host, 
		     'user' => user, 
		     'password' => password, 
		     'database' => database ));
		$database = SimplePDO::getInstance();
		if($content == 0){
			$row = $database->get_results("SELECT p.*,b.* FROM tb_detail_distribusi p JOIN tb_barang b ON p.kode_barang=b.kode_barang WHERE id_distribusi='".$_GET['kode']."'");
		}else{
			$row = $database->get_row("SELECT p.*,s.* FROM tb_distribusi_brg p JOIN tb_cabang s ON p.kode_cabang=s.kode_cabang WHERE id_distribusi=?", array($_GET['kode']));
		}


		return $row;
	}
	function Header()
	{
		// Logo
		// $this->Image('logo.png',10,6,30);
		// Arial bold 15
		$this->SetFont('Arial','B',20);
		// Move to the right
		$this->Cell(80);
		// Title
		$this->Cell(30,10,'CV Cipta Mandiri',0,0,'C');
		$this->SetFont('Arial','B',12);
		$this->Ln(0.3);
		// $this->Cell(90);
		$this->Cell(0,30,'Jl. Raya Cibeureum No 123 Cimahi',0,0,'C');
		$this->Ln(1);
		$this->Cell(0,30,'__________________________________________________________________________________',0,0,'C');
		$this->Ln(10);
		
		$this->SetFont('Arial','',12);
		$data = $this->LoadData(1);
		$this->Cell(0,35,'Kepada yth,',0,0,'L');
		$this->Cell(0,35,'No Faktur :                        '.$data->id_distribusi,0,0,'R');
		
		$this->Ln(5);
		$this->Cell(0,37,'Pimpinan '.$data->nama_cabang,0,0,'L');
		$this->Cell(0,35,'Tanggal Pengiriman : '.$data->tgl_distribusi,0,0,'R');
		$this->Ln(5);
		$this->Cell(0,37,$data->alamat_cabang,0,0,'L');
		$this->Ln(25);
	}
	// Colored table
	function FancyTable($header, $data)
	{
		// Colors, line width and bold font
		$this->SetFillColor(80,80,80);
		$this->SetTextColor(255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B',12);
		// Header
		$w = array(20, 35, 90, 45);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('','',10);
		// Data
		$fill = false;
		$i = 1;
		$sum = 0;
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$i,'LR',0,'C',$fill);
			$this->Cell($w[1],6,$row->kode_barang,'LR',0,'L',$fill);
			$this->Cell($w[2],6,$row->nama_barang,'LR',0,'L',$fill);
			$this->Cell($w[3],6,$row->jumlah,'LR',0,'C',$fill);
			$this->Ln();
			$fill = !$fill;
			$i++;
			$sum += $row->jumlah;
		}
		// Closing line
		// $this->Cell($w,6,$i,'LR',0,'C',$fill);
		$this->Cell(array_sum($w),0,'','T');
		$this->Signature();

	}

	function Signature()
	{
		$this->SetY(90);
		$this->SetFont('Arial','',12);
		$this->Cell(0,10,'Penerima,',0,0,'L');
		$this->Cell(0,10,'Hormat kami,',0,0,'R');
		$this->Ln(5);
		$this->Cell(0,10,'CV Cipta Mandiri,',0,0,'R');
		$this->Ln(20);
		$this->Cell(0,10,'___________________',0,0,'L');
		$this->Cell(0,10,'Pimpinan',0,0,'R');
	}

	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

$pdf = new PDF();
// Column headings
$header = array('No', 'Kode Barang', 'Nama Barang', 'Jumlah');
// Data loading
$data = $pdf->LoadData(0);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>
