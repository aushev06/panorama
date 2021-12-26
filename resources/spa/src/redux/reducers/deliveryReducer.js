const localStorageCities = localStorage.getItem('cities') || '';
const localStorageCity = localStorage.getItem('city') || '';
// const localStorageDelCost = localStorage.getItem('delCost') || 0;
// const localStorageDelFreeCost = localStorage.getItem('delFreeCost') || 0;

const initialState = {
    cities: localStorageCities,
    city: localStorageCity,
    // delCost: localStorageDelCost,
    // delFreeCost: localStorageDelFreeCost
};

export default (state = initialState, {type, payload}) => {
    switch (type) {
        case "DELIVERY:SET_CITIES":
            return {
                ...state,
                cities: payload
            };
        case "DELIVERY:SET_CITY":
            return {
                ...state,
                city: payload
            };
        case "DELIVERY:SET_DELIVERY_COST":
            return {
                ...state,
                delCost: payload
            };
        case "DELIVERY:SET_DELIVERY_FREE_COST":
            return {
                ...state,
                delFreeCost: payload
            };

        default:
            return state;
    }
};
