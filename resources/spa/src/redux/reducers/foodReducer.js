const initialState = {
    items: [],
    currentItem: null
};

export default (state = initialState, {type, payload}) => {
    switch (type) {
        case "FOODS:SET_ITEMS":
            return {
                ...state,
                items: payload
            };
        case "FOODS:SET_CURRENT_ITEM":
            return {
                ...state,
                currentItem: payload
            };

        default:
            return state;
    }
};
