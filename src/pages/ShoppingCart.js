import React, { Component } from 'react';
import {Link} from 'react-router-dom';
import CartProduct from '../components/ShoppingCart/CartProduct';

class ShoppingCart extends Component {
  state = { 
    counter: 1, //funkcja do licznika przedmiotow w koszyku
    toBuy: 139, //funkcja do sumowania koszyka
  }

  render() {
    return ( 
      <div className="shoppingcart">
        <div className="shoppingcart--message">
          <h1>Twoje zakupy</h1>
        </div>
        <div className="shoppingcart--cart-items">
          {/* diva produkt trzeba bedzie renderowac i rozrozniac na podstawie ilosci roznych towarow */}
          {/* <produkt> */}
          <CartProduct/>
          <CartProduct/>
          <div className="final-cart">
            <span>Razem: {this.state.toBuy} zł</span>
          </div>
        </div>
        <div className="cart-navigation">
          <Link to="/shop">Kontynuuj zakupy</Link>
          <button className="buy-btn">Kupuje</button>
        </div>
      </div>
     );
  }
}
 
export default ShoppingCart;