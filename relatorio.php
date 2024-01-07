
<?php
require "core/init.php";

$user = new User();
var_dump($user->activitades('credencial','pendente')) ;



//require_once "classes/pdfController.php";

// class Relatorio extends FPDF{

//     function Texto() {
//         $imagePath = 'up-logo.jpg';
//         //$this->Image($imagePath, 60, 10, 70);
//         $this->SetFont('Arial', 'B', 12);
//         $this->setY(56);
//         $this->Cell(0, 10, 'Rua Joao Carlos Raposo Beirao no 135, tel 320861 cel:823208611 fax:322113', 0, 1, 'C');
//         $this->Ln(10);
//     }
//     function Body($texto) {
//         $this->SetFont('Arial', '', 12);
//         $this->MultiCell(0, 10, $texto, 0, 'L');
//         $this->Ln();
//     }
//     function Footer()
//     {
//         $this->SetY(-15);
//         $this->SetFont('Arial', 'I', 8);
//         $this->Cell(0, 10, 'Pag: ' . $this->PageNo(), 0, 0, '');
//     }
// }
// $pdf = new Relatorio();
// $pdf->AddPage();

// $pdf->Texto();

// $texto="Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, ad.";
// $texto.="Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, culpa!";
// $texto.="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem enim";
// $texto.="nesciunt et sed repudiandae tenetur consectetur. Nam, rerum, non nobis ";
// $texto.="voluptatem aut aperiam minima magni fuga exercitationem ducimus, libero suscipit.";

// $pdf->Body($texto);

// $pdf->SetFillColor(200, 200, 200);
// $pdf->Cell(45, 10, 'Nao autorizo', 1, 0, 'C');
// $pdf->Cell(45, 10, 'Autorizo', 1, 0, 'C');
// $pdf->Cell(45, 10, 'Nao autorizo', 1, 0, 'C');
// $pdf->Cell(45, 10, 'Autorizo', 1, 1, 'C');

// $obj=new Pedido();
// $resultData=$obj->getAll();
// $obj->pesquisa($pdf,$resultData);

// // $pdf->Cell(45, 10, '', 1,0);
// // $pdf->Cell(45, 10, '', 1, 0);
// // $pdf->Cell(45, 10, '', 1);
// // $pdf->Cell(45, 10, '', 1, 1);

// $pdf->Footer();
// $pdf->Output();