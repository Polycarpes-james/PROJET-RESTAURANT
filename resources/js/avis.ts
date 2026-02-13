// // type ServerResponse = {
// //   success: boolean;
// //   avis?: { id: number; note: number; commentaire?: string | null };
// //   moyenne?: number;
// //   nombre?: number;
// //   message?: string;
// // };

// // interface AvisWidgetElements {
// //   root: HTMLElement;
// //   stars: NodeListOf<HTMLElement>;
// //   textarea?: HTMLTextAreaElement | null;
// //   submitBtn?: HTMLButtonElement | null;
// //   feedback?: HTMLElement | null;
// //   moyenneEl?: HTMLElement | null;
// //   nombreEl?: HTMLElement | null;
// //   platId: number;
// //   selectedNote: number | null;
// // }

// // const colors = [
// //   "#FF6B6B",
// //   "#6BCB77",
// //   "#4D96FF",
// //   "#FFD93D",
// //   "#845EC2",
// //   "#FF9671",
// //   "#00C9A7",
// // ];


// // /* ==================== DEMI-ÉTOILES / WIDGET AVIS ==================== */
// // function highlightStars(elements: AvisWidgetElements, upTo: number) {
// //   elements.stars.forEach((s) => {
// //     const v = Number(s.dataset.value);
// //     if (v <= upTo) {
// //       s.classList.add('filled');
// //       s.classList.remove('half-filled');
// //     } else if (v > upTo - 0.5 && v < upTo + 0.5 && v % 1 !== 0) {
// //       s.classList.add('half-filled');
// //       s.classList.remove('filled');
// //     } else {
// //       s.classList.remove('filled', 'half-filled');
// //     }
// //   });
// // }

// // function initAvisWidgets() {
// //   const widgets = document.querySelectorAll<HTMLElement>('.avis-widget');

// //   widgets.forEach((root) => {
// //     const platId = Number(root.dataset.plat);
// //     const stars = root.querySelectorAll<HTMLElement>('.star');
// //     const textarea = root.querySelector<HTMLTextAreaElement>('textarea#commentaire');
// //     const submitBtn = root.querySelector<HTMLButtonElement>('.btn-submit-avis');
// //     const feedback = root.querySelector<HTMLElement>('.avis-feedback');
// //     const moyenneEl = root.querySelector<HTMLElement>('.moyenne');
// //     const nombreEl = root.querySelector<HTMLElement>('.nombre');

// //     const elements: AvisWidgetElements = {
// //       root, stars, textarea, submitBtn, feedback, moyenneEl, nombreEl, platId, selectedNote: null
// //     };

// //     // Si une note est déjà sélectionnée via aria-checked (affichage initial)
// //     stars.forEach((s) => {
// //       if (s.getAttribute('aria-checked') === 'true') { 
// //         const v = Number(s.dataset.value);
// //         highlightStars(elements, v);
// //         elements.selectedNote = v;
// //       }        
// //     });

// //     // Hover / clic / clavier
// //     stars.forEach((s) => {
// //       const value = Number(s.dataset.value);

// //       s.addEventListener('mouseenter', () => highlightStars(elements, value));
// //       s.addEventListener('mouseleave', () => highlightStars(elements, elements.selectedNote ?? 0));
// //       s.addEventListener('click', () => {
// //         elements.selectedNote = value;
// //         highlightStars(elements, value);
// //       });

// //       s.addEventListener('keydown', (ev) => {
// //         if (ev.key === 'Enter' || ev.key === ' ') {
// //           ev.preventDefault();
// //           elements.selectedNote = value;
// //           highlightStars(elements, value);
// //         }
// //       });
// //     });

// //     submitBtn?.addEventListener('click', () => {
// //       submitAvis(elements);
// //     });
// //   });
// // }

// // /* ==================== ENVOI AVIS ==================== */
// // async function submitAvis(elements: AvisWidgetElements) {
// //   if (!elements.selectedNote) {
// //     showModal("Erreur", "Veuillez sélectionner une note (0 à 5).");
// //     return;
// //   }

