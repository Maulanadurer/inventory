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
            $row = $database->get_results( "SELECT tc.*,tp.* FROM tb_penjualan tp JOIN tb_cabang tc ON tc.kode_cabang=tp.kode_cabang" );
        }


        return $row;
    }

    function LoadDetail($id)
    {
        $row = "";
        SimplePDO::set_options( array(
             'host' => host, 
             'user' => user, 
             'password' => password, 
             'database' => database ));
        $database = SimplePDO::getInstance();
        if($content == 0){
            $row = $database->get_results( "SELECT tp.*,tb.* FROM tb_detail_penjualan tp JOIN tb_barang tb ON tp.kode_barang=tb.kode_barang WHERE tp.id_transaksi='".$id."'" );
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
        $this->Ln(25);
        $this->SetFont('Arial','',15);
        $this->Cell(0,30,'Daftar Penjulan Barang',0,0,'C');
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
            $this->Cell($w[1],6,$row->id_transaksi,'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row->tgl_jual,'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
            $i++;
            // $sum += $row->stok_barang;
        }
        // Closing line
        // $this->Cell($w,6,$i,'LR',0,'C',$fill);
        $this->Cell(array_sum($w),0,'','T');
        $this->Signature();

    }

    function createTable()
    {
        // Data loading
        $data = $this->LoadData(0);
        // Column headings
        $i = 100;
        foreach ($data as $row) {
            $this->SetY($i);
            $header = array('No', 'ID Transaksi', 'Tanggal');
            $this->FancyTable($header,$data); 
            $i =+ 100;
        }

    }

    function Signature()
    {
        $this->SetY(90);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Hormat kami,',0,0,'R');
        $this->Ln(5);
        $this->Cell(0,10,'CV Cipta Mandiri,',0,0,'R');
        $this->Ln(20);
        $this->Cell(0,10,'Bagian Gudang',0,0,'R');
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

$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->createTable();
// $pdf->FancyTable($header,$data);
$pdf->Output();
?>
