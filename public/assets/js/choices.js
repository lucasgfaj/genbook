document.addEventListener("DOMContentLoaded", function () {
  feather.replace();

  const authorsSelect = document.querySelector(".js-choices");
  if (authorsSelect) {
    new Choices(authorsSelect, {
      removeItemButton: true,
      placeholderValue: "Selecione os autores",
      searchPlaceholderValue: "Buscar...",
      noResultsText: "Nenhum author encontrado",
      noChoicesText: "Sem opções disponíveis",
    });
  }
});
