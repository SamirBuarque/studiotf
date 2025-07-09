document.addEventListener('DOMContentLoaded', async () => {
  const stateSelect = document.getElementById('state');
  const citySelect = document.getElementById('city');
  
  const response = await fetch('/data/cidades.json');
  const data = await response.json();

  data['estados'].forEach(estado => {
    const option = document.createElement("option");
    option.value = estado.sigla;
    option.textContent = estado.nome;
    stateSelect.appendChild(option);
  });

  stateSelect.addEventListener("change", () => {
    const selectedState = stateSelect.value;
    citySelect.innerHTML = "<option value=''>Selecione uma cidade</option>";
    citySelect.disabled = true;

    const state = data['estados'].find(e => e.sigla === selectedState);
    if (state) {
      state.cidades.forEach(cidade => {
        const option = document.createElement("option");
        option.value = cidade;
        option.textContent = cidade;
        citySelect.appendChild(option);
      })
      citySelect.disabled = false;
    }
  });

})
