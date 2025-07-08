import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function EventStatus({ eventId }) {
  const [status, setStatus] = useState("");

  const fetchStatus = async () => {
    try {
      const response = await axios.get(`/api/events/${eventId}/status`);
      setStatus(response.data);
    } catch (error) {
      console.log("Erro ao buscar status do evento ", error);
      return;
    }
  };

  const handleSelect = async (e) => {
    const response = await axios.post(`/api/events/${eventId}/status`, {'status': e.target.value});
    setStatus(e.target.value);
    fetchStatus();
  };

  useEffect(() => {
    fetchStatus();
  }, [eventId]);

  useEffect(() => {
    console.log("status:", status);
  }, [status]);

  const statusOptions = [
    "Planejamento",
    "Produção Fábrica",
    "Produção Local",
    "Entrega"
  ];

  return (

    <div className="col-3">
      <select className="form-select-lg px-3" value={status} onChange={handleSelect}>
        {statusOptions.map(option => (
          <option key={option} value={option}>
            {option}
          </option>
        ))}
      </select>
    </div>
  );


}