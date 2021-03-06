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
			$row = $database->get_results("SELECT tdp.*, tb.* FROM tb_detail_pemesanan AS tdp JOIN tb_barang tb ON tb.kode_barang=tdp.kode_barang WHERE tdp.kode_pesan='".$_GET['kode']."'");
		}else{
			$row = $database->get_row( "SELECT ts.*, tp.* FROM tb_pemesanan tp JOIN tb_supplier ts ON ts.kode_supplier=tp.kode_suplier WHERE tp.kode_pesan = ? ", array($_GET['kode']) );
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
		$this->Ln(5);
		$this->Cell(0,37,'Pimpinan '.$data->nama_supplier,0,0,'L');
		$this->Ln(5);
		$this->Cell(0,37,$data->alamat_supplier,0,0,'L');
		$this->Ln(10);
		$this->Cell(0,37,'Hal : Surat Pemesanan Barang',0,0,'L');
		$this->Ln(20);
		$this->Cell(0,37,'Dengan hormat,',0,0,'L');
		$this->Ln(5);
		$this->Cell(0,37,'Mengingat persediaan barang kami yang semakin menipis, maka kami bermaksud untuk ',0,0,'L');
		$this->Ln(5);
		$this->Cell(0,37,'memesan barang sebagai berikut:',0,0,'L');
		// $pdf->Write(5,"Laporan Pemesanan Barang");
		// Line break
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
			$this->Cell($w[3],6,$row->qty,'LR',0,'C',$fill);
			$this->Ln();
			$fill = !$fill;
			$i++;
			$sum += $row->qty;
		}
		// Closing line
		// $this->Cell($w,6,$i,'LR',0,'C',$fill);
		$this->Cell(array_sum($w),0,'','T');
		$this->Signature();

	}

	function Signature()
	{
		$this->SetY(120);
		$this->SetFont('Arial','',12);
		$this->Cell(0,10,'Demikian surat ini kami buat, atas perhatian dan kerjasamanya kami sampaikan terimakasih.',0,0,'L');
		$this->Ln(10);
		$this->Cell(0,10,'Hormat kami,',0,0,'L');
		$this->Ln(5);
		$this->Cell(0,10,'CV Cipta Mandiri,',0,0,'L');
		$this->Ln(20);
		$this->Cell(0,10,'Pimpinan',0,0,'L');
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
