import AlertService from "./Services/AlertServices";

document.addEventListener('DOMContentLoaded', () => {

    // Interface de configuration globale

    const menuBtn = document.querySelector<HTMLButtonElement>('.my-profile')
    const menu = document.querySelector<HTMLDivElement>('.connexion_box')
    if (menuBtn && menu) {
        document.addEventListener("click", (event) => {
            const target = event.target as HTMLElement;
            if (!menu?.contains(target) && !menuBtn?.contains(target)) {            
                menu?.classList.remove("active-menu");
            }
        });

        menuBtn?.addEventListener("click", () => {
            menu?.classList.toggle("active-menu");
        });
    }
    
    // ======================= MODAL GÉNÉRIQUE =========================
    function showModal(title: string, message: string, type: "success" | "error" | "info" = "info"): void {
        const modal = document.getElementById('customModal') as HTMLElement | null;
        const content = document.getElementById('modalContent') as HTMLElement | null;
        const titleEl = document.getElementById('modalTitle') as HTMLElement | null;
        const messageEl = document.getElementById('modalMessage') as HTMLElement | null;
        const footer = document.querySelector('.modal-footer-content') as HTMLElement;

        if (!modal || !content || !titleEl || !messageEl || !footer) return;

        const colors: Record<string, string> = {
            success: "modal-success",
            error: "modal-error",
            info: "modal-info"
        };

        const url = footer.dataset.auth ? '/rettine/panier' : `/guest/shopCartUp@/cart-${footer.dataset.invite_id}`;

        content.className = "modal-content " + (colors[type] || '');
        titleEl.textContent = title;
        messageEl.textContent = message;
        modal.style.display = "flex";
        
        console.log(modal.dataset.panier);
        
        if(modal.dataset.panier === "true"){
            footer.innerHTML = `<a href="/rettine/commandes" class="commandFromCart">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            Ajouter un plat
            </a>`
        }
        
        if(modal.dataset.panier === "false"){
           footer.innerHTML = `
            <a href="${url}" id="ouvrirPanierBtn" class="btn btn-open-modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="33" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            </a>`
        }
      
       
    }

    function showModalMulti (title:string, content:string) {
        const modal = document.getElementById('multi_tasks_modal') as HTMLElement
        const contentMain = document.querySelector('.multi_tasks_message') as HTMLElement;
        const titleContent = document.getElementById('multi_title_modal') as HTMLElement

        contentMain.innerHTML = `${content}`
        titleContent.textContent = `${title}`
        modal.style.display = 'flex';
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

    document.querySelectorAll<HTMLElement>('#closeBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('platWindowsInfo')
            if (modal) modal.style.display = 'none';
        })
    })

    document.querySelectorAll<HTMLElement>('#closeModal').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('customModal');
            const modal3 = document.getElementById('container-user-reservation');

            if (modal) modal.style.display = "none";
            if (modal3) modal3.style.display = "none" 
        });
    });

    document.querySelectorAll<HTMLButtonElement>('.btn-modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('multi_tasks_modal');
            const modal2 = document.getElementById('suppression_dish');

            if (modal) modal.style.display = "none"
            if (modal2) modal2.style.display = "none"
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

    // ==================================================================================

    document.querySelectorAll('.show-panier-plat').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelector('.hidden-part-plat')?.classList.remove('none-height')
        })
    })
    // ======================= MODALE D’AUTHENTIFICATION =========================
    function showAuthModal(): void {
        const modal = document.getElementById('modal-connect') as HTMLElement | null;
        const content = document.querySelector('.modal-content-item') as HTMLElement | null;
        if (!modal || !content) return;

        content.innerHTML = `
            <div class="auth-content">
                <h3>Vous n'êtes pas connecté</h3>
                <p>Souhaitez-vous vous connecter sur votre compte la rettine, <br> ou souhaitez vous créer votre compte la rettine</p>
                <div>
                    <button id="btnLogin" class="btn">Se connecter</button>
                    <button id="btnRegister" class="btn">S'inscrire</button>
                </div>
                <div class="auth-actions">
                    <h2>Continuer en tant qu'invité</h2>
                    <p>Vous pouvez continuer sans compte, mais vos données seront temporaires</p>

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
            const res = await fetch('/guest/session', 
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({session_element : session_element})
                }
            )

            const data = await res.json()
            console.log(data);

            if (data.success) {
                showModal('success', data.message)
                console.log(data);
            }

        } catch (e) {
            console.log(e);
        }
    } 

     async function loadPanierShow (plat_id: string) {
        
        let content:any
        let text:any
        let total:any

        content = document.querySelector(`.panier-item[data-plat="${plat_id}"]`) as HTMLElement | null;
        text = content ? content.querySelector('input.text') as HTMLInputElement : null
        total = content ? content.querySelector('.innertTotal') as HTMLParagraphElement : null

        if (!content) return;
    
        try {
            let data: any;
            let res = await fetch(`/rettine/plats/${plat_id}`, { 
                headers: { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })

            data = await res.json();
            if(res.status === 403){
                const resGuest = await fetch(`/guest/plats/${plat_id}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'  
                    }
                })
                data = await resGuest.json()

                if (text && total) {
                    text.value = `${data.panier ? (data.panier[plat_id] ? data.panier[plat_id]['quantite'] : 0) : 0}`          
                    total.textContent = `${(data.plat.price * (data.panier ? (data.panier[plat_id] ? data.panier[plat_id]['quantite'] : 0) : 0)).toFixed(2)} €`
                }
            } else {
                if (text && total) {
                    text.value = `${data.quantite === undefined  ? "0" : (data.quantite === null ? "0" : data.quantite)}`          
                    total.textContent = `${(data.plat.price * data.quantite).toFixed(2)} €`
                }
            }
                                   
            await loadPanier()
            
        } catch (e) {
            console.log(e);
        }
    }


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
                    const guestRes = await fetch('/guest/panier/refresh', { 
                        headers: { 
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
            list.innerHTML = '';
            totalEl.textContent = `${ data.total.toFixed(2) } €`;

            if (data.total !== 0 && data.plats) {
                data.plats.forEach((item: any) => {
                    const div = document.createElement('div');
                    div.classList.add('plat-item-modal');
            
                    div.innerHTML = `
                       <div class="items">
                            <div class="plat-item panier-item" data-plat="${ item.plat_id }">
                                <div class="picture-panier-panier">
                                    <img src="${ item.picture }" alt="">
                                </div>
                                <div class="item-description-panier">
                                    <div class="description-plat-panier">
                                        <a href="${ item.link_view }">${ item.name}</a>
                                        <span>${ item.price } €</span>
                                    </div>
                                    <div class="actions">
                                        <div class="actions-items">
                                            <button class="${ item.quantite === 1 ? "delete-dish-link" : "minus"} minus-btn" data-id="${ item.plat_id }" data-name="${ item.name }" >
                                            ${ item.quantite <= 1 ? "×" : "−"}
                                            </button>
                                            <input type="text" class="text" data-id="${ item.plat_id }" value="${ item.quantite }" data-name="${ item.name }" data-quantite="1" >
                                            <button class="plus" data-id="${ item.plat_id }">+</button>
                                        </div>
                                        <div class="total-price-number-item">
                                            <p class="total-price-number innertTotal">${Number(item.prix_total).toFixed(2)} €</p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    list.appendChild(div);
                });
                btn()
            }
            all()         
        } catch (err) {
            console.error(err);
            showModal("Erreur", "Impossible de charger le panier", "error");
        }
    }
    
    function btn(){
        document.querySelectorAll<HTMLButtonElement>('.delete-dish-link').forEach(btn => btn.addEventListener('click', () => {
            AlertService.suppressionPlat(btn.dataset.id!);
        }));
    }

    btn();

    async function ajouterAuPanier(platId: string, quantite: number, condition: boolean, state:boolean): Promise<void> {
        
        try {
            let data: any

            let res = await fetch('/rettine/panier/ajouter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ plat_id: platId, quantite: quantite, state: state})
            });

            data = await res.json()          

            if(data.session === 'invite'){
                if (res.status === 403) {
                    const resGuest = await fetch('/guest/panier/ajouter', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ plat_id: platId, quantite: quantite, state: state })
                    });

                    data = await resGuest.json()
                }                
            } else {
                if(res.status === 403) {
                    showAuthModal()
                    return;
                }
            } 

            if(!data.success){
                AlertService.platIndisponible(data.raison)
            }
            console.log(data);

            if(data.success){  
                complet_actions(data, condition)   
                                             
                const totalBtn = document.querySelector(`.total-number-plats-header[data-id="${platId}"]`) as HTMLElement;
                if (totalBtn) {
                    totalBtn.textContent = `${data.platTotal}`                
                }
                // location.reload();
                await loadPanierShow(platId);
            }
            loadPanier()
        } catch{            
            showModal("Erreur", "Impossible de contacter le serveur ", "error");
        }
    }


    document.querySelector('.vider-panier')?.addEventListener('click', (e)=>{
        AlertService.viderPanier();
    })

    function complet_actions(data: any, condition: boolean) {

        if (data.plat_id !== undefined) {

            const compteur = document.querySelector(
                `.total-number-plats-header[data-id="${data.plat_id}"]`
            ) as HTMLElement | null;

            if (compteur) {
                compteur.textContent = String(data.quantite);
            }
        }
        const totalGeneral = document.querySelector(
            '.total-number-plats'
        ) as HTMLElement | null;

        if (totalGeneral && data.total !== undefined) {
            totalGeneral.textContent = String(data.total);
        }
        
        if (condition && data.message_first) {
            showModal("Ajout du plat dans le panier", data.message_first, "success");
        }
    }
    function all () {
        document.querySelectorAll<HTMLButtonElement>('.plus').forEach(btn => btn.addEventListener('click', () => modifierQuantite(btn.dataset.id!, 1)));
        document.querySelectorAll<HTMLButtonElement>('.minus').forEach(btn => btn.addEventListener('click', () => modifierQuantite(btn.dataset.id!, -1)));
        document.querySelectorAll<HTMLInputElement>('.text').forEach(field => field.addEventListener('change', async (e:any) => {
            const platId = e.target.dataset.id!;
            const quantite = parseInt(e.target.value, 10)            
            await ajouterAuPanier(platId, quantite, true, true)            
        }))
    }

    all()

  

    

 
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
                    const resGuest = await fetch('/guest/panier/modifier', {
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
                complet_actions(data, false);
                await loadPanierShow(platId);
                // location.reload();
            }
        } catch (e) {
            showModal("Erreur serveur", "Impossible de modifier la quantité", "error");
        }
    }

    document.querySelector('.actualise')?.addEventListener('click', ()=>{
        location.reload()
    })

    // ======================= SUPPRIMER UN PLAT =========================
    
    
    // Attache l'événement d’ajout
    document.querySelectorAll<HTMLButtonElement>('.add-card').forEach(btn => {
        btn.addEventListener('click', () => {
            const platId = btn.dataset.id!;
            const quantite = parseInt(btn.dataset.quantite!, 10);               
            ajouterAuPanier(platId, quantite, false, false);
        });
    });
    
    document.querySelectorAll<HTMLButtonElement>('.add-card-show').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const platId = btn.dataset.id!;
            const quantite = parseInt(btn.dataset.quantite || '1');
            loadPanierShow(platId)
            ajouterAuPanier(platId, quantite, true, false)
        })
    })

    // ======================= VALIDATION DU PANIER =========================
    async function validerPanier(auth:any): Promise<void> {
        try {
            let data
            let res = await fetch('/rettine/panier/commander', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
            });

            data = await res.json();      

            if (res.status === 403) {  
                let resGuest = await fetch('/guest/panier/commander', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content,
                        'Accept': 'application/json'
                    },
                });
                data = await resGuest.json();      
                if (data.session){                    
                    window.location.href = `/guest/valide-plats-${auth}`
                }
            }            

            if (data.success) {
                window.location.href = `/rettine/valider-plats-${data.panier.id}`
            } 
            
            if (data.error === 'vide') {
                AlertService.panierVide(data.message)
            }
        } catch (e){
            showModal("Erreur", "Impossible de passer la commande" + e, "error");
            console.log(e);
            
        }
    }

    // Boutons de validation
    document.getElementById('btn-commande')?.addEventListener('click', (e:any) => {validerPanier(e.target.dataset.auth)});

});
 
/**
 *  Cette fonction permet de faire d'afficher ou de cacher un contenu
 * 
 * @param idClassName L'id du contenu
 * @param what s'il s'agit d'une class ou d'un id (True:si c'est une class, False:si c'est un id)
 * @param withClassName Indique si l'element est caché grace à un "ClassList" ou un "Style,Display:None" 
 * @param elementTargetClassName Le nom de classe de l'element ciblé
 */
function hideContainer (idClassName:string, what:boolean, withClassName:boolean, elementTargetClassName:string){
    const contentSuppressionClass = document.querySelectorAll(idClassName);
    const contentSuppressionId = (what ? document.querySelector(idClassName) : document.getElementById(idClassName)) as HTMLElement;
    
    if (withClassName && what) {
        contentSuppressionClass.forEach((content:any)=> {
            content.classList.remove(elementTargetClassName);
        })
    } else {
        if (contentSuppressionId) contentSuppressionId.style.display = "none" 
    }
}

export async function apiFetch(url: string, options: RequestInit) {
    const response = await fetch(url, options);
    const data = await response.json();

    if (!response.ok) {
        throw data;
    }

    return data;
}

async function viderPanier() {

    const response = await fetch('/guest/panier/vider', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':(document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content,
            'Accept': 'application/json'
        },
        credentials: 'same-origin',
    });

    const data = await response.json();

    console.log(data);
    
    if (data.success) {            
        location.reload();
    }
}


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
                const resGuest = await fetch('/guest/panier/supprimer', {
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
                // if (res.status === 430) {
                //     showAuthModal()
                //     return
                // }
            }
            location.reload();
          
        } catch (e){
            console.log(e);
            // showModal("Erreur serveur", "Impossible de supprimer le plat", "error");
        }
    }

export {
    hideContainer,
    supprimerPlat,
    viderPanier
}