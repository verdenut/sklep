import React, { Component } from 'react';
import Product from '../components/Shop/Product'
class Shop extends Component {
  state={};
  
  render() {
    // const ShopProducts = ShopItems.map((item,index) => {
    //   return (
    //       <Product key={index} className={item.title}/>
    // )})
    return (
      <div className="shop">
          <div className="collumns">
            {/* {ShopProducts} */}
            <Product />
            <Product />
            <Product />
            <Product />
        </div>
      </div>
    )
  }
}

export default Shop;