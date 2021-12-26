import produce from "immer";
import {
    CART_DECREMENT_ITEM,
    CART_INCREMENT_ITEM,
    CART_REMOVE_ITEM,
    CART_SET_ITEMS, CART_SET_TOTAL,
    CART_SET_VISIBLE
} from "../types";



export default (state = {}, {type, payload}) => {
    switch (type) {
        case CART_SET_VISIBLE:
            return {
                ...state,
                visible: payload
            };
        case CART_SET_ITEMS:
            return {
                ...state,
                items: payload
            };

        case CART_INCREMENT_ITEM:
            return produce(state, (draft) => {
                draft.items[payload].quantity++;
            });

        case CART_DECREMENT_ITEM:
            return produce(state, (draft) => {
                draft.items[payload].quantity--;

                if (draft.items[payload].quantity === 0) {
                    draft.items.splice(payload, 1);
                }
            });
        case CART_REMOVE_ITEM:
            return produce(state, (draft) => {
                draft.items.splice(payload, 1);
            });

        case CART_SET_TOTAL:
            return {
                ...state,
                total: payload
            }
        default:
            return state;
    }
}
