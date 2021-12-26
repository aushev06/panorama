import axios from '../config/axios'

const cartApi = {
    addToCart: (data) => {
        return axios.post(`/api/cart?_token=${localStorage.getItem('token')}`, data);
    },

    decrementCartItem: data => {
        return axios.put('/api/cart/cart-property', data);
    },

    getCart: () => {
        return axios.post(`/api/cart/get?_token=${localStorage.getItem('token')}`)
    },

    save: function (data = {}) {
        return axios.post(`/api/cart/add-order?_token=${localStorage.getItem('token')}`, data)
    },

    destroyProperty: id => {
        return axios.delete(`/api/cart/cart-property/${id}`)
    }
}

export default cartApi;
