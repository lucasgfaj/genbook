  const livros = ["HTML e CSS", "JavaScript Avançado", "Python para Iniciantes"];
  const materiais = ["Tablet Samsung", "Notebook Dell", "Calculadora Científica"];

  function atualizarOpcoes() {
    const tipo = document.getElementById("tipoItem").value;
    const itemSelect = document.getElementById("item");
    const opcoes = tipo === "livro" ? livros : materiais;

    itemSelect.innerHTML = "";
    opcoes.forEach(nome => {
      const opt = document.createElement("option");
      opt.textContent = nome;
      itemSelect.appendChild(opt);
    });
  }

  window.onload = atualizarOpcoes;