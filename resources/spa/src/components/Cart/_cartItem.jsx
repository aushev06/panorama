import React from 'react';

export default ({name, price, count, img, increment, decrement, remove, options, sum}) => {
    return (
        <li className="cart__item">
            <div className="item__remove" onClick={remove}>
                <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.3088 14.3088L5.43628 5.43628M14.3088 5.43628L5.43628 14.3088L14.3088 5.43628Z"
                          stroke="black" strokeWidth="0.824963" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
            </div>
            <div className="item__wrapper">
                <div className="item__image">
                    <img src={img} alt={name} width="250px"/>
                </div>
                <div className="item__info">
                    <h4 className="item__title">{name}</h4>
                    <div className="item__content">
                        {/*<span className="item__options">{options}70 г.</span>*/}
                        <div>
                            <span className="item__price">{sum} рублей</span>
                            <div className="item__count">
                                <a className="item__count-btn magia-arrow-btn btn-left decrement" href="#" onClick={decrement}></a>
                                <div className="item__count-info">
                                    <span>{count}</span>
                                </div>
                                <a className="item__count-btn magia-arrow-btn btn-right increment" href="#" onClick={increment}></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    )
};
