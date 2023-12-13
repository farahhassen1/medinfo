<?php
include "../controller/factureC.php";
require __DIR__ . '/../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id_facture"])) {
    $selectedInvoiceId = $_GET["id_facture"];

    // Fetch the details of the selected invoice
    $c = new factureC();
    $invoiceDetails = $c->getFactureDetailsById($selectedInvoiceId);

    if ($invoiceDetails) {
        $id = $invoiceDetails['id_facture'];
        $description = $invoiceDetails['descreption'];
        $montant = $invoiceDetails['montant'];

        // Create an array containing the ID, description, and montant
        $data = [
            'ID' => $id,
            'Description' => $description,
            'Montant' => $montant
        ];

        // Convert the array to JSON
        $jsonData = json_encode($data);

        // Generate QR code based on the JSON data
        $qrCode = new QrCode($jsonData);
        $qrCode->setSize(300); // Set QR code size

        // Create PNG image of the QR code
        $writer = new PngWriter();
        $pngData = $writer->write($qrCode)->getString();

        // Set header to output as an image
        header('Content-Type: image/png');

        // Output the QR code image
        echo $pngData;
    } else {
        echo "Invoice details not found.";
    }
} else {
    echo "Invoice ID not provided.";
}
?>