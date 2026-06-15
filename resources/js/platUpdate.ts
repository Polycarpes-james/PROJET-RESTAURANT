document.addEventListener('DOMContentLoaded', () => {

    function showModalAdmin(title:string | null, element_id:any) {
        const modal = document.getElementById('category_modal') as HTMLElement | null;
        const content = document.querySelector('.category_modal_main') as HTMLElement | null;
        const titleEl = document.getElementById('modalTitle') as HTMLElement | null;
        const footer = document.querySelector('.category_modal_footer') as HTMLElement;

        if (!modal || !content || !titleEl || !footer) return;
        
        titleEl.textContent = title;
        modal.style.display = "flex";
    }

    document.querySelectorAll('.open-category-modal').forEach(element => {
        element.addEventListener('click', (e:any) => {
            const element = e.target
            // console.log(e.target);
            showModalAdmin(element.dataset.name, element.dataset.id)
        })
    })
})