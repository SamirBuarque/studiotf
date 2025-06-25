import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function PlanningsList({ eventId }) {
  const [plannings, setPlannings] = useState([]);
  const [newPlanning, setNewPlanning] = useState("");


  const fetchPlannings = async () => {
    try {
      const response = await axios.get(`/api/${eventId}/plannings`);
      setPlannings(response.data);
    } catch (error) {
      console.log("Erro ao buscar planejamentos:", error);
      return;
    }
  };

  const addPlanning = async (e) => {
    e.preventDefault();
    if (!newPlanning.trim()) return;

    try {
      await axios.post(`/api/${eventId}/plannings`, { text: newPlanning });
    } catch (error) {
      console.log("Erro ao adicionar planejamento:", error);
      return;
    }
    setNewPlanning("");
    fetchPlannings();
  };

  const deletePlanning = async (id) => {
    try {
      await axios.delete(`/api/plannings/${id}`);
    } catch (error) {
      console.log("Erro ao deletar planejamento:", error);
      return;
    }
    fetchPlannings();
  };

  const toggleChecked = async (id) => {
    try {
      await axios.put(`/api/${eventId}/plannings/${id}`, { checked: !plannings.find(p => p.id === id).checked });
      fetchPlannings();
    } catch (error) {
      console.log("Erro ao atualizar planejamento:", error);
      return;
    }
  };



  useEffect(() => {
    fetchPlannings();
  }, [eventId]);

  return (
    <>
      <ul className="list-group">
        {plannings.map(planning => (
          <li key={planning.id} className='list-group-item d-flex justify-content-between align-items-center'>
            <div className='d-flex align-items-center gap-2'>
              <input type="checkbox" className="form-check-input" id={`planning-${planning.id}`} checked={planning.checked} onChange={() => toggleChecked(planning.id)}></input>
              <span className={planning.checked ? 'mark' : ''}>{planning.text}</span>
            </div>
            <button className="btn btn-sm btn-danger" onClick={() => deletePlanning(planning.id)}>X</button>
          </li>
        ))}
      </ul>
      <form onSubmit={addPlanning} className='d-flex my-3'>
        <input type="text"
          className="form-control me-2"
          placeholder="Novo planejamento"
          value={newPlanning}
          onChange={(e) => setNewPlanning(e.target.value)}
        />
        <button type="submit" className='btn btn-primary'>Adicionar</button>
      </form>

    </>
  );
}