import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function Inventory({ createUrl, editUrl }) {

  const [search, setSearch] = useState("");
  const [inventoryData, setInventoryData] = useState([]);
  const [response, setResponse] = useState("");

  const [showModal, setShowModal] = useState(false);
  const [idItemToDelete, setIdItemToDelete] = useState(null);


  const fetchInventory = async () => {
    try {
      const response = await axios.get('/api/inventory');
      setInventoryData(response.data);
    } catch (error) {
      console.log('erro ao buscar os inventarios', error);
      return;
    }
  }

  const handleClick = async (id) => {
    try {
      await axios.delete(`api/inventory/${id}`);
      setResponse("Inventário excluído com sucesso");
      setInventoryData(prev => prev.filter(item => item.id !== id));
      setIdItemToDelete(null);
      setShowModal(false);
    } catch (error) {
      console.error('Erro ao excluir inventario', error);
      return
    }
  }

  const handleDeleteButton = (id) => {
    console.log("botao apertado")
    console.log(id);

    setShowModal(true);
    setIdItemToDelete(id);
    console.log(showModal);
  }

  useEffect(() => {
    fetchInventory()
  }, []);


  const filteredInventory = inventoryData.filter((item) => {
    let rx = new RegExp(`${search}`, 'i');
    return rx.test(item.name) || rx.test(item.category);
  });

  return (
    <>
      {response != "" && (
        <div className="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{response}</strong>
          <button type="button" className="btn-close"
            onClick={() => setResponse("")}
            aria-label="Close"></button>
        </div>
      )}

      <div className="card-title px-3 d-flex align-items-center justify-content-between">
        <h2>Inventário</h2>
        <div className="d-flex align-items-center gap-3">
          <input type="text" name="filter" id="filter"
            onChange={(e) => setSearch(e.target.value)}
            className="form-control"
            placeholder='Pesquisar'
          />
          <a href={createUrl} className="btn btn-primary">Adicionar</a>
        </div>
      </div>
      <table className="table">
        <thead>
          <tr>
            <th scope="col"><h4>Nome</h4></th>
            <th scope="col"><h4>Categoria</h4></th>
            <th scope="col"><h4>Quantidade Total</h4></th>
            <th colSpan={2}>Ações</th>
          </tr>
        </thead>
        <tbody>
          {filteredInventory.map((item, index) => (
            <tr key={index}>
              <td>{item.name}</td>
              <td>{item.category}</td>
              <td>{item.total_quantity}</td>
              <td><button type="submit" className="btn btn-danger"
                onClick={() => handleDeleteButton(item.id)}>
                <i className="fa-solid fa-trash"></i></button></td>
              <td><a href={editUrl.replace('__ID__', item.id)}
                className="btn btn-secondary"><i
                  className="fa-solid fa-pen-to-square"></i></a></td>
            </tr>

          ))}
          {filteredInventory.length === 0 && (
            <tr>
              <td colSpan={3}>Nenhum item encontrado</td>
            </tr>
          )}

        </tbody>
      </table>

      {showModal && (
        <>
          <div className="modal-backdrop fade show" style={{ zIndex: 1040 }}></div>
          <div className="modal show fade d-block" id="confirmDeleteModal" tabIndex="-1"
            aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div className="modal-dialog">
              <div className="modal-content text-black">
                <div className="modal-header">
                  <h1 className="modal-title fs-5" id="confirmDeleteLabel">Confirmar Exclusão</h1>
                  <button type="button" className="btn-close" onClick={() => setShowModal(false)} aria-label="Fechar"></button>
                </div>
                <div className="modal-body">
                  Tem certeza que deseja excluir este item do inventário?
                </div>
                <div className="modal-footer">

                  <button type="button" className="btn btn-secondary" onClick={() => setShowModal(false)}>Cancelar</button>
                  <button type="submit" className="btn btn-danger"
                    onClick={() => handleClick(idItemToDelete)}
                  >Confirmar Exclusão</button>

                </div>
              </div>
            </div>
          </div>
        </>
      )}

    </>
  );
}