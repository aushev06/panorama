import {cartActions, categoriesActions, foodActions} from "../../redux/actions";
import {CategoriesApi} from "../api";
import preloaderAction from "../../redux/actions/preloaderAction";
import cartApi from "../api/cartApi";


const CategoriesService = {

    save: (store) => {
        CategoriesApi.get()
            .then((response) => {
                let categories = [];
                response.data.data.forEach((item) => {
                    if(item.status === 1) {
                        categories.push({
                            id: item.id,
                            name: item.name,
                            icon: item.icon,
                            slug: item.slug
                        });
                    }
                })
                store.dispatch(categoriesActions.setCategories(categories));
                store.dispatch(foodActions.setFoods(response.data.data));
                store.dispatch(preloaderAction.setPreloaderStatus(false));
                cartApi.getCart().then((response) => {
                    store.dispatch(cartActions.setCart(response.data.cart));
                })
            })
            .catch((error) => {
                console.log(error)
                store.dispatch(categoriesActions.setCategories([]));
            })

    },

    byName(name) {
        return CategoriesApi.get({name})
    }
};

export default CategoriesService;
