const deliveryActions = {
    setCities: (cities) => ({
        type: "DELIVERY:SET_CITIES",
        payload: cities
    }),
    setCity: (city) => ({
        type: "DELIVERY:SET_CITY",
        payload: city
    }),
    setDeliveryCost: (delCost) => ({
        type: "DELIVERY:SET_DELIVERY_COST",
        payload: delCost
    }),
    setDeliveryFreeCost: (delFreeCost) => ({
        type: "DELIVERY:SET_DELIVERY_FREE_COST",
        payload: delFreeCost
    }),
};

export default deliveryActions;
