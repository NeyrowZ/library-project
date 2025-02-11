for (const id of ['basket', 'close']) {
    document.getElementById(id).addEventListener('click', () => {
        document.getElementById('basket-menu').classList.toggle('visible');
    });
}