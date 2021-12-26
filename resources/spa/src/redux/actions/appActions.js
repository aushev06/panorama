import {CartApi, CategoriesApi, SettingsApi, PromotionCardsApi} from "../../core/api";
import {categoriesActions, foodActions, cartActions, settingsActions, promotionCardsActions} from "./index";
import {PRELOADER_SET_PRELOADER} from "../types";

export default {
    init: function () {
        return dispatch => {

            dispatch({
                type: PRELOADER_SET_PRELOADER,
                payload: true
            })

            Promise.all([
                SettingsApi.get().then(response => {
                   dispatch(settingsActions.setSettings(response.data.settings));
                }),
                SettingsApi.getSiteSettings().then(response => {
                    dispatch(settingsActions.setSiteSettings(response.data.siteSettings));
                }),

                PromotionCardsApi.get().then(response => {
                    dispatch(promotionCardsActions.setPromotionCards(response.data.settings));
                }),

                CartApi.getCart().then(response => {
                    dispatch(cartActions.setCartItems(response.data.cart.cartProperties))
                    dispatch(cartActions.setCartTotal(response.data.cart.total))
                }),

                CategoriesApi.get()
                    .then((response) => {
                        let categories = [];
                        response.data.data.forEach((item) => {
                            if(item.status === 1) {
                                categories.push({
                                    id: item.id,
                                    name: item.name,
                                    icon: item.icon,
                                    img: item.img,
                                    slug: item.slug,
                                    child: item.child,
                                    status: item.status
                                });
                            }
                        })
                        dispatch(categoriesActions.setCategories(categories));
                        dispatch(foodActions.setFoods(response.data.data));
                    })
                    .catch((error) => {
                        console.log(error)
                        dispatch(categoriesActions.setCategories([]));
                    })
            ])
                .finally(() => {
                    dispatch({
                        type: PRELOADER_SET_PRELOADER,
                        payload: false
                    })
                })
        }
    },

    setCartItem: function (foodPropertyId, options =  {}) {
        return dispatch => {
            CartApi.addToCart({foodPropertyId, quantity: 1, options}).finally(() => {
                getCart(dispatch)
            }).then(response => {
                window.M.toast({html: 'Товар добавлен в корзину', displayLength: 500}, )
            })
        }
    },

    decrementCartItem: function (cartItemId, quantity) {
        return dispatch => {
            CartApi.decrementCartItem({quantitiesInfo: [{id: cartItemId, quantity}]})
                .finally(() => {
                    getCart(dispatch)
                })
        }
    },

    getCart: function () {
        return dispatch => {
            getCart(dispatch);
        }
    }
}

function getCart(dispatch) {
    CartApi.getCart().then(response => {
        dispatch(cartActions.setCartTotal(response.data.cart.total));
        dispatch(cartActions.setCartItems(response.data.cart.cartProperties));
    })
}
