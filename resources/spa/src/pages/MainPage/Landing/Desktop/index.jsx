import React from 'react';
import {Link} from "react-router-dom";
import CategoryItem from "../categoryItem";

const Desktop = ({items}) => {

    return (
        <ul className={"DesktopCategories__wrapper magia-col-xs-15 magia-col-md-12 magia-col-xxl-10 m-lr"}>
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
            <li
                className={'categoryItem carousel-item'}
                tabIndex={0}
            >
                <Link to={'/menu'} className={'item-more'}>
                    <svg viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg" >
                        <path d="M29.915 23.184H52.525V29.568H29.915V52.178H23.398V29.568H0.655V23.184H23.398V0.441H29.915V23.184Z" fill="#EFAF84"/>
                    </svg>
                    <span className={'CategoryName watch-more'}>Смотреть еще</span>
                </Link>

            </li>
            {/*<li className={"carousel-item MobileCatalogPageFilters_filter marginImg"} tabIndex={0} >*/}
            {/*    <Link to={'/menu'} className={'item-more'}>*/}
            {/*        <svg viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg" style={{width: '3em', height: '3em'}}>*/}
            {/*            <path d="M29.915 23.184H52.525V29.568H29.915V52.178H23.398V29.568H0.655V23.184H23.398V0.441H29.915V23.184Z" fill="#EFAF84"/>*/}
            {/*        </svg>*/}
            {/*    </Link>*/}
            {/*    Смотреть еще*/}
            {/*</li>*/}
        </ul>
    )
};

export default Desktop;
