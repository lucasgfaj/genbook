  document.addEventListener('DOMContentLoaded', function () {
    const hasValidity = document.getElementById('hasValidity');
    const validadeDiv = document.getElementById('validityDateContainer');
    const validadeInput = document.getElementById('validityDate');

    hasValidity.addEventListener('change', function () {
      if (this.value === '1') {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const todayStr = `${yyyy}-${mm}-${dd}`;

        validadeInput.value = todayStr;
        validadeDiv.style.display = 'block';
      } else {
        validadeInput.value = '';
        validadeDiv.style.display = 'none';
      }
    });
  });