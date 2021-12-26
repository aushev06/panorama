import React from 'react';
import {connect} from "react-redux";
import {categoriesActions, foodActions} from "../../../redux/actions";
import {CategoriesApi} from "../../../core/api";

const ItemCatalog = ({id, name, icon, slug, img, click}) => {

    return (
        <li className={"MobileCatalogPageFilters_filter magia-col-md-2 marginImg"} onClick={() => click(id)}>
            <a href={`#${slug}`} data-category-id={`${id}`}>
                <img className="lazyload CatalogImg" src={`${icon || img}`} alt=""/>
                <span className={'category-text'}>{name}</span>
            </a>
        </li>
    )
};


const mapStateToProps = state => {
    return {
        foods: state.foodReducer.items,
        categories: state.categoryReducer.items,
        currentItem: state.foodReducer.currentItem
    }
};

export default connect(mapStateToProps, {...categoriesActions, ...foodActions})(ItemCatalog);

