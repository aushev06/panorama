const foodActions = {
    setFoods: (items) => ({
        type: "FOODS:SET_ITEMS",
        payload: items
    }),

    setCurrentItem: (currentItem) => ({
        type: "FOODS:SET_CURRENT_ITEM",
        payload: currentItem
    }),


    setSearchFoodsRedux: (searchValue) => ({
        type: "FOODS:SET_SEARCH_VALUE",
        payload: searchValue
    })
};

export default foodActions;
