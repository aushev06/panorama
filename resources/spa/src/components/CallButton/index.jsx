import React from 'react';
import './index.css';

const CallButton = () => {
    return (
        <a href="tel:+79781030767" id={'popup__toggle'}>
            <div className="circlephone"></div>
            <div className="img-circle">
                <div className="img-circleblock"></div>
            </div>
        </a>
    );
};

export default CallButton;
