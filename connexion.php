<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "devis";
$connexion = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupérer les données POST
$nom_prestation = $_POST['prestation'];
$nom_service = $_POST['service'];

// Requêtes SQL pour récupérer les prix
$requete_prestation = $connexion->prepare("SELECT prix FROM prestation WHERE nom_prestation = ?");
$requete_prestation->bind_param("s", $nom_prestation);
$requete_prestation->execute();
$resultat_prestation = $requete_prestation->get_result();
$prix_prestation = $resultat_prestation->fetch_assoc()['prix'];

$requete_service = $connexion->prepare("SELECT prix FROM service WHERE nom_service = ?");
$requete_service->bind_param("s", $nom_service);
$requete_service->execute();
$resultat_service = $requete_service->get_result();
$prix_service = $resultat_service->fetch_assoc()['prix'];

// Calcul du total
$total = $prix_prestation + $prix_service;

// Générer un PDF
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Ajout des détails du devis dans le PDF
$pdf->Cell(200, 10, 'Devis', 0, 1, 'C');
$pdf->Cell(200, 10, "Prestation: $nom_prestation - $prix_prestation EUR", 0, 1);
$pdf->Cell(200, 10, "Service: $nom_service - $prix_service EUR", 0, 1);
$pdf->Cell(200, 10, "Total: $total EUR", 0, 1);

// Sauvegarder le PDF dans un fichier temporaire
$chemin_pdf = "devis_" . time() . ".pdf";
$pdf->Output("F", $chemin_pdf);

// Retourner l'URL du fichier PDF généré
echo $chemin_pdf;

// Fermer la connexion
$connexion->close();
?>
