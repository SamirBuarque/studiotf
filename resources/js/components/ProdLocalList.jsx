import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function ProdLocalList({ eventId }) {

  const [errorResponse, setErrorResponse] = useState(""); // estado para guardar erro da api
  const [showErrorResponse, setShowErrorResponse] = useState(false); // estado para exibir a resposta de erro da api
  const [successResponse, setSuccessResponse] = useState("");
  const [showSuccessResponse, setShowSuccessResponse] = useState(false);

  const [allWorkers, setAllWorkers] = useState([]); // trabalhadores não vinculados
  const [selectedWorkers, setSelectedWorkers] = useState([]); // trabalhadores selecionados para vincular ao evento
  const [linkedWorkers, setLinkedWorkers] = useState([]); // trabalhadores vinculados ao evento

  // Inventario
  const [allInventory, setAllInventory] = useState([]);
  // lista de itens solicitados para reserva
  const [reservedInventory, setReservedInventory] = useState([]);
  // lista de itens reservados para o evento
  const [reservedInventoryList, setReservedInventoryList] = useState([]);

  const fetchAllInventory = async () => {
    try {
      const response = await axios.get('/api/inventory');
      setAllInventory(response.data);
    } catch(error) {
      console.error("Erro ao buscar todo o inventário");
      return
    }
  };

  const fetchReservedInventoryList = async () => {
    try {
      const response = await axios.get(`/api/${eventId}/inventory`);
      setReservedInventoryList(response.data);
    } catch(error) {
      console.error('Erro ao buscar inventario relacionado ao evento.', error);
      return;
    }
  };

  const fetchAllWorkers = async () => {
    try {
      const response = await axios.get(`/api/${eventId}/workers`);
      setAllWorkers(response.data);
    } catch (error) {
      console.log("Erro ao buscar trabalhadores.", error);
      return;
    }
  };

  const fetchLinkedWorkers = async () => {
    try {
      const response = await axios.get(`/api/${eventId}/linked-workers`);
      setLinkedWorkers(response.data)

    } catch (error) {
      console.log("Erro ao buscar trabalhadores vinculados.", error);
    }
  };

  const linkWorkers = async (selectedWorkers) => {
    try {
      await axios.post(`/api/${eventId}/workers`, { selectedWorkers });
      const closebtn = document.getElementById("close-btn");
      closebtn.click();
      fetchLinkedWorkers();

    } catch (error) {
      console.log("Erro ao vincular os trabalhadores", error);
      return;
    }
  }

  const handleCheckbox = (worker) => {
    setSelectedWorkers(prev => {
      const alreadyLinked = prev.some(w => w.id === worker.id);
      if (alreadyLinked) {
        return prev.filter(w => w.id !== worker.id);
      } else {
        return [...prev, worker];
      }
    })
  }

  const handleUnlinkButton = async (workerId) => {
    try {
      await axios.put(`/api/unlink-worker`, { workerId });
      fetchLinkedWorkers();
      fetchAllWorkers();
    } catch (error) {
      console.log("erro ao desvincular trabalhador.", error)
      return;
    }

  }

  const handleReservation = async (inventory, inventoryQuantity) => {
    setReservedInventory(prev => {
      // se a quantidade solicitada for 0, remove o item da lista
      if (!inventoryQuantity || inventoryQuantity === '0') {
        return prev.filter(item => item.name !== inventory.name);
      }
      // procura por item existente
      const existingItemIndex = prev.findIndex(item => item.name === inventory.name);

      // se não existir o item na lista, adiciona o item. (findIndex retorna -1 se nao encontrar wtf)
      if(existingItemIndex === -1) {
        return [...prev, { 'id': inventory.id, 'name': inventory.name, 'quantity': inventoryQuantity }];
      }

      // se ja existir o item na lista, atualizar sua quantidade
      const updated = [...prev]; // cria uma copia da lista reservedInventory (prev == reservedInventory)
      // busca o item pelo index. Mantem os atributos e atualiza somente quantidade.
      updated[existingItemIndex] = {...updated[existingItemIndex], 'quantity': inventoryQuantity};
      return updated;
    })
  }

  const submitReservation = async (inventoryList) => {
    try {
      const response = await axios.post('/api/inventory/', { inventoryList: inventoryList, eventId: eventId });
      setSuccessResponse(response.data.message);
      setShowSuccessResponse(true);
    } catch(error) {
      setErrorResponse(error.response.data.message);
      setShowErrorResponse(true);
      return;
    }
    fetchReservedInventoryList();
    fetchAllInventory();
    const closeBtn = window.document.getElementById('close-btn-inventory');
    closeBtn.click();
    document.querySelectorAll('.form-quantity').forEach(input => input.value = '');
  }

  const handleDeleteInventory = async (inventoryId) => {
    try {
      const response = await axios.post(`/api/unlink-inventory`, {inventoryId: inventoryId, eventId: eventId});
      setSuccessResponse(response.data.message);
      setShowSuccessResponse(true);
      fetchReservedInventoryList();
      fetchAllInventory();
    } catch(error) {
      console.error('Erro ao excluir um inventario', error);
    }
  }

  const handleCloseErrorResponse = () => {
    setShowErrorResponse(false);
    setErrorResponse("");
  }

  const handleCloseSuccessResponse = () => {
    setShowSuccessResponse(false);
    setSuccessResponse("");
  }

  useEffect(() => {
    fetchAllInventory();
  }, []);

  useEffect(() => {
    fetchAllWorkers();
  }, []);

  useEffect(() => {
    fetchLinkedWorkers();
  }, []);

  useEffect(() => {
    fetchReservedInventoryList()
  }, []);

  return (
    <>

      {/* INÍCIO Sessão dos funcionários envolvidos */}
      <div className="card bg-dark">
        <div className="d-flex align-items-center justify-content-center gap-3 my-3">
          <h3 className="text-white">Envolvidos</h3>
          <button type="button"
            className="btn btn-outline-success"
            data-bs-toggle="modal"
            data-bs-target="#addWorker">Adicionar</button>
        </div>
      </div>

      <div className="modal fade" id="addWorker" tabIndex="-1" aria-labelledby="addWorkerLabel" aria-hidden="true">
        <div className="modal-dialog modal-dialog-scrollable">
          <div className="modal-content">
            <div className="modal-header">
              <h1 className="modal-title fs-5" id="addWorkerLabel">Trabalhadores disponíveis</h1>
              <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div className="modal-body">
              {allWorkers.length > 0 && (
                <ul className="list-group">
                  {allWorkers.map(worker => (
                    <li key={worker.id} className="list-group-item">
                      <div className="d-flex align-items-center gap-2">
                        <input type="checkbox"
                          className="form-check-input"
                          id={`worker-${worker.id}`}
                          onChange={() => handleCheckbox(worker)}></input>
                        <span>{worker.name}</span>
                      </div>
                    </li>
                  ))}
                </ul>
              )}
              {allWorkers.length == 0 && (
                <div className="d-flex">
                  <span className="text-center">Não há trabalhadores disponíveis</span>
                </div>
              )}
            </div>
            <div className="modal-footer">
              <button type="button" id="close-btn" className="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="button" className="btn btn-primary" onClick={() => linkWorkers(selectedWorkers)}>Salvar</button>
            </div>
          </div>
        </div>
      </div>

      <div className="card-body">
        {linkedWorkers.length == 0 && (
          <div className="d-flex align-items-center jusitify-content-center">
            <span>Não há trabalhadores vinculados a esse evento</span>
          </div>
        )}

        {linkedWorkers.length > 0 && (
          <div className="">
            <ul className="list-group">
              {linkedWorkers.map(worker => (
                <li key={worker.id} className="list-group-item">
                  <div className="d-flex align-items-center justify-content-between gap-2">
                    <span>{worker.name}</span>
                    <button className="btn btn-outline-danger" onClick={() => handleUnlinkButton(worker.id)}>Desvincular</button>
                  </div>
                </li>
              ))}
            </ul>
          </div>
        )}
      </div>
      {/* FIM Sessão dos funcionários envolvidos */}

        {showSuccessResponse && (
          <div className="alert alert-success alert-dismissible" role="alert">
            <strong>{successResponse}</strong> 
            <button type="button" className="btn-close" onClick={handleCloseSuccessResponse}></button>
          </div>
        )}
      {/* INÍCIO  Sessão Inventário*/}
        <div className="card bg-dark">
          <div className="d-flex align-items-center justify-content-center gap-3 my-3">
            <h3 className="text-white">Equipamento e Material</h3>
            <button type="button"
              className="btn btn-outline-success"
              data-bs-toggle="modal"
              data-bs-target="#addInventory">Adicionar</button>
          </div>
        </div>

        <div className="modal fade" 
          id="addInventory" tabIndex="-1" 
          aria-labelledby="addInventoryLabel" aria-hidden="true">
          <div className="modal-dialog modal-dialog-scrollable">
            <div className="modal-content">
              <div className="modal-header">
                <h1 className="modal-title fs-5" id="addWorkerLabel">Inventário disponível</h1>
                <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div className="modal-body">
                {showErrorResponse && (
                  <div className="alert alert-warning alert-dismissible" role="alert">
                    <strong>{errorResponse}</strong> 
                    <button type="button" className="btn-close" onClick={handleCloseErrorResponse}></button>
                  </div>
                )}
                {allInventory.length > 0 && (
                  <ul className="list-group">
                    {allInventory.map(inventory => (
                      <li key={inventory.id} className="list-group-item">
                        <div className="d-flex align-items-center justify-content-between">
                          <span>{inventory.name} - (Disponível: {inventory.available_quantity})</span>
                          <input type="number"
                          max={inventory.available_quantity}
                          min={0} 
                          className='form-control form-quantity'
                          onChange={(e) => handleReservation(inventory, e.target.value)}
                          />
                        </div>
                      </li>
                    ))}
                  </ul>
                )}
                {allInventory.length == 0 && (
                  <div className="d-flex">
                    <span className="text-center">Não há inventário disponível</span>
                  </div>
                )}
              </div>
              <div className="modal-footer">
                <button type="button" id="close-btn-inventory" className="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" className="btn btn-primary" 
                onClick={() => submitReservation(reservedInventory)}>Salvar</button>
              </div>
            </div>
          </div>
        </div>

        <div className="card-body">
        {reservedInventoryList.length == 0 && (
          <div className="d-flex align-items-center jusitify-content-center">
            <span>Não há inventário vinculado a esse evento</span>
          </div>
        )}
        {reservedInventoryList.length > 0 && (
          <table className='table'>
            <thead className='table-dark'>
              <tr>
                <th scope='col'>Nome</th>
                <th scope='col'>Categoria</th>
                <th scope='col'>Qtd. Reservada</th>
                <th scope='col'></th>
              </tr>
            </thead>
            <tbody className='table-group-divider table-divider-color'>
              {reservedInventoryList.map(inventory => (
                <tr key={inventory.id}>
                  <td>{inventory.name}</td>
                  <td>{inventory.category}</td>
                  <td>{inventory.reserved}</td>
                  <td><button className='btn btn-danger' onClick={() => handleDeleteInventory(inventory.id)}>
                    <i className="fa-solid fa-trash"></i></button></td>
                </tr>
              ))}
            </tbody>

          </table>
        )}
      </div>

      {/* FIM Sessão Inventário */}
    </>
  );
}