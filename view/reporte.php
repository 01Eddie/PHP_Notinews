<?php
//require_once('../model/config.php');


function conexion() {
	try
	{
		$conexion=new PDO('mysql:host=localhost;dbname=proyecto','root','');
		$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$conexion->exec("SET CHARACTER SET UTF8");

	}catch(exception $e) {
		die("error".$e->getMessage());
		echo "linea de error ".$e->getLine();
	}
	return $conexion;
    }
    $db=conexion();	
    require_once('pdf/fpdf.php');
$query = "select name,lastname,email,age from postulante ";
	$resultado = $db->query($query);

	$pdf = new FPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232); //codigo rgb
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,6,'Nombre',1,0,'C',1);
	$pdf->Cell(80,6,'Apellido',1,0,'C',1);
    $pdf->Cell(40,6,'Email',1,1,'C',1);
    $pdf->Cell(40,6,'Edad',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10); //tipo de fuente
	while($row=$resultado->fetch(PDO::FETCH_ASSOC))	
	{
		$pdf->Cell(40,6,$row['name'],1,0,'C');
		$pdf->Cell(80,6,utf8_decode($row['lastname']),1,0,'C');
        $pdf->Cell(40,6,$row['email'],1,1,'C');
        $pdf->Cell(40,6,$row['age'],1,1,'C');
	}



	$pdf->Output('');

?>