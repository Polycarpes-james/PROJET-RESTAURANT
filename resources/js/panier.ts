

document.addEventListener('DOMContentLoaded', () => {

    const element_plat = document.querySelectorAll('.pass-commande .items-content')
    // Interface de configuration globale


    // ======================= MODAL GÉNÉRIQUE =========================
    function showModal(title: string, message: string, type: "success" | "error" | "info" = "info"): void {
        const modal = document.getElementById('customModal') as HTMLElement | null;
        const content = document.getElementById('modalContent') as HTMLElement | null;
        const titleEl = document.getElementById('modalTitle') as HTMLElement | null;
        const messageEl = document.getElementById('modalMessage') as HTMLElement | null;

        if (!modal || !content || !titleEl || !messageEl) return;

        const colors: Record<string, string> = {
            success: "modal-success",
            error: "modal-error",
            info: "modal-info"
        };

        content.className = "modal-content " + (colors[type] || '');
        titleEl.textContent = title;
        messageEl.textContent = message;
        modal.style.display = "flex";
    }

    function showModalSuppression (plat_id: string, name: string) {
        const modal = document.getElementById('suppression_dish') as HTMLElement;
        const contentMain = document.querySelector('.suppression-message') as HTMLElement;
        const btnSuppression = document.querySelector('.btn-suppression') as HTMLElement;
        
        contentMain.innerHTML = `Voulez vous vraiment retirer le plat ${name} du panier ?`
        btnSuppression.setAttribute('data-id', plat_id)
        modal.style.display = 'flex';
    }

    // ======================= FERMETURE DES MODALES =========================
    document.querySelectorAll<HTMLElement>('#closeModal').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('customModal');
            if (modal) modal.style.display = "none";
        });
    });

    document.querySelectorAll<HTMLButtonElement>('.btn-modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('suppression_dish');
            if (modal) modal.style.display = "none"
        })
    })

   document.querySelectorAll<HTMLElement>('#closeModal').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('customModalShow');
            if (modal) {
                modal.style.display = "none";
                document.querySelectorAll('.clickable').forEach((p) => {
                    p.classList.remove('done')  
                }) 
            }
        });
    });
    document.querySelectorAll<HTMLElement>('#closePanierModal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll<HTMLElement>('#panierModal').forEach(ele => {
                ele.style.display = "none";
                console.log("Ok");
            });
        });
    });

    window.addEventListener('keydown', (e: KeyboardEvent) => {
        if(e.key === "Escape" || e.key === 'Esc'){
            document.querySelectorAll<HTMLElement>('#customModal').forEach(ele => {
                ele.style.display = "none"
            })
            document.querySelectorAll<HTMLElement>('#modal-connect').forEach(ele => {
                ele.style.display = "none"
            })
            
        }
        // console.log(e.key);
    });
    // ======================= OUVERTURE DU PANIER =========================
    document.querySelectorAll<HTMLElement>('#ouvrirPanierBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            const panierModal = document.getElementById('panierModal');
            const customModal = document.getElementById('customModal');
            if (panierModal) panierModal.style.display = "none";
            if (customModal) customModal.style.display = "none";
            loadPanier();
        });
    });

    document.querySelectorAll<HTMLElement>('.back-panier').forEach(btn => {
        btn.addEventListener('click', () => {
            const customModal = document.getElementById('customModal');
            const infoClient = document.querySelector('.modal-information-client') as HTMLElement | null;
            const modalPanier = document.querySelector('.modal-panier') as HTMLElement | null;

            if (customModal) customModal.style.display = "none";
            if (infoClient) infoClient.style.display = "none";
            if (modalPanier) modalPanier.style.display = "flex";
        });
    });

    // ======================= MODALE D’AUTHENTIFICATION =========================
    function showAuthModal(): void {
        const modal = document.getElementById('modal-connect') as HTMLElement | null;
        const content = document.querySelector('.modal-content-item') as HTMLElement | null;
        if (!modal || !content) return;

        content.innerHTML = `
            <div class="auth-content">
                <h3>Vous n'êtes pas connecté</h3>
                <p>Souhaitez-vous vous connecter, ou continuer en tant qu'invité ?</p>
                <div>
                    <button id="btnLogin" class="btn">Se connecter</button>
                    <button id="btnRegister" class="btn">S'inscrire</button>
                </div>
                <p>Vous pouvez continuer sans compte, mais vos données seront temporaires</p>
                <div class="auth-actions">
                    <button id="btnGuest" class="btn">Continuer en invité</button>
                </div>
            </div>
        `;

        modal.style.display = "flex";

        const btnLogin = document.getElementById('btnLogin') as HTMLButtonElement | null;
        const btnRegister = document.getElementById('btnRegister') as HTMLButtonElement | null;
        const btnGuest = document.getElementById('btnGuest') as HTMLButtonElement | null;

        if (btnLogin) btnLogin.onclick = () => (window.location.href = '/rettine/login');
        if (btnRegister) btnRegister.onclick = () => (window.location.href = '/rettine/signin');

        if (btnGuest) btnGuest.onclick = () => {
            modal.style.display = "none";
            createSessionInvite('invite')
        };
    }

    async function createSessionInvite (session_element: string) {
        try {
            const res = await fetch('/invite/session', 
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({session_element : session_element})
                }
            )

            const data = await res.json()
            console.log(data);

            if (data.success) {
                showModal('success', data.message)
            }

        } catch (e) {
            console.log(e);
        }
    } 

    async function loadPanierShow (plat_id: string) {
        
        let content:any
        let text:any
        let total:any
        let btnMinus:any

        content = document.querySelector('.panier-item')
        text = content ? content.querySelector('.text') as HTMLInputElement : null
        total = content ? content.querySelector('.innertTotal') as HTMLParagraphElement : null
        btnMinus = content.querySelector('.minus') as HTMLButtonElement
        try {
            let data: any;
            let quantite: any

            let res = await fetch(`/rettine/plats/${plat_id}`, { 
                headers: { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })

            data = await res.json();
            if(res.status === 403){
                const resGuest = await fetch(`/invite/plats/${plat_id}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'  
                    }
                })
                data = await resGuest.json()

                quantite = data.panier ? (data.panier[plat_id] ? data.panier[plat_id]['quantite'] : 0) : 0                
                if (text && total) {
                    text.value = `${data.panier ? (data.panier[plat_id] ? data.panier[plat_id]['quantite'] : 0) : 0}`          
                    total.textContent = `Totals : ${(data.plat.price * (data.panier ? (data.panier[plat_id] ? data.panier[plat_id]['quantite'] : 0) : 0)).toFixed(2)} €`
                }
            } else {
                if (text && total) {
                    
                    text.value = `${data.quantite === undefined  ? "0" : (data.quantite === null ? "0" : data.quantite)}`          
                    total.textContent = `Totals : ${(data.plat.price * data.quantite).toFixed(2)} €`
                }
                quantite = data.quantite
            }
                       
            console.log(quantite);
            
            if(quantite === null){
                btnMinus?.classList.add('disabled')
            } else {
                btnMinus?.classList.remove('disabled')
                if (quantite <= 1) {
                    btnMinus?.setAttribute('disabled', '')
                    btnMinus?.classList.add('disabled')
                } else {
                    btnMinus?.removeAttribute('disabled')
                    btnMinus?.classList.remove('disabled')
                }              
            }
            loadPanier()
        } catch (e) {
            console.log(e);
        }
    }

    // loadPanierShow()

    // ======================= CHARGEMENT DU PANIER =========================
    async function loadPanier(): Promise<void> {
        const list = document.getElementById('modalPanierList') as HTMLElement;
        const totalEl = document.getElementById('modalPanierTotal') as HTMLElement;
        
        if (!list || !totalEl) return;
        try {
            
            let res = await fetch('/rettine/panier/refresh', { 
                headers: { 
                        'Content-Type': 'application/json',
                        'Accept': 'application/json' 
                    }
                });
            let data:any;

            data = await res.json()

            

            if (data.session === 'invite') {
                if (res.status === 403) {
                    const guestRes = await fetch('/invite/panier/refresh', { headers: { 
                            'Content-Type': 'application/json',
                            'Accept': 'application/json' 
                        } 
                    });
                    
                    data = await guestRes.json();
                                         
                    const modalConnect = document.getElementById('modal-connect');
                    if (modalConnect) modalConnect.style.display = "none";
                }
            } else {
                if(res.status === 403){
                    showAuthModal();
                    return;
                }
            }

            console.log(data);
            
            list.innerHTML = '';
            totalEl.textContent = data.total.toFixed(2);
            
            if (data.total !== 0 && data.plats) {
                data.plats.forEach((item: any) => {
                    const div = document.createElement('div');
                    div.classList.add('plat-item-modal');
                    div.innerHTML = `
                    <div class="items">
                        <div class="plat-item panier-item" data-plat="${item.plat_id}">
                            <button class="delete-dish" data-id="${item.plat_id}" data-name="${item.name}">×</button>
                            <div class="picture-panier-panier">
                                <img src="${item.picture}" alt="">
                            </div>
                            <div class="item-description-panier">
                                <div class="description-plat-panier">
                                    <a href="${item.link_view}">${item.name} <br> <span>${item.price} €</span></a>
                                    <p>${item.description}</p>
                                </div>
                                <div class="actions">
                                    <div class="actions-items">
                                        <button class="minus" data-id="${item.plat_id}">−</button>
                                        <input type="text" class="text" data-id="${ item.plat_id }" value="${ item.quantite }" data-name="${ item.name }" data-quantite="1" >
                                        <button class="plus" data-id="${item.plat_id}">+</button>
                                    </div>
                                    <div class="total-price-number-item">
                                        <p class="total-price-number innertTotal">Totals : ${Number(item.prix_total).toFixed(2)} €</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    list.appendChild(div);
                });
            }
            // document.getElementById('panierModal')!.style.display = 'flex';

            all()         


        } catch (err) {
            console.error(err);
            showModal("Erreur", "Impossible de charger le panier", "error");
        }
    }
    document.querySelectorAll<HTMLButtonElement>('.delete-dish').forEach(btn => btn.addEventListener('click', (e) => {
        showModalSuppression(btn.dataset.id!, btn.dataset.name!)
    }));
    async function ajouterAuPanier(platId: string, quantite: number, condition: boolean, nature:boolean): Promise<void> {
        try {
            let data: any

            let res = await fetch('/rettine/panier/ajouter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ plat_id: platId, quantite: quantite, nature: nature})
            });

            data = await res.json()

            if(data.session === 'invite'){
                if (res.status === 403) {
                    const resGuest = await fetch('/invite/panier/ajouter', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ plat_id: platId, quantite: quantite, nature: nature })
                    });
                    data = await resGuest.json()
                }
            } else {
                if(res.status === 403) {
                    showAuthModal()
                    return;
                }
            } 
            
            if(data.success){                
                complet(data, condition)
                const card = document.querySelector<HTMLElement>(`.items-content[data-plat-id="${platId}"]`);
                if (card) {
                    card.classList.add('deep-active');
                }
            }
            loadPanier()
        } catch {
            showModal("Erreur", "Impossible de contacter le serveur", "error");
        }
    }

    function complet (data:any, condition:boolean) {
        const e = document.querySelector('.total-number-plats') as HTMLParagraphElement
        if (e) {
            e.textContent = data.total
        }
        // console.log(data.total);
        if (condition) {
            showModal("Succès", data.message, "success");                
        }
    }
    
    function all () {
        document.querySelectorAll<HTMLButtonElement>('.plus').forEach(btn => btn.addEventListener('click', () => modifierQuantite(btn.dataset.id!, 1)));
        document.querySelectorAll<HTMLButtonElement>('.minus').forEach(btn => btn.addEventListener('click', () => modifierQuantite(btn.dataset.id!, -1)));
        document.querySelectorAll<HTMLInputElement>('.text').forEach(field => field.addEventListener('change', (e:any) => {
            const platId = e.target.dataset.id!;
            const quantite = e.target.value;
            loadPanierShow(e.target.dataset.id!)
            ajouterAuPanier(platId, quantite, false, true)

        }))
    }

    all()

    document.querySelectorAll<HTMLButtonElement>('.btn-suppression').forEach(btn => btn.addEventListener('click', () => {
        supprimerPlat(btn.dataset.id!)  
        const contentSuppression = document.getElementById('suppression_dish') as HTMLElement;
        contentSuppression.style.display = "none" 
    }))
    // ======================= MODIFIER QUANTITÉ =========================
    async function modifierQuantite(platId: string, delta: number): Promise<void> {
        try {
            let data:any
            const res = await fetch('/rettine/panier/modifier', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({ plat_id: platId, delta: delta })
            });
            
            data = await res.json()
            
            if(data.session === 'invite'){
                if(res.status === 403){
                    const resGuest = await fetch('/invite/panier/modifier', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({ plat_id: platId, delta: delta })
                    })
                
                    data = await resGuest.json()
                }
            } else {
                if(res.status === 403){
                    showAuthModal();
                    return;
                }
            }

            if (data.success) {                   
                complet(data, false)                             
                loadPanierShow(platId)
            } 
            loadPanier()
        } catch (e) {
            // console.log(e);
            showModal("Erreur serveur", "Impossible de modifier la quantité", "error");
        }
    }

    // ======================= SUPPRIMER UN PLAT =========================
    async function supprimerPlat(platId: string): Promise<void> {
        try {
            let data:any
            const res = await fetch('/rettine/panier/supprimer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({ plat_id: platId })
            });
            data = await res.json();
            // console.log(data);
            
            if (data.session === 'invite') {
                const resGuest = await fetch('/invite/panier/supprimer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ plat_id: platId})
                })
                
                data = await resGuest.json()

            } else {
                if (res.status === 430) {
                    showAuthModal()
                    return
                }
            }

            if (data.success) {
                const e = document.querySelector('.total-number-plats') as HTMLParagraphElement
                if(e){
                    e.textContent = data.total
                }
                loadPanierShow(platId)     
            } else {
                console.log('Déjà');
            }   
            
        } catch (e){
            console.log(e);
            showModal("Erreur serveur", "Impossible de supprimer le plat", "error");
        }
    }

    

    // Attache l'événement d’ajout
    document.querySelectorAll<HTMLButtonElement>('.add-card').forEach(btn => {
        btn.addEventListener('click', () => {
            const platId = btn.dataset.id!;
            const quantite = parseInt(btn.dataset.quantite || '1');
            ajouterAuPanier(platId, quantite, true, false);
        });
    });
    
    document.querySelectorAll<HTMLButtonElement>('.add-card-show').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const platId = btn.dataset.id!;
            const quantite = parseInt(btn.dataset.quantite || '1');
            loadPanierShow(platId)
            ajouterAuPanier(platId, quantite, false, false)
        })
    })

    // ======================= VALIDATION DU PANIER =========================
    async function validerPanier(formData: Record<string, any> = {}): Promise<void> {
        try {
            let res = await fetch('/rettine/panier/commander', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                // body: JSON.stringify(formData)
            });

            if (res.status === 403) {
                res = await fetch(window.appConfig.routeInviteCommande, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
            }

            const data = await res.json();
            console.log(data);
            
            if (data.success) {
                (document.querySelector('.modal-information-client') as HTMLElement).style.display = "flex";
                (document.querySelector('.modal-panier') as HTMLElement).style.display = "none";
            } 
            if (data.error === 'vide') {
                showModal("Panier vide", data.message, "error");
                const panierModal = document.getElementById('panierModal');
                if (panierModal) panierModal.style.display = "none";
            }
        } catch {
            showModal("Erreur", "Impossible de passer la commande", "error");
        }
    }

    // Boutons de validation
    document.getElementById('btn-commande')?.addEventListener('click', () => validerPanier());

});
 