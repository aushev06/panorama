import React from 'react';

const Desktop = () => {
    return (
        <>
            <div className={'footer__navigation'}>
                <h5>Навигация</h5>
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="#ABOUT">О нас</a></li>
                    <li><a href="#PARTNER">Партнеры</a></li>
                    <li><a href="#CABINET">Личный кабинет</a></li>
                    <li><a href="#CART">Корзина</a></li>
                    <li><a href="/pay">Оплата</a></li>
                    <li><a href="/delivery">Доставка</a></li>
                </ul>
            </div>
            <div className={'footer__end-navigation'}>
                <ul>
                    <li><a href="/contact">Контакты</a></li>
                    <li><a href="#TEAM">Наша команда</a></li>
                </ul>
            </div>
        </>
    );
};

export default Desktop;
