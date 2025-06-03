<?php 
require_once __DIR__ . '/../model/Produit.php';
require_once __DIR__ . '/../model/Service.php';

// Instancier les modèles
$produitModel = new Produit();
$serviceModel = new Service();

// Récupérer les données
$produits = $produitModel->getAllProduits();
$services = $serviceModel->getAllServices();
?>
    <main>
        <div class="form-container" id="devis">
            <h2>Faire un Devis</h2>
            <form id="devisForm">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required><br><br>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required><br><br>

                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required><br><br>

                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" required><br><br>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="type">Type :</label>
                <select id="type" name="type" required>
                    <option value="">Choisir</option>
                    <option value="prestation">Prestation</option>
                    <option value="produit">Produit</option>
                </select><br><br>

                <div id="prestationOptions" style="display:none;">
                    <label for="prestation">Prestation :</label>
                    <select id="prestation" name="prestation">
                        <option value="">Choisir</option>
                        <?php foreach ($services as $service) : ?>
                            <option value="<?php echo htmlspecialchars($service['nom']); ?>">
                                <?php echo htmlspecialchars($service['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br><br>
                </div>

                <div id="produitOptions" style="display:none;">
                    <label for="produit">Produit :</label>
                    <select id="produit" name="produit">
                        <option value="">Choisir</option>
                        <?php foreach ($produits as $produit) : ?>
                            <option value="<?php echo htmlspecialchars($produit['nom']); ?>">
                                <?php echo htmlspecialchars($produit['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <label for="quantite">Quantité :</label>
                <input type="number" id="quantite" name="quantite" min="1"><br><br>

                <button type="submit">Établir le Devis</button>
            </form>
        </div>
        <div id="devisResult"></div>

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script> -->

    </main>
    <script src="../js/scripts.js"></script>
    <script>
        // Affichage dynamique des listes déroulantes
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type');
            const prestationOptions = document.getElementById('prestationOptions');
            const produitOptions = document.getElementById('produitOptions');
            if (typeSelect) {
                typeSelect.addEventListener('change', function () {
                    if (this.value === 'prestation') {
                        prestationOptions.style.display = 'block';
                        produitOptions.style.display = 'none';
                        quantiteInput.value = 1; // Fixe la quantité à 1 pour les prestations
                        quantiteInput.disabled = true; // Désactiver l'input de quantité
                    } else if (this.value === 'produit') {
                        prestationOptions.style.display = 'none';
                        produitOptions.style.display = 'block';
                        quantiteInput.disabled = false; // Activer l'input de quantité pour les produits

                    } else {
                        prestationOptions.style.display = 'none';
                        produitOptions.style.display = 'none';
                        quantiteInput.disabled = true; // Désactiver si aucun type sélectionné

                    }
                });
            }
        });
    </script>

<?php

// ... récupération des infos utilisateur et du produit/prestation ...

// public function getAllProduits() {
//     $query = "SELECT * FROM produits";
//     $stmt = $this->db->prepare($query);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
// ?>
