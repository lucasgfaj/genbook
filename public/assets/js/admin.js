let categorias = ['Literatura', 'Técnico'];

function renderCategorias() {
  const lista = document.getElementById("listaCategorias");
  lista.innerHTML = "";
  categorias.forEach((nome, i) => {
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.innerHTML = `
      ${nome}
      <div>
        <button class="btn btn-sm btn-outline-secondary me-2" onclick="abrirModalEditar(${i})"><i class="bi bi-pencil"></i></button>
        <button class="btn btn-sm btn-outline-danger" onclick="abrirModalExcluir(${i})"><i class="bi bi-trash"></i></button>
      </div>
    `;
    lista.appendChild(li);
  });
}

function adicionarCategoria() {
  const input = document.getElementById("novaCategoria");
  const nome = input.value.trim();
  if (nome !== "") {
    categorias.push(nome);
    input.value = "";
    renderCategorias();
  }
}

function abrirModalEditar(index) {
  document.getElementById("categoriaIndex").value = index;
  document.getElementById("editarInputCategoria").value = categorias[index];
  new bootstrap.Modal(document.getElementById('modalEditarCategoria')).show();
}

function salvarEdicaoCategoria() {
  const index = document.getElementById("categoriaIndex").value;
  const novoNome = document.getElementById("editarInputCategoria").value.trim();
  if (novoNome !== "") {
    categorias[index] = novoNome;
    renderCategorias();
    bootstrap.Modal.getInstance(document.getElementById('modalEditarCategoria')).hide();
  }
}

function abrirModalExcluir(index) {
  document.getElementById("categoriaExcluirIndex").value = index;
  document.getElementById("nomeCategoriaExcluir").innerText = categorias[index];
  new bootstrap.Modal(document.getElementById('modalExcluirCategoria')).show();
}

function confirmarExclusao() {
  const index = document.getElementById("categoriaExcluirIndex").value;
  categorias.splice(index, 1);
  renderCategorias();
  bootstrap.Modal.getInstance(document.getElementById('modalExcluirCategoria')).hide();
}

function salvarValidade() {
  const item = document.getElementById("nomeItem").value;
  const data = document.getElementById("dataValidade").value;
  if (item && data) {
    alert(`Validade definida para "${item}" até ${data}`);
    document.getElementById("nomeItem").value = "";
    document.getElementById("dataValidade").value = "";
  }
}

document.addEventListener("DOMContentLoaded", renderCategorias);