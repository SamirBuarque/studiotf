import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function ProductsList({ eventId }) {

  const [products, setProducts] = useState([]);
  const [newProduct, setNewProduct] = useState("");
  const [quantity, setQuantity] = useState(0);


  const fetchProducts = async () => {
    try {
      const response = await axios.get(`/api/${eventId}/products`);
      setProducts(response.data);
      console.log("dados: ", response.data);
    } catch (error) {
      console.log("Erro ao buscar produtos:", error);
      return;
    }
  };

  const addProduct = async (e) => {
    e.preventDefault();
    if (!newProduct.trim()) return;

    try {
      await axios.post(`/api/${eventId}/products`, { name: newProduct });
    } catch (error) {
      console.log("Erro ao adicionar produto:", error);
      return;
    }
    setNewProduct("");
    fetchProducts();
  };

  const deleteProduct = async (id) => {
    try {
      await axios.delete(`/api/products/${id}`);
    } catch (error) {
      console.log("Erro ao deletar produtos:", error);
      return;
    }
    fetchProducts();
  };

  const toggleChecked = async (eventId, productId) => {
    try {
      await axios.put(`/api/${eventId}/products/${productId}`, { checked: !products.find(p => p.id === productId).checked });
      fetchProducts();
    } catch (error) {
      console.log("Erro ao atualizar planejamento:", error);
      return;
    }
  };

  const updateQuantity = async (eventId, productId, quantity) => {
    try {
      await axios.put(`/api/${eventId}/products/${productId}`, { quantity: quantity});
      fetchProducts();
    } catch (error) {
      console.log("Erro ao atualizar quantidade do produto: ", error);
      return;
    }
  }



  useEffect(() => {
    fetchProducts();
  }, [eventId]);

  return (
    <>
      <ul className="list-group">
        {products.map(product => (
          <li key={product.id} className='list-group-item d-flex align-items-center justify-content-between'>
            <div className='d-flex align-items-center gap-2'>
              <input type="checkbox" className="form-check-input" id={`product-${product.id}`} checked={product.checked} onChange={() => toggleChecked(eventId, product.id)}></input>
              <span className={product.checked ? 'text-decoration-line-through' : ''}>{product.name}</span>
            </div>
            <div className='d-flex align-items-center gap-2 justify-content-end'>
              <input type="number" value={product.quantity} 
              onChange={(e) => updateQuantity(eventId, product.id, e.target.value)}
              className="form-control form-control-sm w-25"/>
              <button className="btn btn-sm btn-danger" onClick={() => deleteProduct(product.id)}>X</button>
            </div>
          </li>
        ))}
      </ul>
      <form onSubmit={addProduct} className='d-flex my-3'>
        <input type="text"
          className="form-control me-2"
          placeholder="Novo planejamento"
          value={newProduct}
          onChange={(e) => setNewProduct(e.target.value)}
        />
        <button type="submit" className='btn btn-primary'>Adicionar</button>
      </form>

    </>
  );
}