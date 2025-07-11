document.addEventListener('DOMContentLoaded', async () => {
  const stateSelect = document.getElementById('state');
  const citySelect = document.getElementById('city');

  const selectedState = stateSelect.getAttribute("data-selected");
  const selectedCity = citySelect.getAttribute("data-selected");

  const response = await fetch('/data/cidades.json');
  const data = await response.json();

  // 1. Preenche estados
  data.estados.forEach(estado => {
    const option = document.createElement("option");
    option.value = estado.sigla;
    option.textContent = estado.nome;
    stateSelect.appendChild(option);
  });

  // 2. Seleciona estado salvo (se houver)
  if (selectedState) {
    stateSelect.value = selectedState;
    fillCities(selectedState);
  }

  // 3. Preenche cidades ao mudar estado
  stateSelect.addEventListener("change", () => {
    fillCities(stateSelect.value);
  });

  // função que popula cidades e seleciona a correta
  function fillCities(uf) {
    citySelect.innerHTML = "<option value=''>Selecione uma cidade</option>";
    citySelect.disabled = true;

    const estado = data.estados.find(e => e.sigla === uf);
    if (estado) {
      estado.cidades.forEach(cidade => {
        const option = document.createElement("option");
        option.value = cidade;
        option.textContent = cidade;
        if (cidade === selectedCity) {
          option.selected = true;
        }
        citySelect.appendChild(option);
      });
      citySelect.disabled = false;
    }
  }
});
