document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('popup-overlay');
    const deleteBtn = document.getElementById('delete-btn');
    const cancelBtn = document.getElementById('cancel-btn');

    if (deleteBtn && cancelBtn && overlay) {
        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            overlay.style.display = 'flex';
        });

        cancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            overlay.style.display = 'none';
        });
    }
});
