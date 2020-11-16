import React, { Component } from 'react';

class UserPanel extends Component {
  state = {
    active: false
  }
  render () {
    return (
      <div className="userPanel">
        <div className="userPanel--menu">
          <h2>Panel użytkownika</h2>
          <button className="btn" onClick={() => {
            this.setState({
              active: !this.state.active
            })
          }}>Historia zakupów</button>
        </div>
        <div className={this.state.active ? "userPanel--his active" : "userPanel--his"}>
          Tutaj historia
        </div>
      </div>
    );
  }
}
 
export default UserPanel;