import {CartApi} from "../api";

const CartService = {
    addToCart: (foodPropertyId) => {
        const data = {foodPropertyId: foodPropertyId, quantity: 1};

        return CartApi.addToCart(data);
    }
};

export default CartService;