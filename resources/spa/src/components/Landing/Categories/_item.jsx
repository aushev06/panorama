import React from 'react';
import {connect} from "react-redux";
import {appActions, foodActions} from "../../../redux/actions";
import {Link} from "react-router-dom";

const CategoryItem = ({id, name, icon, slug, img, currentItem, setCurrentItem}) => {
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));

    return (
        <li
            className={'carousel-item MobileCatalogPageFilters_filter marginImg'}
            tabIndex={id}
            // style={{opacity: !isMobile, visibility: 'visible'}}
        >
            <Link to={`/menu?category_id=${id}`}>
                <img className="lazyload CatalogImg" src={`${icon || img}`} alt=""/>
                <span className={'CategoryName'}>{name}</span>
            </Link>
        </li>
    )
};

const mapStateToProps = state => {
    return {
        currentItem: state.foodReducer.currentItem
    }
};

export default connect(mapStateToProps, {...foodActions})(CategoryItem);


// export default CategoryItem
