import {
    CART_DECREMENT_ITEM,
    CART_INCREMENT_ITEM,
    CART_REMOVE_ITEM, CART_SET_ITEMS, CART_SET_TOTAL,
    CART_SET_VISIBLE
} from "../types";

export default {
    setCartVisible: payload => ({
        type: CART_SET_VISIBLE,
        payload
    }),

    cartIncrement: itemIndex => ({
        type: CART_INCREMENT_ITEM,
        payload: itemIndex,
    }),

    cartDecrement: itemIndex => ({
        type: CART_DECREMENT_ITEM,
        payload: itemIndex,
    }),

    cartRemoveItem: idx => ({
        type: CART_REMOVE_ITEM,
        payload: idx,
    }),

    setCartTotal: (payload) => ({
        type: CART_SET_TOTAL,
        payload
    }),

    setCartItems: (items) => ({
        type: CART_SET_ITEMS,
        payload: items
    })
}