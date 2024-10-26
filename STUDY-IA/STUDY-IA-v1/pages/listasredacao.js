// Adicionar um listener a cada checkbox
document.querySelectorAll('.checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const checkboxValue = this.value;
        const isChecked = this.checked;

        // Fazer uma requisição POST para processar a mudança de seleção
        fetch('process_checkbox_redacao.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `checkbox=${checkboxValue}&checked=${isChecked}`
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch(error => console.error('Erro:', error));
    });
});

// Carregar as seleções do banco de dados ao carregar a página
window.onload = function() {
    fetch('load_checkboxes_redacao.php')
        .then(response => response.json())
        .then(data => {
            // Selections é um array com as checkboxes que o usuário marcou
            if (data.selections) {
                data.selections.forEach(selection => {
                    const checkbox = document.querySelector(`input[value="${selection}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }
        })
        .catch(error => console.error('Erro ao carregar seleções:', error));
};
