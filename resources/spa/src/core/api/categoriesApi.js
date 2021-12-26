import axios from 'core/config/axios';

const CategoriesApi = {
    get: (params = {}) => {
        return axios.get(`/api/foods`, {params});
    }
}

export default CategoriesApi;