const input = document.getElementById("authorFullName");
const suggestionsBox = document.getElementById("authorSuggestions");

input.addEventListener("input", async function () {
  const query = this.value.trim();
  suggestionsBox.innerHTML = "";

  if (query.length < 3) return;

  try {
    const res = await fetch(`/authors-api/fetch?q=${encodeURIComponent(query)}`);
    const data = await res.json();
    const authors = data.docs || [];

    authors.slice(0, 5).forEach((author) => {
      const li = document.createElement("li");
      li.classList.add("list-group-item", "list-group-item-action", "d-flex", "justify-content-between", "align-items-center");
      li.style.cursor = "pointer";

      const name = author.name;
      const topWork = author.top_work ? `Conhecido por: ${author.top_work}` : "Obra não encontrada";

      li.innerHTML = `
        <div>
          <strong>${name}</strong><br>
          <small class="text-muted">${topWork}</small>
        </div>
      `;

      li.addEventListener("click", () => {
        input.value = author.name;
        suggestionsBox.innerHTML = "";

        if (author.top_work) {
          document.getElementById("authorBio").value = author.top_work;
        }

        if (author.birth_date) {
          const year = author.birth_date.match(/\d{4}/)?.[0];
          if (year) {
            document.getElementById("authorBirthDate").value = `${year}-01-01`;
          }
        }
      });

      suggestionsBox.appendChild(li);
    });

    if (authors.length === 0) {
      const li = document.createElement("li");
      li.classList.add("list-group-item", "text-muted");
      li.textContent = "Nenhum autor encontrado.";
      suggestionsBox.appendChild(li);
    }

  } catch (err) {
    console.error("Erro ao buscar autores:", err);
  }
});

document.addEventListener("click", function (e) {
  if (!suggestionsBox.contains(e.target) && e.target !== input) {
    suggestionsBox.innerHTML = "";
  }
});
