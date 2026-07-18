import './bootstrap';
import './reservation';
import './admin/grafists';
import './admin/commande';
import './panier';
import './admin/actions';
import './search';
import './avis';
import './Alert/Alert';
import './Alert/AlertTypes';
import './carousel';
import './platUpdate';
import './model';
import './upload-picture';
import './toggleRadio';
import './modals';
import './validator';
import './convert';
import './validatorJunior';


window.addEventListener('error', (ev) => {
  console.error('Global error caught:', ev);
});
// ==============================================================

// console.log('✅ app.ts chargé');

// Protection globale pour window.appConfig
if (!window.appConfig) {
    console.error("❌ window.appConfig n'est pas défini !");
}

// Gestion erreurs globales
window.addEventListener('error', (ev) => {
    console.error('Global error caught:', ev);
});
// On précise le type des éléments HTML
const input = document.getElementById("images") as HTMLInputElement | null;
const fileName = document.getElementById("fileName") as HTMLElement | null;

if (input && fileName) {
    input.addEventListener("change", () => {
        if (input.files && input.files.length > 0) {
            fileName.textContent = input.files[0].name;
        } else {
            fileName.textContent = "Aucun fichier choisi";
        }
    });
}

// ==============================================================
// Gestion de la boîte modale

let modal: HTMLElement | null = null;

// Fonction d'ouverture de la modal
const openModal = (e: Event): void => {
    e.preventDefault();

    const targetElement = e.currentTarget as HTMLAnchorElement;
    const targetSelector = targetElement.getAttribute('href');
    if (!targetSelector) return;

    const target = document.querySelector(targetSelector) as HTMLElement | null;
    if (!target) return;

    target.style.display = ''; // Equivalent de "null" en JS pour afficher normalement
    target.removeAttribute('aria-hidden');
    target.setAttribute('aria-modal', 'true');

    modal = target;
};

// On ajoute le listener sur tous les éléments .js-modal
document.querySelectorAll<HTMLAnchorElement>(".js-modal").forEach(element => {
    element.addEventListener('click', openModal);
});