// //   const payload = {
// //     note: elements.selectedNote,
// //     commentaire: elements.textarea?.value ?? ''
// //   };

// //   const token = (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null)?.content;

// //   try {
// //     elements.submitBtn!.disabled = true;

// //     const res = await fetch(`/rettine/plats/${elements.platId}/avis`, {
// //       method: 'POST',
// //       headers: {
// //         'Content-Type': 'application/json',
// //         'Accept': 'application/json',
// //         ...(token ? { 'X-CSRF-TOKEN': token } : {})
// //       },
// //       body: JSON.stringify(payload),
// //       credentials: 'same-origin'
// //     });

// //     if (!res.ok) throw new Error(await res.text() || 'Erreur réseau');

// //     const data: ServerResponse = await res.json();

// //     if (data.success) {
// //       showModal("Success", `${data.message}`)
// //       if (elements.moyenneEl && typeof data.moyenne === 'number') {        
// //         elements.moyenneEl.textContent = `${Number(data.moyenne).toFixed(1)} / 5`;
// //       }
// //       if (elements.nombreEl && typeof data.nombre === 'number') {
// //         elements.nombreEl.textContent = `(${data.nombre} avis)`;
// //       }

// //       highlightStars(elements, elements.selectedNote);
// //     } else {
// //       showFeedback(elements, 'Impossible d’enregistrer l’avis.', false);
// //     }
// //   } catch (err: any) {
// //     showFeedback(elements, err.message || 'Erreur', false);
// //   } finally {
// //     elements.submitBtn!.disabled = false;
// //   }
// // }

// // /* ==================== FEEDBACK ==================== */
// // function showFeedback(elements: AvisWidgetElements, message: string, success = true) {
// //   if (!elements.feedback) return;
// //   elements.feedback.textContent = message;
// //   elements.feedback.classList.toggle('text-success', success);
// //   elements.feedback.classList.toggle('text-danger', !success);
// // }

// // /* ==================== MODAL ==================== */
// // function showModal (title: string, message: string, type: "success" | "error" | "info" = "info"): void {
// //   const modal = document.getElementById('customModal') as HTMLElement | null;
// //   const content = document.getElementById('modalContent') as HTMLElement | null;
// //   const titleEl = document.getElementById('modalTitle') as HTMLElement | null;
// //   const messageEl = document.getElementById('modalMessage') as HTMLElement | null;

// //   if (!modal || !content || !titleEl || !messageEl) return;

// //   const colors: Record<string, string> = {
// //       success: "modal-success",
// //       error: "modal-error",
// //       info: "modal-info"
// //   };

// //   content.className = "modal-content " + (colors[type] || '');
// //   titleEl.textContent = title;
// //   messageEl.textContent = message;
// //   modal.style.display = "flex";
// // }

// // /* ==================== ÉTOILES PAR TOTAL D’AVIS ==================== */
// // type TotalStarResult = {
// //   full: number;
// //   half: boolean;
// // };

// // function showPicture (picture: string, name: string) {
// //      const modal = document.getElementById('customModalShow') as HTMLElement | null;
// //     document.querySelector('#customModalShow .modal-content')?.setAttribute('id', 'picture_item_show')
// //     const titleEl = document.querySelector('#customModalShow #modalTitle') as HTMLElement | null;
// //     const messageEl = document.querySelector('#customModalShow #modalMessage') as HTMLElement | null;
  
// //     if (!modal || !titleEl || !messageEl) return;

// //     // const picture_item = document.createElement('img')
// //     // picture_item.setAttribute('src', `${picture}`)
// //     // console.log(picture_item);
   
// //     titleEl.textContent = name
// //     messageEl.innerHTML = `<img src="${ picture }" alt="photo">`
// //     modal.style.display = "flex";
// // }
// // // ====================== 
// // const p = document.querySelector('.remove-from-card p') as HTMLParagraphElement

// // document.querySelector('.remove-from-card .btn-suppression')?.addEventListener('mousemove', (e:any) => {
// //   // console.log(e);
// //   const input = document.querySelector('.text') as HTMLInputElement

