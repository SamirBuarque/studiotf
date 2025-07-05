import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function ProdLocalList({ eventId }) {

  const [allWorkers, setAllWorkers] = useState([]); // trabalhadores não vinculados
  const [selectedWorkers, setSelectedWorkers] = useState([]); // trabalhadores selecionados para vincular ao evento
  const [linkedWorkers, setLinkedWorkers] = useState([]); // trabalhadores vinculados ao evento

  const fetchAllWorkers = async () => {
    try {
      const response = await axios.get(`/api/${eventId}/workers`);
      setAllWorkers(response.data);
      console.log("dados: ", response.data);
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


  useEffect(() => {
    fetchAllWorkers();
  }, []);

  useEffect(() => {
    fetchLinkedWorkers();
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

      {/* INÍCIO  */}



    </>
  );
}