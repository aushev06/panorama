import React from 'react';
import {connect} from "react-redux";
import {cartActions} from "../../../redux/actions";

const Mobile = ({setCartVisible}) => {
    return (
        <div className={'footer__navigation'}>
            <h5>Навигация</h5>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="#ABOUT">О нас</a></li>
                <li><a href="#PARTNER">Партнеры</a></li>
                <li><a href="/cabinet">Личный кабинет</a></li>
                <li><a style={{cursor: 'pointer'}} onClick={() => {setCartVisible(true)} }>Корзина</a></li>
                <li><a href="/pay">Оплата</a></li>
                <li><a href="/delivery">Доставка</a></li>
                <li><a href="/contact">Контакты</a></li>
                <li><a href="#TEAM">Наша команда</a></li>
            </ul>
        </div>
    );
};

const mapStateToProps = state => {
    return {}
};

// export default Mobile;
export default connect(mapStateToProps, {...cartActions})(Mobile);