// //   if (Number(input.value) === 0) {
// //     p.textContent = "Ce plat n'existe pas dans le panier"
// //   } else {
// //     p.textContent = "Retirer le plat du panier"
// //   }
// //   p.classList.remove('max-hidden');
// //   e.target.classList.remove('border-radius')
// //   e.target.classList.add('mi-radius')
  
// // })

// // document.querySelector('.remove-from-card .btn-suppression')?.addEventListener('mouseleave', (e:any) => {
// //   // console.log(e);
// //   p.classList.add('max-hidden')
// //   e.target.classList.add('border-radius')
// //   e.target.classList.remove('mi-radius')
// // })

// // document.querySelectorAll('.clickable')?.forEach((s:any) => {
// //     s.addEventListener('click', () => {
// //       showPicture(s.dataset.picture, s.dataset.name)

// //       document.querySelectorAll('.clickable').forEach((y:any) => {
// //         y.classList.add('done')
// //       })
// //     })
    
// //     s.addEventListener('mousemove', () => {
// //       // console.log(p.parentElement.parentElement);
// //       s.parentElement.parentElement.querySelector('.affiche').style.display = 'flex'
// //     })
// //     s.addEventListener('mouseleave', () => { 
// //       s.parentElement.parentElement.querySelector('.affiche').style.display = 'none'
// //     })

// // })
  

// // function starsFromTotalAvis(totalAvis: number): TotalStarResult {
// //   const MAX_STARS = 5;
// //   if (totalAvis <= 0) return { full: 0, half: false };

// //   const fullStars = Math.floor(totalAvis / 25);
// //   const remainder = totalAvis % 20;

// //   if (fullStars >= MAX_STARS) return { full: MAX_STARS, half: false };

// //   return {
// //     full: fullStars,
// //     half: remainder > 0 || fullStars === 0
// //   };
// // }

// // function renderStarsFromTotalAvis(stars: NodeListOf<HTMLElement>, totalAvis: number) {
// //   const { full, half } = starsFromTotalAvis(totalAvis);

// //   stars.forEach((star, index) => {
// //     star.classList.remove('filled', 'half-filled');

// //     if (index < full) star.classList.add('filled');
// //     else if (index === full && half) star.classList.add('half-filled');
// //   });
// // }



// // function calculateGlobalNote(totalAvis: number): number {
// //   const MAX_NOTE = 5;
// //   const AVIS_PAR_POINT = 20;

// //   if (totalAvis <= 0) return 0;

// //   // Note brute (ex: 37 avis => 1.85)
// //   const rawNote = totalAvis / AVIS_PAR_POINT;

// //   // Arrondi à 1 décimale (0.1, 0.2, etc.)
// //   const roundedNote = Math.floor(rawNote * 10) / 10;

// //   // Plafond à 5
// //   return Math.min(roundedNote, MAX_NOTE);


// // }


// // // function showGlobalNotes (){
// // //   const container = document.querySelector('.all-notes') as HTMLParagraphElement

// // //   const totalAvis = Number(container.getAttribute('data-all') ?? 0);

// // //   container.textContent = `${calculateGlobalNote(totalAvis)}`; 
// // // }

// // function showGlobalNotes () {
// //   const container = document.querySelector('.whole-notes');
// //   if (!container) return;

// //   const totalAvis = Number(
// //     container.querySelector('.all-notes')?.getAttribute('data-all') ?? 0
// //   );

// //   const note = calculateGlobalNote(totalAvis);

// //   // Texte
// //   const textEl = container.querySelector('.all-notes');
// //   if (textEl) {
// //     textEl.textContent = `${note.toFixed(1)} / 5`;
// //   }

// //   // Étoiles
// //   const stars = container.querySelectorAll<HTMLElement>('.star');

// //   renderStarsFromTotalAvis(stars, totalAvis);
// // }

// // showGlobalNotes()

// // /* ==================== INIT TOTAL D’AVIS ==================== */
// // document.addEventListener('DOMContentLoaded', () => {
// //   initAvisWidgets();

