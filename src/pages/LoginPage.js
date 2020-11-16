import React, { Component } from "react";
import $ from "jquery";
class LoginPage extends Component {
  state={}

  render() {
    $.post( "http://localhost/dashboard/projekt/AuthAPI.php", { action: "login", mail: "koks@koksowy.pl", pass: "koks" })
		.done(function( data ) {
    document.write(data ); //data to zwrocony json
	return;
  });

	return (
      <div className='account'>
        <div className='login--wrapper'>
          <h1>Logowanie</h1>
          <form action=''>
            <ul>
              <li>
                <label htmlFor='login'>Login:</label>
                <input type='text' name='login' id='login' />
              </li>
              <li>
                <label htmlFor='password'>Hasło:</label>
                <input type='password' name='password' id='password' />
              </li>
              <li>
                <input type='checkbox' name='remember' id='remember' />
                <label htmlFor='remember'>Zapamiętaj mnie</label>
              </li>
              <li>
                <input type="submit" value="Zaloguj" className='form-btn'/>
              </li>
            </ul>
          </form>
        </div>
        <div className='register--wrapper'>
          <h1>Rejestracja</h1>
          <form onSubmit={this.onSubmit}>
            <ul>
              <li>
                <label htmlFor='register'>Login:</label>
                <input type='text' name='register' id='register' value={this.state.Reg_login} onChange={this.onChangeReg_login}/>
              </li>
              <li>
                <label htmlFor='password'>Hasło:</label>
                <input type='password' name='password' id='register-password' value={this.state.Reg_password} onChange={this.onChangeReg_password}/>
              </li>
              <li>
                <label htmlFor="email">Email:</label>
                <input type="email" name="email" id="email" value={this.state.Reg_email} onChange={this.onChangeReg_email}/>
              </li>
              <li>
                <input type="submit" value="Zarejestruj" className='form-btn'/>
              </li>
            </ul>
          </form>
        </div>
      </div>
    );
  }
};

export default LoginPage;
