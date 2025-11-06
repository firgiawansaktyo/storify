document.querySelectorAll('[id^="modal-toggle-"]').forEach(button => {
    button.addEventListener('click', function() {
        const modalId = button.id.replace('modal-toggle-', 'qrisModal-');
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('show');
            modal.style.display = modal.classList.contains('show') ? 'block' : 'none';
            document.body.classList.toggle('modal-open', modal.classList.contains('show'));
        }
    });
});

window.addEventListener('click', function(event) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (event.target === modal) {
            modal.classList.remove('show');
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    });
});