<?php

defined('admin') or die ('no direct access');

include 'db.php';
include 'fpdf/fpdf.php';

class Suppliers_Orders_Pdf extends Controller {
    private $db;

    function Suppliers_Orders_Pdf() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {
        $id = $request->param_as_number(3);
        $supplier_id = $this->db->order_supplier($id);
        $data = array();
        $data['supplier'] = $this->db->get($id);
        $data['products'] = $this->db->order_products($id);
        new Supplier_Order($data);
    }
}

class Supplier_Order extends FPDF {
    public function Supplier_Order($data) {
        parent::FPDF();
        $this->AddPage();
        $this->SetLeftMargin(25);

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, $data['supplier']['name']);
        if (!empty($data['supplier']['addition'])) {
            $this->Ln(7);
            $this->Cell(35, 10, $data['supplier']['addition']);
        }
        $this->Ln(7);
        $this->Cell(35, 10, $data['supplier']['street']);
        $this->Ln(7);
        $this->Cell(35, 10, $data['supplier']['zipcode'] . ' ' . $data['supplier']['city']);

        $this->Ln(20);

        $this->SetFont('Arial','B',13);
        $this->Cell(35, 10, 'Produkte');
        $this->Ln(7);

        $this->SetFont('Arial','B',11);
        $this->Cell(35, 10, 'product number');
        $this->Cell(35, 10, 'name');
        $this->Cell(35, 10, 'price');
        $this->Cell(35, 10, 'order quantity');
        $this->Cell(30, 10, 'total');

        $this->Ln(7);

        $this->SetFont('Arial','',11);
        foreach ($data['products'] as $row) {
            $this->Cell(35, 10, $row['product_number']);
            $this->Cell(35, 10, $row['name']);
            $this->Cell(35, 10, $row['purchase_price']);
            $this->Cell(35, 10, $row['order_quantity']);
            $this->Cell(30, 10, $row['order_quantity'] * $row['purchase_price']);
            $this->Ln(7);
        }

        $this->Cell(170,10,'___________________________________________________________________________');
        $this->Ln(7);
        $this->Ln(7);

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
        $this->Cell(35,10,'Date of Order:');
        $this->Cell(50,10,date('d.m.Y'));
        $this->Ln(20);
        $this->Cell(35,10,'Signature:');
        $this->Cell(50,10,'_____________________________________');
    }
}

