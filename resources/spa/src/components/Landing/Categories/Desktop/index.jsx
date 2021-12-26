import React from 'react';
import '../index.css';
import CategoryItem from "../_item";
import {Link} from "react-router-dom";

const Desktop = ({items}) => {

    return (
        <div className={'LandingCategories__wrapper'}>
            <ul className={"magia-col-xs-15 LandingCategories paddingImg magia-col-sm-14 magia-col-md-14 m-lr"}>
                {items && items.map((item, key) => {
                    return <CategoryItem
                        id={item.id}
                        name={item.name}
                        img={item.img}
                        icon={item.icon}
                        slug={item.slug}
                        key={key}
                    />
                })}
                <li className={"carousel-item MobileCatalogPageFilters_filter marginImg"} tabIndex={0} >
                    <Link to={'/menu'} className={'item-more'}>
                        <svg viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg" style={{width: '3em', height: '3em'}}>
                            <path d="M29.915 23.184H52.525V29.568H29.915V52.178H23.398V29.568H0.655V23.184H23.398V0.441H29.915V23.184Z" fill="#EFAF84"/>
                        </svg>
                    </Link>
                    Смотреть еще
                </li>
            </ul>
        </div>
    )
};

export default Desktop;
