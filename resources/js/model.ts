document.querySelectorAll('.cat-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        const target = e.currentTarget as HTMLAnchorElement;
        const id = target.getAttribute('href')?.substring(1);

        if (id) {
            const section = document.getElementById(id);
            section?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
