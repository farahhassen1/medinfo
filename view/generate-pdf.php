<?php

require __DIR__ . "/../vendor/autoload.php";

include '../controller/factureC.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the form is submitted

    $selectedInvoiceId = $_POST["id_facture"];

    // Fetch the details of the selected invoice (modify this logic based on your data structure)
    $c2 = new factureC();

    // Assume getFactureDetailsById is a method in your factureC class
    $selectedInvoiceDetails = $c2->getFactureDetailsById($selectedInvoiceId);

    if ($selectedInvoiceDetails) {
        // Extract necessary details from the fetched data
        $id_facture = $selectedInvoiceDetails["id_facture"];
        $montant = $selectedInvoiceDetails["montant"];
        $date_facture = $selectedInvoiceDetails["date_facture"];
        $descreption = $selectedInvoiceDetails["descreption"];

        // Load the HTML and replace placeholders with values from the form
        ob_start();
        include "template.html";
        $html = ob_get_clean();

        $html = str_replace(
            ["{{ id_facture }}", "{{ montant }}", "{{ date_facture }}", "{{ descreption }}"],
            [$id_facture, $montant, $date_facture, $descreption],
            $html
        );

        /**
         * Set the Dompdf options
         */
        $options = new Options;
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);

        /**
         * Set the paper size and orientation
         */
        $dompdf->setPaper("A4", "landscape");

        $dompdf->loadHtml($html);

        /**
         * Create the PDF and set attributes
         */
        $dompdf->render();

        /**
         * Save the PDF file locally
         */
        $output = $dompdf->output();
        $filename = "file.pdf";
        file_put_contents($filename, $output);

        /**
         * Send the PDF to the browser
         */
        $dompdf->stream($filename, ["Attachment" => 0]);

    } else {
        echo "Error: Failed to fetch invoice details.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
