
<?php
    require_once 'core/init.php';
    if(Session::exists('usuario')){
        if(Session::verify('usuario',2)){
            Redirect::to('home.php');
            exit();
        }
    }else{
        Redirect::to('login.php?sessao nao criada');
        exit();
      }
   $user=new User();
    if($user->isLoggedIn()){
   
    $id=$_GET["downloadId"];
    $obj=new Credencial();
    $resultData = $obj->dadosPDF('realizar_exame',$id);

    if (empty($resultData)) {
        die("Nenhum dado encontrado, tente mais tarde!");
    }
    foreach ($resultData as $linha) {
        $nome = $linha['nome'];
        $nacionalidade = $linha['nacionalidade'];
        $idade = $linha['idade'];
        $bi = $linha['numero_bi'];
        $emissao = $linha['local_emissao_bi'];
        $cod = $linha['numero_estudante'];
        $curso = $linha['curso'];
        $periodo = $linha['regime'];
        $nivel = $linha['ano'];
        $motivo = $linha['motivo'];
    }
error_reporting(-1);

if( $resultData['periodo']="laboral"){
    $text="Laboral (X); Pós-laboral ( ); EAD ( )";
}elseif( $resultData['periodo']="pos-laboral"){
    $text="Laboral ( ); Pós-laboral (X); EAD ( )";
}else{
    $text="Laboral ( ); Pós-laboral ( ); EAD (X)";
}
class PDF extends FPDF {
    function images() {
        $imagePath = 'assets/up-logo.jpg';
        $this->Image($imagePath, 60, 10, 70);
        $this->SetFont('Arial', 'B', 12);
        $this->setY(56);
        $this->Cell(0, 10, 'Rua Joao Carlos Raposo Beirao no 135, tel 320861 cel:823208611 fax:322113', 0, 1, 'C');
        $this->Ln(10);
    }

    function ChapterTitle($title) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1, 'C');
        $this->Ln(4);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pag: ' . $this->PageNo(), 0, 0, 'C');
    }

    function ChapterBody($body) {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $body, 0, '');
        $this->Ln();
    }
}

// Cria um novo documento PDF
$pdf = new PDF();
$pdf->AddPage();

$pdf->Images();
// Título
$pdf->ChapterTitle('Modelo 1.5');
$pdf->ChapterTitle('[Pedido de Realizacao de anulacao de matricula]');
$pdf->ChapterTitle('Exmo(a) Senhor(a)');
$pdf->ChapterTitle('Director (a) da Faculdade/Escola/Delegacao Nome da delegacao');

// Tabela de Despacho
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(0, 10, 'Despacho', 1, 1, 'C');
$pdf->Cell(95, 10, 'Nao autorizo', 1, 0, 'C');
$pdf->Cell(95, 10, 'Autorizo', 1, 1, 'C');

for ($i = 0; $i < 5; $i++) {
    $pdf->Cell(95, 10, '', 1);
    $pdf->Cell(95, 10, '', 1, 1);
}


$pdf->Cell(95, 10, 'Data   /    /     ', 1, 0, 'C');
$pdf->Cell(95, 10, 'Data   /    /     ', 1, 1, 'C');
$pdf->Cell(95, 10, 'Assinatura', 1, 0, 'C');
$pdf->Cell(95, 10, 'Assinatura', 1, 1, 'C');


$pdf->SetFont('times', '', 12);
$pdf->Ln(4);

$texto=("\nNome completo: ". $nome.", de nacionalidade: ".$nacionalidade.",");
$texto.=($emissao.", aos dia/mes.ano, estudante da Universidade Pedagogica,");
$texto.=("Faculdade/Escola/Delegacao de Economia e Gestao inscrito, sob "."\n"."o numero ".$cod);
$texto.=(", no curso de ".$curso." regime ".$periodo.", ".$nivel."ano(academico), \n");
$texto.=("vem mui respeitosamente requerer a V. Excia se digne autorizar a anulacaoo da matrícula \n");
$texto.=("por motivo de: ".$motivo."\n");
$texto.=("pelo que, \n\n");
$texto.=("Pede deferimento\n");
$texto.=("(Assinatura)\n");
$texto.=("(Local,Data) Local, dia/mes/ano\n");
$pdf->ChapterBody($texto);
// Tabela de Pareceres

$pdf->Cell(95, 10, 'Parecer do Chefe do Departamento', 1, 1, 'C');
for ($i = 0; $i < 5; $i++) {
    $pdf->Cell(95, 10, '', 1);
    $pdf->Cell(95, 10, '', 1, 1);
}

$pdf->Cell(95, 10, 'Data DD/MM/YYYY', 1, 0, 'C');
$pdf->Cell(95, 10, 'Data DD/MM/YYYY', 1, 1, 'C');
$pdf->Cell(95, 10, 'Assinatura', 1, 0, 'C');
$pdf->Cell(95, 10, 'Assinatura', 1, 1, 'C');


$textos="";
// Observações
$textos.=("\n\nOBS: O requerente deve fundamentar o seu pedido e se necessario anexar os\n");
$textos.=("documentos comprovativos pertinentes que possam contribuir para a tomada da\n");
$textos.=("decisao. De acordo com o Regulamento Academico da UP... a aceitacao do pedido, dependera da existencia de vaga.\n");
$pdf->ChapterBody($textos);
// Saída do PDF

$pdf->Output();


    }