<?php
include '../config/config.php';
require('../fpdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetAutoPageBreak(false);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Image('../images/logo.PNG',2.1,1,4.2,3.5);
$pdf->SetX(4);
$pdf->SetFont('Arial','',19);            
$pdf->MultiCell(23,1,'YAYASAN PENDIDIKAN BINTAN',0,'C');
$pdf->SetFont('Arial','B',21);
$pdf->SetX(4);
$pdf->MultiCell(23,0.8,'SEKOLAH DASAR SWASTA BINTAN',0,'C');    
$pdf->SetFont('Arial','',9);
$pdf->SetX(4);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(23,0.7,'Alamat: Jl. Yusuf Kahar No. 01 Tanjungpinang Kota, Tanjungpinang, Kepulauan Riau - 29111',0,'C');
$pdf->SetX(4);
$pdf->SetFont('Arial','U',11);
$pdf->SetTextColor(0,112,192);
$pdf->MultiCell(23,0.6,'Email : sdsbintan@gmail.com',0,'C');
$pdf->SetX(4);
$pdf->SetTextColor(0,0,0);
$pdf->Line(1,4.8,28.8,4.8);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,4.9,28.8,4.9);     
$pdf->SetLineWidth(0);
$pdf->ln(2.1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(27,0.7,"Laporan Barang Keluar",0,10,'C');
$pdf->ln(0.2);
$pdf->SetFont('Arial','I',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','i',10);
$pdf->Cell(0.9, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Kode', 1, 0, 'C');
$pdf->Cell(7, 0.7, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'Tanggal', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'Jumlah', 1, 0, 'C');
$pdf->Cell(5, 0.7, 'Keluar Dari', 1, 0, 'C');
$pdf->Cell(1.7, 0.7, 'Kondisi', 1, 0, 'C');
$pdf->Cell(5.5, 0.7, 'Keterangan', 1, 0, 'C');
$pdf->ln(0.7);
$pdf->SetFont('Arial','i',10);
if(isset($_GET['laporan2'])) {
	$tahun=$_GET['tahun'];
	$bulan=$_GET['bulan'];
	$query = mysqli_query($conn,"SELECT * FROM tbl_keluarbarang WHERE tgl_keluar LIKE '$tahun%' AND tgl_keluar LIKE '_____$bulan%' ORDER BY tgl_keluar ASC");
}
else{
	$query = mysqli_query($conn,"SELECT * FROM tbl_keluarbarang ORDER BY id_keluarbarang ASC");
}

$no=1;
while ($lihat = mysqli_fetch_array($query)) { 
	$pdf->Cell(0.9, 0.7, $no , 1, 0, 'C');
    $pdf->Cell(2, 0.7, $lihat['id_keluarbarang'],1, 0, 'C');
	$pdf->Cell(7, 0.7, $lihat['nama_barang'],1, 0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl_keluar'],1, 0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['jumlah_keluar'], 1, 0,'C');
	$pdf->Cell(5, 0.7, $lihat['lokasi_barang'],1, 0, 'C');
	$pdf->Cell(1.7, 0.7, $lihat['kondisi'],1, 0, 'C');
	$pdf->Cell(5.5, 0.7, $lihat['keterangan'], 1, 1,'C');
	$no++;
}

$pdf->ln(1.5);
$pdf->SetFont('Arial','',12);
$pdf->SetX(4.1);//buat geser kiri kanan
$pdf->Write(0,"Mengetahui,");
$pdf->SetX(3.8);
$pdf->Write(0.9,"Kepala Sekolah");
$pdf->SetX(3.2);
$pdf->Write(7,"(................................)");//Peletakannya masih salah
$pdf->SetX(-9);
$pdf->Write(0,"Tanjungpinang, ".date("d M Y"));
$pdf->SetX(-7.9);
$pdf->Write(0.9,"Pengelola Barang");
$pdf->SetX(-8.2);
$pdf->Write(7,"(................................)");//Peletakannya masih salah (Nama asli)

$pdf->ln(12);


$pdf->Output("Barang Keluar.pdf","I");

?>
