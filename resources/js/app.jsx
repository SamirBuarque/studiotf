import './bootstrap';
import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom/client';
import PlanningsList from './components/PlanningsList';
import ProductsList from './components/ProductsList';
import ProdLocalList from './components/ProdLocalList';
import EventStatus from './components/EventStatus';
import Inventory from './components/Inventory';

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

const eventStatusRoot = document.getElementById('event-status-root');
  if (eventStatusRoot) {
    const eventId = eventStatusRoot.dataset.eventId;
    ReactDOM.createRoot(eventStatusRoot).render(
    <React.StrictMode>
      <EventStatus eventId={eventId} />
    </React.StrictMode>
  );
  }

const inventoryRoot = document.getElementById('inventory-root');
  if (inventoryRoot) {
    ReactDOM.createRoot(inventoryRoot).render(
    <React.StrictMode>
      <Inventory createUrl={window.laravelRoutes.createInventoryUrl} 
        editUrl={window.laravelRoutes.createInventoryEditUrl}/>
    </React.StrictMode>
  );
  }