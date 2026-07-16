document.addEventListener('DOMContentLoaded', () => {

    async function showModalContent (commandeid:any, isGuest:string, inviteid:string) {
        const modal = document.getElementById('admin_item_delete');
        const content = modal?.querySelector('.commandes-big-content .admin_item_main') as HTMLElement;
        const headerTitle = modal?.querySelector('.commandes-big-content #item-font');

        if (!modal || !content || !headerTitle) return;

        const res = await fetch(isGuest === "false" ? `/admin/commande/${commandeid}` : `/admin/commande/${inviteid}/${commandeid}`, {
            headers: {
                'Content-Type' : 'application/json',
                'Accept' : 'application/json'
            }
        })

        const data = await res.json();

        console.log(data);

        headerTitle.textContent = `Commande #${data.commande.id}`

        content.innerHTML = `
            <div class="commande_show_content">
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>Client</label>
                        <p>${data.infos.name} ${data.infos.lastname}</p>
                    </div>
                    <div class="commande-field">
                        <label>Email</label>
                        <p>${data.infos.email}</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>date de commande</label>
                        <p>${data.panier.created_at}€</p>
                    </div>
                    <div class="commande-field">
                        <label>montant total</label>
                        <p>${data.panier.total}€</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>telephone</label>
                        <p>${data.infos.phone}</p>
                    </div>
                    <div class="commande-field">
                        <label>addresse</label>
                        <p>${data.infos.address}</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>date de commande</label>
                        <p>${data.infos.instructions}</p>
                    </div>
                </div>
                <div class="modal-commande-row">
                    <div class="commande-field">
                        <label>Plat(s) commandé(s)</label>
                        <div class="modal-commande">
                        ${(data.panier ? data.panier.plats : data.panierGuest).map((plat: any) => `
                                <div class="item-commande">
                                     <div class="item">
                                        <p>${plat.name ?? plat.plat_name}×${plat.pivot.quantite}</p>
                                        <small>${plat.price} €</small>
                                    </div>
                                </div>
                                `).join("")}
                        </div>
                    </div>
                </div>
            </div>
        `
        modal.style.display = 'flex'

        
    }

    document.querySelectorAll('.commande-row #show').forEach((btn:any) => {
        btn.addEventListener('click', () => {
            showModalContent(btn.dataset.commandeid, btn.dataset.isguest, btn.dataset.inviteid)
        })
    })
})