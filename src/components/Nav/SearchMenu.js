import React from "react";

function SearchMenu(props) {
  let showSearchMenu = props.showState;
  return (
    <div className={showSearchMenu ? "search-menu-wrapper active" : "search-menu-wrapper"}>
      <button className='menu-close-btn' onClick={props.showSearchHandler}>X</button>
      <div className='search-menu'>
        <label htmlFor='search'>
          <i className='fas fa-search'></i>
        </label>
        <input type='text' name='search' id='search' className='search-input' />
        <button className='search-btn'>Szukaj</button>
      </div>
    </div>
  );
}

export default SearchMenu;
