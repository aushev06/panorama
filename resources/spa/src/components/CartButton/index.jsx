import React, {useEffect} from 'react';
import './index.css';
import {connect} from "react-redux";
import {cartActions} from "../../redux/actions";

const CartButton = ({setCartVisible, total, count}) => {
    useEffect(() => {}, []);
    return (
        <a style={{cursor: 'pointer'}} className="header__cart btn-cart" onClick={() => setCartVisible(true)}>
            <img src="/images/icon-index/shopping-cart.svg" alt="Корзина" />
            {count > 0 &&
            <div className="btn-cart__counter">
                <span>{count}</span>
            </div>}
        </a>
    )
};

const mapStateToProps = state => {
    return {
        count: state.cartReducer.items?.length,
        total: state.cartReducer.total,
    }
};

export default connect(mapStateToProps, {...cartActions})(CartButton);
