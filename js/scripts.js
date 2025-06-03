/*!
* Start Bootstrap - Grayscale v7.0.6 (https://startbootstrap.com/theme/grayscale)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    navbarShrink();

    document.addEventListener('scroll', navbarShrink);

    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
    

});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('devisForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch('connexion.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(pdfUrl => {
                document.getElementById('devisResult').innerHTML =
                    `<a href="${pdfUrl}" target="_blank">Télécharger le PDF</a>`;
            })
            .catch(error => {
                document.getElementById('devisResult').innerHTML =
                    "Erreur lors de la génération du PDF.";
            });
        });
    }
});

// fetch('../GIT-LAVAGE-MAIN/api/getDevisData.php')
//   .then(response => {
//     if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
//     return response.json();
//   })
//   .then(data => {
//     console.log("Données :", data);
//     devisData = data; // On stocke les données globalement
//   })
//   .catch(error => console.error("Erreur :", error));

// document.getElementById('devisForm').addEventListener('submit', function(event) {
//     event.preventDefault();

//     const nom = document.getElementById('nom').value;
//     const prenom = document.getElementById('prenom').value;
//     const adresse = document.getElementById('adresse').value;
//     const telephone = document.getElementById('telephone').value;
//     const email = document.getElementById('email').value;
//     const type = document.getElementById('type').value;
//     let item, quantite;

//     if (type === 'prestation') {
//         item = document.getElementById('prestation').value;
//         quantite = 1; // Les prestations sont généralement uniques
//     } else if (type === 'produit') {
//         item = document.getElementById('produit').value;
//         quantite = document.getElementById('quantite').value;
//     }

//     generateDevis(nom, prenom, adresse, telephone, email, item, quantite);
// });