// //   document.querySelectorAll('.stars-display-item').forEach(container => {
// //     const totalAvis = parseInt(container.getAttribute('data-note') || '0', 10);
// //     const stars = container.querySelectorAll<HTMLElement>('.star');
// //     renderStarsFromTotalAvis(stars, totalAvis);
// //   });
// // });

// // function nice_item () {
// //  document.querySelectorAll(".stars-display").forEach(container => {
// //     const noteAttr = container.getAttribute('data-note');
// //     if (!noteAttr) return;

// //     const note = parseFloat(noteAttr);
// //     const stars = container.querySelectorAll<HTMLElement>('.star');
    
// //     stars.forEach((star, index) => {
// //       const value = index + 1;
// //       // console.log(index);
// //       if (note >= value) {
// //         // pleine étoile
// //         star.classList.add('filled');
// //       } else if (note >= value - 0.5) {
// //         star.classList.add('half-filled');
// //       } else {
// //         star.classList.remove('filled', 'half-filled');
// //       }
// //     });
// //   });
// // }
// // nice_item()


// // export {};


// /* ============================================================
//    TYPES
// ============================================================ */

// type TotalStarResult = {
//   full: number;
//   half: boolean;
// };

// /* ============================================================
//    CALCUL NOTE GLOBALE À PARTIR DU TOTAL D’AVIS
//    (0–20 → 0–1 | 20–40 → 1–2 | etc.)
// ============================================================ */

// function calculateGlobalNote(totalAvis: number): number {
//   const MAX_NOTE = 5;
//   const AVIS_PAR_POINT = 20;

//   if (totalAvis <= 0) return 0;

//   const rawNote = totalAvis / AVIS_PAR_POINT;
//   const rounded = Math.floor(rawNote * 10) / 10;

//   return Math.min(rounded, MAX_NOTE);
// }

// /* ============================================================
//    TRANSFORMATION TOTAL AVIS → ÉTOILES
// ============================================================ */

// function starsFromTotalAvis(totalAvis: number): TotalStarResult {
//   const MAX_STARS = 5;
//   if (totalAvis <= 0) return { full: 0, half: false };

//   const note = calculateGlobalNote(totalAvis);

//   const full = Math.floor(note);
//   const half = note % 1 >= 0.5;

//   return { full, half };
// }

// /* ============================================================
//    RENDU DES ÉTOILES (PLEINES / DEMI)
// ============================================================ */

// function renderStars(
//   stars: NodeListOf<HTMLElement>,
//   full: number,
//   half: boolean
// ) {
//   stars.forEach((star, index) => {
//     star.classList.remove('filled', 'half-filled');

//     if (index < full) {
//       star.classList.add('filled');
//     } else if (index === full && half) {
//       star.classList.add('half-filled');
//     }
//   });
// }

// /* ============================================================
//    ÉTOILES GLOBALES PAR PLAT (LISTING)
// ============================================================ */

// function initPlatsGlobalStars() {
//   document.querySelectorAll('.stars-display-item').forEach(container => {
//     const totalAvis = Number(container.getAttribute('data-total') ?? 0);
//     const stars = container.querySelectorAll<HTMLElement>('.star');

//     const { full, half } = starsFromTotalAvis(totalAvis);
//     renderStars(stars, full, half);
//   });
// }

// /* ============================================================
//    NOTE GLOBALE + ÉTOILES (PAGE DÉTAIL PLAT)
// ============================================================ */

// function initGlobalNoteForPlat() {
//   const wrapper = document.querySelector('.whole-notes');
//   if (!wrapper) return;

//   const noteText = wrapper.querySelector('.all-notes') as HTMLElement | null;
//   const stars = wrapper.querySelectorAll<HTMLElement>('.star');

//   const totalAvis = Number(noteText?.getAttribute('data-all') ?? 0);
//   const note = calculateGlobalNote(totalAvis);

//   if (noteText) {
//     noteText.textContent = `${note.toFixed(1)} / 5`;
//   }

//   const { full, half } = starsFromTotalAvis(totalAvis);
//   renderStars(stars, full, half);
// }

// /* ============================================================
//    ÉTOILES AVIS UTILISATEURS (NOTE DIRECTE SUR 5)
// ============================================================ */

