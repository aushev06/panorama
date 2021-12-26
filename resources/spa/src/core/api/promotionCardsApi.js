import axios from 'core/config/axios';

const PromotionCardsApi = {
    get: () => {
        return axios.post('/promotions/cards');
    },
};

export default PromotionCardsApi;
