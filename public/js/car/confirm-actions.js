document.addEventListener('DOMContentLoaded', () => {
    const delete_overlay = document.getElementById('popup-overlay');
    const sell_overlay = document.getElementById('sell-overlay'); // fixed typo

    const deleteBtn = document.getElementById('delete-btn');
    const sellBtn = document.getElementById('car_sell-btn');

    const deleteCancelBtn = document.getElementById('cancel-btn'); // for delete popup
    const sellCancelBtn = document.getElementById('sell-cancel-btn'); // you need this in your HTML

    // Delete popup
    if (deleteBtn && deleteCancelBtn && delete_overlay) {
        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            delete_overlay.style.display = 'flex';
        });

        deleteCancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            delete_overlay.style.display = 'none';
        });
    }

    // Sell popup
    if (sellBtn && sellCancelBtn && sell_overlay) {
        sellBtn.addEventListener('click', (e) => {
            e.preventDefault();
            sell_overlay.style.display = 'flex';
        });

        sellCancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            sell_overlay.style.display = 'none';
        });
    }
});