// function initUserAvisStars() {
//   document.querySelectorAll('.stars-display').forEach(container => {
//     const noteAttr = container.getAttribute('data-note');
//     if (!noteAttr) return;

//     const note = parseFloat(noteAttr);
//     const stars = container.querySelectorAll<HTMLElement>('.star');

//     stars.forEach((star, index) => {
//       const value = index + 1;
//       star.classList.remove('filled', 'half-filled');

//       if (note >= value) {
//         star.classList.add('filled');
//       } else if (note >= value - 0.5) {
//         star.classList.add('half-filled');
//       }
//     });
//   });
// }

// /* ============================================================
//    INIT GLOBAL
// ============================================================ */

// document.addEventListener('DOMContentLoaded', () => {
//   initPlatsGlobalStars();
//   initGlobalNoteForPlat();
//   initUserAvisStars();
// });

// export {};
/* ============================================================
   TYPES
============================================================ */

type ServerResponse = {
  success: boolean;
  avis?: { id: number; note: number; commentaire?: string | null };
  moyenne?: number;
  nombre?: number;
  message?: string;
};

interface AvisWidgetElements {
  root: HTMLElement;
  stars: NodeListOf<HTMLElement>;
  textarea?: HTMLTextAreaElement | null;
  submitBtn?: HTMLButtonElement | null;
  feedback?: HTMLElement | null;
  moyenneEl?: HTMLElement | null;
  nombreEl?: HTMLElement | null;
  platId: number;
  selectedNote: number | null;
}

type TotalStarResult = {
  full: number;
  half: boolean;
};

/* ============================================================
   OUTILS ÉTOILES
============================================================ */

function renderStars(
  stars: NodeListOf<HTMLElement>,
  full: number,
  half: boolean
) {
  stars.forEach((star, index) => {
    star.classList.remove('filled', 'half-filled');

    if (index < full) {
      star.classList.add('filled');
    } else if (index === full && half) {
      star.classList.add('half-filled');
    }
  });
}

/* ============================================================
   CALCUL NOTE GLOBALE (TOTAL AVIS)
   0–20 → 0–1 | 20–40 → 1–2 | etc.
============================================================ */

function calculateGlobalNote(totalAvis: number): number {
  const MAX_NOTE = 5;
  const AVIS_PAR_POINT = 20;

  if (totalAvis <= 0) return 0;

  const raw = totalAvis / AVIS_PAR_POINT;
  const rounded = Math.floor(raw * 10) / 10;

  return Math.min(rounded, MAX_NOTE);
}

function starsFromTotalAvis(totalAvis: number): TotalStarResult {
  const note = calculateGlobalNote(totalAvis);
  return {
    full: Math.floor(note),
    half: note % 1 >= 0.5
  };
}

/* ============================================================
   ÉTOILES GLOBALES – LISTE DES PLATS
============================================================ */

function initPlatsGlobalStars() {
  document.querySelectorAll('.stars-display-item').forEach(container => {
    const totalAvis = Number(container.getAttribute('data-total') ?? 0);
    const stars = container.querySelectorAll<HTMLElement>('.star');

    const { full, half } = starsFromTotalAvis(totalAvis);
    renderStars(stars, full, half);
  });
}

/* ============================================================
   NOTE + ÉTOILES – PAGE DÉTAIL PLAT
============================================================ */

function initGlobalNoteForPlat() {
  const wrapper = document.querySelector('.whole-notes');
  if (!wrapper) return;

  const textEl = wrapper.querySelector('.all-notes') as HTMLElement | null;
  const stars = wrapper.querySelectorAll<HTMLElement>('.star');

  const totalAvis = Number(textEl?.getAttribute('data-all') ?? 0);
  const note = calculateGlobalNote(totalAvis);

  if (textEl) {
    textEl.textContent = `${note.toFixed(1)} / 5`;
  }

  const { full, half } = starsFromTotalAvis(totalAvis);
  renderStars(stars, full, half);
}

/* ============================================================
   ÉTOILES AVIS UTILISATEURS (NOTE DIRECTE /5)
============================================================ */

