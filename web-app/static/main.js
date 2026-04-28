// gallery toggle
document.querySelectorAll('.gallery-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const row = document.getElementById(`gallery-${id}`);
        row.style.display = row.style.display === 'table-row' ? 'none' : 'table-row';
    });
});
// auto-clear search
document.querySelector('input[name="search"]').addEventListener('input', function() {
    if (this.value === '') {
        this.form.submit();
    }
});