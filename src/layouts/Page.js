import React from 'react';
import { Route, Switch } from 'react-router-dom'
import Shop from '../pages/Shop';
import ErrorPage from '../pages/ErrorPage'
import HomePage from '../pages/HomePage'
import ShoppingCart from '../pages/ShoppingCart';
import About from '../pages/About';
import LoginPage from '../pages/LoginPage';
import UserPanel from '../pages/UserPanel';

const Page = () => {
  return (
      <>
      <Switch> 
          <Route path="/" exact component={HomePage} />
          <Route path="/shop" component={Shop} />
          <Route path="/shoppingcart" component={ShoppingCart} cena={130} />
          {/* <Route path="/news" component={News} />
          <Route path="/sale" component={Sale} /> */}
          <Route path="/about" component={About} />
          <Route path="/login" component={LoginPage} />
          <Route path="/userpanel" component={UserPanel} />
          <Route component={ErrorPage} />
      </Switch>
      </>
   );
}

export default Page;