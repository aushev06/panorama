import React from 'react';
import './index.css';
import {cartActions} from "../../redux/actions";
import {connect} from "react-redux";

const MobileCart = ({setCartVisible, visible, count, total}) => {
    if (true === visible || count <= 0) {
        return '';
    }
    return (
        <div onClick={setCartVisible.bind(this, true)} className={"mobile_cart"}>
            <div className={"mobile_cart_container"}>
                <div className={'d-flex align-items center'}><i className={"material-icons"}>shopping_cart</i>({total})
                </div>
            </div>
        </div>
    )
}

const mapStateToProps = state => {
    return {
        count: state.cartReducer.items.length,
        visible: state.cartReducer.visible,
        total: state.cartReducer.total
    }
}

export default connect(mapStateToProps, {...cartActions})(MobileCart);