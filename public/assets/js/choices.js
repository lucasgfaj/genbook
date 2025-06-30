   document.addEventListener('DOMContentLoaded', function() {
        feather.replace();

        const authorSelect = document.querySelector('.js-choices');
        if (authorSelect) {
            new Choices(authorSelect, {
                removeItemButton: true,
                placeholderValue: 'Selecione os autores',
                searchPlaceholderValue: 'Buscar...',
                noResultsText: 'Nenhum autores encontrado',
                noChoicesText: 'Sem opções disponíveis',
            });
        }
    });