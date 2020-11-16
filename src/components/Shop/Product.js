import React from 'react';
  
const Product = () => {
  return ( 
    <div className="product-box">
      <img src="" alt="t"/>
      <div className="product-box--wrapper">
        <div className="box">
          <div className="title">Tytuł</div>
          <div className="product-info">
            <span className="product-prize">Cena</span>
            <button className="addBtn">Do koszyka</button>
          </div>
        </div>
      </div>
    </div>
   );
}
 
export default Product;