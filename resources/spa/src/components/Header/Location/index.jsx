import React from 'react';
import './index.css';
import {useSelector} from "react-redux";

const Location = (children) => {
    const {currCities, className} = children;

    const city = useSelector((state) => {
        return state.deliveryReducer.city;
    });

    return (
        <a
            className={`location-btn waves-effect waves-light btn modal-trigger city-font ${className}`}
            href="#modal1"
        >
            <div>
                <img src="/images/icon-index/location-pin.svg" className="mobil-menu-icon-city" alt="Выберите район" />
                {/*{!localStorage.getItem('cities') ? 'Выберите город' : currCities}*/}
                {!city ? 'Выберите район' : city}
            </div>
        </a>
    )
};

export default Location;
