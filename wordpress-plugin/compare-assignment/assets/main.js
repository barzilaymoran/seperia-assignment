
        document.querySelectorAll('.ca-gallery-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const row = document.getElementById(`gallery-${id}`);
                row.style.display = row.style.display === 'table-row' ? 'none' : 'table-row';
            });
        });
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            if (this.value === '') {
                this.form.submit();
            }
        });
