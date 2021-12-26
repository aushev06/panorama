import React from 'react';
import CategoryMenuItem from "./itemCatalog";
import {appActions, categoriesActions, foodActions} from "../../../redux/actions";
import {CategoriesApi} from "../../../core/api";
import {connect} from "react-redux";

const MobileCatalog = ({items, foods, categories, setCategories, setFoods, setCurrentItem, currentItem, setIsChild, isChild}) => {

    React.useEffect(() => {
        if(isChild && foods[0].child.length > 0) {
            window.scrollTo(0, 0);
        }
    }, [foods]);

    const handleClick = (id) => {
        let filteredFoods = foods.filter(_food => _food.id === id);
        if( currentItem !== null ) {
            filteredFoods = categories.filter(_food => _food.id === id);
        }

        let filteredCategories = categories.filter(_category => _category.id === id && _category.status === 1);
        if( filteredCategories[0].child.length === 0 ) {
            setIsChild(false);
            CategoriesApi.get().then(response => {
                const categories = response.data.data;
                setCategories(categories);
            });
        } else {
            setIsChild(true);
            setCategories(filteredCategories[0].child);
        }

        setFoods(filteredFoods);
        setCurrentItem(id);
    };

    return (
        <ul className={"page-menu-categories MobileCatalogPageFilters_filters paddingImg row magia-col-xs-15 magia-col-md-12"}>
            {items && items.map((item, key) => {
                return <CategoryMenuItem
                    id={item.id}
                    name={item.name}
                    icon={item.icon}
                    img={item.img}
                    slug={item.slug}
                    key={key}
                    click={handleClick}
                />
            })}

        </ul>

    )
};

const mapStateToProps = state => {
    return {
    }
};

// export default MobileCatalog;
export default connect(mapStateToProps, {...categoriesActions, ...foodActions})(MobileCatalog);
