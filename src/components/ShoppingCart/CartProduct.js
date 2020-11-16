import React, { Component } from "react";
import img1 from "../../images/torebka.jpg";

let produkt = {
  nazwa: "Torebka POWER PACKED czarna ze złotem",
  kolor: "Czarny",
  cena: "139.00",
  url: img1,
};

class CartProduct extends Component {

  state = {
    counter: 1,
    prize: 139.00,
    disabled: false
  }

  handleIncrease() {
    const currentState = this.state.counter;
    this.setState({
      counter: currentState + 1,
      disabled: false
    })
  }

  handleDecrease() {
    const currentState = this.state.counter;
    if(currentState > 0) {
      this.setState({
        counter: currentState - 1,
      })
    } else {
      this.setState({
        counter: 0
      })
    }
    if(currentState === 1) {
      this.setState({
        disabled: !this.state.disabled
      })
    }
  }

  deleteProduct() {
    console.log("Funkcja do usuwania")//napisac funkcje do usuwania
  }

  render(props) {
    // let counter = props.amount;
    console.log(this.state.disabled, this.state.counter)
    return (
      <>
        <div className="cart-info">
          <button className="delete-btn" onClick={this.deleteProduct.bind(this)}>X</button>
          <img src={produkt.url} alt="d" />
          <span className="cart-info--prize">{produkt.nazwa}</span>
        </div>
        <div className="product-buttons">
          <div className="amount-buttons">
            <button disabled={this.state.disabled} onClick={this.handleDecrease.bind(this)}>-</button>
            <span>{this.state.counter}</span>
            <button onClick={this.handleIncrease.bind(this)}>+</button>
          </div>
          <span className="product-prize">{produkt.cena} zł</span>
        </div>
      </>
    );
  }
};

export default CartProduct;
