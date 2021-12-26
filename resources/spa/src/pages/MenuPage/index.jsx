import React from 'react';
import {Foods} from "../../components";
import HeaderCategory from "../../components/HeaderCategory";
import {connect} from "react-redux";
import {appActions, categoriesActions, foodActions} from "../../redux/actions";
import {CategoriesApi} from "../../core/api";
import './index.css';
import BackButton from "./BackButton";
import scrollToTop from "../../helpers/scroll";

const MenuPage = ({items, foods, setCurrentItem, categories, setFoods, setCategories, currentItem}) => {

    const [isReady, setIsReady] = React.useState(false);
    const [isChild, setIsChild] = React.useState(false);
    const [isClicked, setIsClicked] = React.useState(false);

    const childCategoryContext = React.createContext(setIsChild);

    const refreshCategories = () => {
        setIsClicked(true);
        CategoriesApi.get().then(response => {
            const categories = response.data.data;
            setCategories(categories);
            setIsChild(false);
            setIsClicked(false);
        });
    };

    React.useEffect(() => {
        scrollToTop();

        const param = location.search.split('=');

        if(param.length > 0 && param[0] === '?category_id') {
            const id = +param[1];

            let filteredFoods = foods.filter(_food => _food.id === id);
            if( currentItem !== null ) {
                filteredFoods = categories.filter(_food => _food.id === id);
            }

            let filteredCategories = categories.filter(_category => _category.id === id);
            if( filteredCategories[0].child.length === 0 ) {
                CategoriesApi.get().then(response => {
                    const categories = response.data.data;
                    setCategories(categories);
                });
            } else {
                setCategories(filteredCategories[0].child);
            }

            setFoods(filteredFoods);
            setCurrentItem(id);
        }

        setIsReady(true);
        history.pushState('', document.title, window.location.pathname);
    }, []);

    if(!isReady) return null;

    return (
        <div className={'page-wrapper'}>
            <h2>Категории</h2>
            {isChild && <BackButton isClicked={isClicked} refreshCategories={refreshCategories} />}
            <HeaderCategory setIsChild={setIsChild} isChild={isChild} />
            <Foods />
        </div>
    );
};

// export default MenuPage;

const mapStateToProps = state => {
    return {
        items: state.categoryReducer.items,
        foods: state.foodReducer.items,
        currentItem: state.foodReducer.currentItem,
        categories: state.categoryReducer.items,
    }
};

export default connect(mapStateToProps, {...appActions, ...foodActions, ...categoriesActions})(MenuPage);
