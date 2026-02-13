document.addEventListener("DOMContentLoaded", () => {
  const track = document.querySelector<HTMLDivElement>(".pictures-plat")!;
  const items = document.querySelectorAll<HTMLImageElement>(".picture-item");
  const nextBtn = document.getElementById("nextBtn") as HTMLButtonElement;
  const prevBtn = document.getElementById("prevBtn") as HTMLButtonElement;

  if (!track || items.length === 0) return;

  let currentIndex = 0;

  if (items.length / 2 === 1 || items.length === 1) {
      nextBtn.classList.add('disabled')
      nextBtn.setAttribute('disabled', '')
      prevBtn.classList.add('disabled')
      prevBtn.setAttribute('disabled', '')
  }

  function updateCarousel(): void {
    const offset = - currentIndex * 100;
    track.style.transform = `translateX(${offset}%)`;

  }

  nextBtn.addEventListener("click", (e:any) => {
    currentIndex = (currentIndex + 1) % items.length;

    const top =  items.length % 2
    const div = items.length / 2 - currentIndex

    if (top !== 0) {
      if (div === 1) {
        nextBtn.classList.add('disabled')
        nextBtn.setAttribute('disabled', '')
        prevBtn.classList.remove('disabled')
        prevBtn.removeAttribute('disabled')
      } else {
        prevBtn.classList.remove('disabled')
        prevBtn.removeAttribute('disabled')
      }
    } else {
      if (div === 0) {
        nextBtn.classList.add('disabled')
        nextBtn.setAttribute('disabled', '')
        prevBtn.classList.add('disabled')
        prevBtn.setAttribute('disabled', '')
      }
      if (div === 1) {
        nextBtn.classList.add('disabled')
        nextBtn.setAttribute('disabled', '')
      } else {
        prevBtn.classList.remove('disabled')
        prevBtn.removeAttribute('disabled')
      }
    }
    // }
    updateCarousel();
  });

  prevBtn.addEventListener("click", (e:any) => {
    currentIndex = (currentIndex - 1 + items.length) % items.length;
    const top =  items.length % 2

    if(top !== 0){
      nextBtn.classList.remove('disabled')
      nextBtn.removeAttribute('disabled')
    }

    if (currentIndex === 0) {
      prevBtn.classList.add('disabled')
      prevBtn.setAttribute('disabled', '')
      // console.log(currentIndex);

    } else {
      nextBtn.classList.remove('disabled')
      nextBtn.removeAttribute('disabled')
      // console.log(impair);      
      
    }
    // console.log(currentIndex);
    updateCarousel();
  });
});

// <div class="carousel" id="carousel">
//   <button class="carousel-btn prev" id="prevBtn">◀</button>

//   <div class="carousel-track">
//     <img src="/images/plat1.jpg" class="carousel-item active" alt="Plat 1">
//     <img src="/images/plat2.jpg" class="carousel-item" alt="Plat 2">
//     <img src="/images/plat3.jpg" class="carousel-item" alt="Plat 3">
//   </div>

//   <button class="carousel-btn next" id="nextBtn">▶</button>

//   <!-- ✅ Indicateurs -->
//   <div class="carousel-indicators" id="indicators"></div>
// </div>

// .carousel-indicators {
//   position: absolute;
//   bottom: 10px;
//   left: 50%;
//   transform: translateX(-50%);
//   display: flex;
//   gap: 8px;
// }

// .carousel-indicators .dot {
//   width: 10px;
//   height: 10px;
//   background-color: rgba(255, 255, 255, 0.6);
//   border-radius: 50%;
//   cursor: pointer;
//   transition: background-color 0.3s;
// }

// .carousel-indicators .dot.active {
//   background-color: white;
// }


// document.addEventListener("DOMContentLoaded", () => {
//   const track = document.querySelector<HTMLDivElement>(".carousel-track");
//   const items = document.querySelectorAll<HTMLImageElement>(".carousel-item");
//   const nextBtn = document.getElementById("nextBtn") as HTMLButtonElement;
//   const prevBtn = document.getElementById("prevBtn") as HTMLButtonElement;
//   const indicatorsContainer = document.getElementById("indicators");

//   if (!track || items.length === 0 || !indicatorsContainer) return;

//   let currentIndex = 0;

//   // === Génération dynamique des points ===
//   const dots: HTMLSpanElement[] = [];
//   items.forEach((_, index) => {
//     const dot = document.createElement("span");
//     dot.classList.add("dot");
//     if (index === 0) dot.classList.add("active");
//     indicatorsContainer.appendChild(dot);
//     dots.push(dot);

//     // Clic direct sur un point => aller à cette image
//     dot.addEventListener("click", () => {
//       currentIndex = index;
//       updateCarousel();
//     });
//   });

//   function updateCarousel(): void {
//     const offset = -currentIndex * 100;
//     track.style.transform = `translateX(${offset}%)`;
//     updateDots();
//   }

//   function updateDots(): void {
//     dots.forEach((dot, i) => {
//       dot.classList.toggle("active", i === currentIndex);
//     });
//   }

//   nextBtn.addEventListener("click", () => {
//     currentIndex = (currentIndex + 1) % items.length;
//     updateCarousel();
//   });

//   prevBtn.addEventListener("click", () => {
//     currentIndex = (currentIndex - 1 + items.length) % items.length;
//     updateCarousel();
//   });
// });
