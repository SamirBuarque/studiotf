import './bootstrap';
import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom/client';
import PlanningsList from './components/PlanningsList';
import ProductsList from './components/ProductsList';
import ProdLocalList from './components/ProdLocalList';

const el = document.getElementById('plannings-root');
if (el) {
  const eventId = el.dataset.eventId;

  ReactDOM.createRoot(el).render(
    <React.StrictMode>
      <PlanningsList eventId={eventId} />
    </React.StrictMode>
  );
}
const productsRoot = document.getElementById('products-root');
if (productsRoot) {
  const eventId = productsRoot.dataset.eventId;

  ReactDOM.createRoot(productsRoot).render(
    <React.StrictMode>
      <ProductsList eventId={eventId} />
    </React.StrictMode>
  );
}
const prodLocalRoot = document.getElementById('prodLocal-root');
  if (prodLocalRoot) {
    const eventId = prodLocalRoot.dataset.eventId;
    ReactDOM.createRoot(prodLocalRoot).render(
    <React.StrictMode>
      <ProdLocalList eventId={eventId} />
    </React.StrictMode>
  );
  }

