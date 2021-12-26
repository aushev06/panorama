const initialState = {
    items: [],
    site: {
        items: [],
    }
};

export default (state = initialState, {type, payload}) => {
    switch (type) {
        case "SETTINGS:SET_ITEMS":
            return {
                ...state,
                items: payload
            };
        case "SITE_SETTINGS:SET_ITEMS":
            return {
                ...state,
                site: {
                    items: payload
                }
            }

        default:
            return state;
    }
};
