
function openModal() {
    const modal = document.getElementById('editModal');
    modal.style.display = 'flex';
}

// Cerrar el modal
function closeModal() {
    const modal = document.getElementById('editModal');
    modal.style.display = 'none';
}

// Cerrar el modal al hacer clic fuera del contenido
window.onclick = function (event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};
