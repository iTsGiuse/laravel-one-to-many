import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

function getCurrentTime() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();
    const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    return formattedTime;
}

function updateTime() {
    const currentTimeElement = document.getElementById('current-time');
    currentTimeElement.textContent = getCurrentTime();
}

setInterval(updateTime, 1000);

updateTime();

const allDeleteButtons = document.querySelectorAll('.js-delete-btn');
allDeleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', function(event) {
        event.preventDefault();
        
        const deleteModal = document.getElementById('confirmDeleteModal');
        
        const projectName = this.dataset.projectName;
        deleteModal.querySelector('.modal-body').innerHTML = `Sei sicuro di voler eliminare ${projectName}?`;

        const bsDeleteModal = new bootstrap.Modal(deleteModal);
        bsDeleteModal.show();

        const modalConfirmDeletionBtn = document.getElementById('modal-confirm-deletion');
        modalConfirmDeletionBtn.addEventListener('click', function() {

            deleteButton.parentElement.submit();
        });
    });
});