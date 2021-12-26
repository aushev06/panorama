import axios from 'core/config/axios';

const SettingsApi = {
    get: () => {
        return axios.post('/app/settings');
    },
    getSiteSettings: () => {
        return axios.post('app/siteSettings');
    }
};

export default SettingsApi;
