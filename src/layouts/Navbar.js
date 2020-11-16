import React, { Component } from 'react';
import {NavLink} from 'react-router-dom'
import { MenuItems } from '../components/Nav/MenuItems.js';
import SearchMenu from '../components/Nav/SearchMenu.js';
import cartImg from '../images/Nav/shoppingcart.png';

class NavBar extends Component {
  state = {
    active: false,
    counter: 0,
    showSearchMenu: false,
    width: 0
  }
  
  showSearch() {
    const currentState = this.state.showSearchMenu;
    this.setState({
      showSearchMenu: !currentState,
    })
  }
  //pobranie vw i vh po i przed resizem
  componentDidMount() {
    this.updateWindowDimensions();
    window.addEventListener('resize', this.updateWindowDimensions);
  }
  
  componentWillUnmount() {
    window.removeEventListener('resize', this.updateWindowDimensions);
  }
  //update state po resize i przed
  updateWindowDimensions() {
    this.setState({ width: window.innerWidth });
  }
  //deklaracja funkcji do uzycia na mobile
  handleClick() {
    const currentState = this.state.active;
    this.setState({
      active: !currentState,
    })
  }

  render() {
    this.updateWindowDimensions = this.updateWindowDimensions.bind(this);

    const activeMenu = () => {
      const currentState = this.state.active;
      this.setState({
        active: !currentState,
      })
    }

    const navItems = MenuItems.map((item,index)=> {
      if(this.state.width < 768) {
        return (
        <li key={index}>
          <NavLink className={item.cName} to={item.url} onClick={this.handleClick.bind(this)}>{item.title}</NavLink>
        </li>
      )} else {
        return (
          <li key={index}>
            <NavLink className={item.cName} to={item.url}>{item.title}</NavLink>
          </li>
        )
      }
    })
    return (
      <>
        <SearchMenu showState={this.state.showSearchMenu} showSearchHandler={this.showSearch.bind(this)}/>
        <nav className="NavbarItems">
          <h1 className="navbar-logo"><NavLink to="/">Veissey</NavLink></h1>
          <button onClick={activeMenu} className="menu-btn"><i className="fas fa-bars"></i></button>
          <ul className="desktop-menu">
            {navItems}
              <li>
                <i className="fas fa-search" onClick={this.showSearch.bind(this)}></i>
              </li>
              <li>
                <div className="shopping-cart">
                  <NavLink to="/shoppingCart">
                    <img src={cartImg} alt="shopping cart"/>
                    <span className="counter">{this.state.counter}</span>
                  </NavLink>
                </div>
              </li>
          </ul>
          <div className={this.state.active ? "navbar-menu-mobile active" : "navbar-menu-mobile"}>
            <button onClick={activeMenu} className="close-menu-btn">X</button>
            <ul className="mobile-menu">
              {navItems}
              <li>
                <i className="fas fa-search" onClick={this.showSearch.bind(this)}></i>
              </li>
              <li>
                <div className="shopping-cart">
                  <NavLink to="/shoppingCart">
                    <img src={cartImg} alt="shopping cart"/>
                    <span className="counter">{this.state.counter}</span>
                  </NavLink>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </>
    )
  }
}

export default NavBar;