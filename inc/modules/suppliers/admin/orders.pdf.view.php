<?php

class Supplier_Order extends FPDF {

    public function Supplier_Order($fields) {
        parent::FPDF();
        $this->AddPage();
        $this->SetLeftMargin(25);

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, ':');
        $this->setFont('Arial', '', 11);
        $this->Cell(185, 10, 'expense');

        $this->Ln(7);

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'Date:');
        $this->setFont('Arial', '', 11);
        $this->Cell(50, 10, 'date');

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'Amount:');
        $this->setFont('Arial', '', 11);
        $this->Cell(50, 10, 'amount' . ' ' . 'iso');

        $this->Ln(7);

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'Payment Type:');
        $this->setFont('Arial', '', 11);
        $this->Cell(50, 10, 'paymenttype');

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'Expense Type:');
        $this->setFont('Arial', '', 11);
        $this->Cell(50, 10, 'expensetype');

        $this->Ln(7);

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'Employee:');
        $this->setFont('Arial', '', 11);
        $this->Cell(50, 10, 'fullname');

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'Company:');
        $this->setFont('Arial', '', 11);
        $this->Cell(50, 10, 'company');

        $this->Output();
    }

    function Header() {
        $this->SetLeftMargin(25);

        // $this->Image('logo.png',130,25);
        $this->Ln(25);
        //Arial fett 15
        $this->SetFont('Arial','BU',15);

        //Titel
        $this->Cell(30,10,'Lieferanten Bestellung');
        //Zeilenumbruch
        $this->Ln(15);
    }

    function Footer() {
        //Position 1,5 cm von unten
        $this->SetY(-45);
        //Arial kursiv 8
        $this->SetFont('Arial','',11);
        //Seitenzahl
        $this->Cell(35,10,'Date of Report:');
        $this->Cell(50,10,date('d.m.Y'));
        $this->Ln(20);
        $this->Cell(35,10,'Signature:');
        $this->Cell(50,10,'_____________________________________');
    }
}
