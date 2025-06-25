import './bootstrap';
import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom/client';
import PlanningsList from './components/PlanningsList';

const el = document.getElementById('plannings-root');
if (el) {
  const eventId = el.dataset.eventId;

  ReactDOM.createRoot(el).render(
    <React.StrictMode>
      <PlanningsList eventId={eventId} />
    </React.StrictMode>
  );
}

