import React, { Component } from 'react';
import { BrowserRouter as Router } from 'react-router-dom';
import '../styles/App.min.css';
import Navbar from './Navbar.js'
import Header from './Header.js'
import Page from './Page.js'

class App extends Component {
  render() {
    return (
      <Router>
        <div className="App">
          <Navbar/>
          <Header/>
          <Page/>
        </div>
      </Router>
    );
  }
}

export default App;
