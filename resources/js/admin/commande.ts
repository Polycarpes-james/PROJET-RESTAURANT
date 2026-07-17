document.addEventListener('DOMContentLoaded', () => {

    async function showModalContent (commandeid:any, isGuest:string, inviteid:string) {
        const modal = document.getElementById('admin_item_delete');
        const content = modal?.querySelector('.commandes-big-content .admin_item_main') as HTMLElement;
        const headerTitle = modal?.querySelector('.commandes-big-content #item-font');
        const footer = modal?.querySelector('.commandes-big-content footer');

        if (!modal || !content || !headerTitle || !footer) return;

        const res = await fetch(isGuest === "false" ? `/admin/commande/${commandeid}` : `/admin/commande/${inviteid}/${commandeid}`, {
            headers: {
                'Content-Type' : 'application/json',
                'Accept' : 'application/json'
            }
        })

        const data = await res.json();

        console.log(data);

        headerTitle.textContent = `Commande #${data.commande.id}`

        const field = (data.infos && data.commande) ? data.infos : data.commande 

        const panierField = data.panier ? data.panier : data.panierGuest

        content.innerHTML = `
            <div class="commande_show_content">
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>Client</label>
                        <p>${field.name} ${field.lastname}</p>
                    </div>
                    <div class="commande-field">
                        <label>Email</label>
                        <p>${field.email}</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>date de commande</label>
                        <p>${formatDate(panierField.created_at ?? field.created_at)}</p>
                    </div>
                    <div class="commande-field">
                        <label>montant total</label>
                        <p>${panierField.total ?? field.total_prix} €</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>telephone</label>
                        <p>${field.phone}</p>
                    </div>
                    <div class="commande-field">
                        <label>addresse</label>
                        <p>${field.address}</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>instructions supplementaire</label>
                        <p>${field.instructions}</p>
                    </div>
                    <div class="commande-field">
                        <label>status</label>
                        <p>${data.commande.status}</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>Plat(s) commandé(s)</label>
                        <div class="modal-commande">
                        ${(data.panier ? data.panier.plats : data.panierGuest).map((plat: any) => `
                                <div class="item-commande">
                                     <div class="item">
                                        <p>${plat.name ?? plat.plat_name}×${data.panier ? plat.pivot.quantite : plat.quantite}</p>
                                        <small>${plat.price ?? plat.prix_unitaire} €</small>
                                    </div>
                                </div>
                                `).join("")}
                        </div>
                    </div>
                </div>
            </div>
        `
        modal.style.display = 'flex'
        footer.innerHTML = ""
        
    }

    document.querySelectorAll('.commande-row #show').forEach((btn:any) => {
        btn.addEventListener('click', () => {
            showModalContent(btn.dataset.commandeid, btn.dataset.isguest, btn.dataset.inviteid)
        })
    })
})

export function formatDate(dateString: string): string {
    return new Date(dateString).toLocaleString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        // hour: '2-digit',
        // minute: '2-digit',
    });
}