function initUserAvisStars() {
  document.querySelectorAll('.stars-display').forEach(container => {
    const noteAttr = container.getAttribute('data-note');
    if (!noteAttr) return;

    const note = parseFloat(noteAttr);
    const stars = container.querySelectorAll<HTMLElement>('.star');

    stars.forEach((star, index) => {
      const value = index + 1;
      star.classList.remove('filled', 'half-filled');

      if (note >= value) {
        star.classList.add('filled');
      } else if (note >= value - 0.5) {
        star.classList.add('half-filled');
      }
    });
  });
}

/* ============================================================
   WIDGET AVIS (HOVER / CLICK / SUBMIT)
============================================================ */

function highlightStars(elements: AvisWidgetElements, upTo: number) {
  elements.stars.forEach(star => {
    const value = Number(star.dataset.value);
    star.classList.remove('filled', 'half-filled');

    if (value <= upTo) {
      star.classList.add('filled');
    } else if (value - 0.5 <= upTo) {
      star.classList.add('half-filled');
    }
  });
}

function initAvisWidgets() {
  document.querySelectorAll<HTMLElement>('.avis-widget').forEach(root => {
    const platId = Number(root.dataset.plat);
    const stars = root.querySelectorAll<HTMLElement>('.star');

    const elements: AvisWidgetElements = {
      root,
      stars,
      textarea: root.querySelector('textarea'),
      submitBtn: root.querySelector<HTMLButtonElement>('.btn-submit-avis'),
      feedback: root.querySelector<HTMLParagraphElement>('.avis-feedback'),
      moyenneEl: root.querySelector<HTMLParagraphElement>('.moyenne'),
      nombreEl: root.querySelector<HTMLParagraphElement>('.nombre'),
      platId,
      selectedNote: null
    };

    

    stars.forEach(star => {
      const value = Number(star.dataset.value);

      star.addEventListener('mouseenter', () => highlightStars(elements, value));
      star.addEventListener('mouseleave', () =>
        highlightStars(elements, elements.selectedNote ?? 0)
      );
      star.addEventListener('click', () => {
        elements.selectedNote = value;
        highlightStars(elements, value);
      });
    });

    elements.submitBtn?.addEventListener('click', () => submitAvis(elements));
  });
}

/* ============================================================
   ENVOI AVIS
============================================================ */

async function submitAvis(elements: AvisWidgetElements) {
  if (!elements.selectedNote) {
    showModal("Erreur", "Veuillez sélectionner une note.", "error");
    return;
  }

  const token = (document.querySelector(
    'meta[name="csrf-token"]'
  ) as HTMLMetaElement | null)?.content;

  try {
    elements.submitBtn!.disabled = true;

    const res = await fetch(`/rettine/plats/${elements.platId}/avis`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        ...(token ? { "X-CSRF-TOKEN": token } : {})
      },
      body: JSON.stringify({
        note: elements.selectedNote,
        commentaire: elements.textarea?.value ?? ""
      })
    });

    const data: ServerResponse = await res.json();

    if (data.success) {
      showModal("Succès", data.message ?? "Avis enregistré", "success");

      if (elements.moyenneEl && typeof data.moyenne === "number") {
        elements.moyenneEl.textContent = `${data.moyenne.toFixed(1)} / 5`;
      }
      if (elements.nombreEl && typeof data.nombre === "number") {
        elements.nombreEl.textContent = `(${data.nombre} avis)`;
      }
    }
  } finally {
    elements.submitBtn!.disabled = false;
  }
}

/* ============================================================
   MODAL
============================================================ */

function showModal(
  title: string,
  message: string,
  type: "success" | "error" | "info" = "info"
) {
  const modal = document.getElementById("customModal");
  if (!modal) return;

  modal.querySelector("#modalTitle")!.textContent = title;
  modal.querySelector("#modalMessage")!.textContent = message;
  modal.style.display = "flex";
}

/* ============================================================
   INIT GLOBAL
============================================================ */

document.addEventListener("DOMContentLoaded", () => {
  initAvisWidgets();
  initPlatsGlobalStars();
  initGlobalNoteForPlat();
  initUserAvisStars();
});

export {};
