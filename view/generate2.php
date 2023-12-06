<?php
require '../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_facture"])) {
    $selectedFactureId = $_POST["id_facture"];

    // Chemin relatif du fichier PDF depuis le dossier actuel
    $pdfFilePath = __DIR__ . '/../view/file.pdf'; // Modifiez le chemin si nécessaire

    // Vérifie si le fichier PDF existe
    if (file_exists($pdfFilePath)) {
        // Convertir le chemin du fichier en URL
        $pdfUrl = 'http://localhost/projet_web2/view/file.pdf'; // Modifiez l'URL si nécessaire

        // Génération du code QR basé sur l'URL publique du fichier PDF
        $qrCode = new QrCode($pdfUrl);

        // Création de l'image PNG du code QR
        $writer = new PngWriter();
        $pngData = $writer->write($qrCode)->getString();

        // Définition de l'en-tête pour afficher une image
        header('Content-Type: image/png');

        // Affichage de l'image du code QR
        echo $pngData;
    } else {
        echo "Le fichier PDF n'existe pas.";
    }
} else {
    echo "Identifiant de la facture non fourni.";
}
?>
