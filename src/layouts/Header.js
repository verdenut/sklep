import React from 'react';
import { useLocation } from 'react-router-dom';   
import AliceCarousel from 'react-alice-carousel';
import "react-alice-carousel/lib/alice-carousel.css";
import { HeaderImages } from '../components/Header/HeaderImages';

const Header = () => {
    let location = useLocation();
    if (location.pathname.match(/shoppingCart/) || location.pathname.match(/login/) || location.pathname.match(/userpanel/)){
      return null;
    }
    return (
      <>
        <header>
          <AliceCarousel autoPlay infinite autoPlayInterval="3000">
            {HeaderImages.map((img, index) => {
              return (
                <img className={img.cName} key={index} src={img.url} alt="header item"/>
              )
            })}
          </AliceCarousel>
      </header>
      </>
    )
}

export default Header;