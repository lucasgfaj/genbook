

  function gerarRelatorio() {
    const tipo = document.getElementById('tipo').value;
    const status = document.getElementById('status').value;
    const resultado = document.getElementById('resultadoRelatorio');

    if (tipo === 'Selecionar...') {
      resultado.innerHTML = '<div class="alert alert-warning">Selecione um tipo de relatório.</div>';
      return;
    }

    resultado.innerHTML = `
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between">
          <span><strong>${tipo}</strong> - Exemplo A</span><span>Status: ${status}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span><strong>${tipo}</strong> - Exemplo B</span><span>Status: ${status}</span>
        </li>
      </ul>`;
  }

  function exportarPDF() {
    alert('Função de exportação para PDF chamada.');
    // Integração com jsPDF ou equivalente aqui.
  }

  function exportarExcel() {
    alert('Função de exportação para Excel chamada.');
    // Integração com SheetJS ou equivalente aqui.
  }
