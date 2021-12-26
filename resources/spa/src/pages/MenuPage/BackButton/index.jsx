import React from 'react';
import './index.css';

const BackButton = ({isClicked, refreshCategories}) => {
    return (
        <div className={'magia-col-md-12 m-lr'}>
            <a className={'categories__back-btn'} id={'categories-back-btn'} onClick={!isClicked ? refreshCategories : null}>
                <svg width="12" height="21" viewBox="0 0 12 21" fill="none">
                    <path d="M11 1L2 10.5L11 20" stroke="#294053" strokeWidth="1.56897"/>
                </svg>
                {'Назад'}
            </a>
        </div>
    );
};

export default BackButton;
