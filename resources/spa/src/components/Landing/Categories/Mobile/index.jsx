import React, {useEffect} from 'react';
import '../index.css';
import CategoryItem from "../_item";
import {Link} from "react-router-dom";

const Mobile = ({handleClick, items}) => {

    useEffect(() => {
        const elem = document.querySelector('.LandingCategories');
        const options = {indicators: true, noWrap: true, dist: 0, padding: 70, numVisible: 4};
        const instance = M.Carousel.init(elem, options);
        instance.set(2);
    },[]);


    return (
        <ul className={"carousel carousel-slider center LandingCategories paddingImg"}>
            {items && items.map((item, key) => {
                return <CategoryItem
                    id={item.id}
                    name={item.name}
                    img={item.img}
                    icon={item.icon}
                    slug={item.slug}
                    key={key}
                    clicked={handleClick}
                />
            })}
            <li className={"carousel-item MobileCatalogPageFilters_filter marginImg"} tabIndex={0} >
                <Link to={'/menu'} className={'item-more'}>
                    <svg viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg" style={{width: '3em', height: '3em'}}>
                        <path d="M29.915 23.184H52.525V29.568H29.915V52.178H23.398V29.568H0.655V23.184H23.398V0.441H29.915V23.184Z" fill="#EFAF84"/>
                    </svg>
                </Link>
                <span className={'CategoryName'}>Смотреть еще</span>
            </li>
            {/*{getCategoryCarouselItems().map((items, key1) => {*/}
            {/*    return (*/}
            {/*        <div key={key1} className={'d-flex carousel-item'}>*/}
            {/*            {items && items.map((item, key2) => {*/}
            {/*                return <CategoryItem*/}
            {/*                    id={item.id}*/}
            {/*                    name={item.name}*/}
            {/*                    img={item.img}*/}
            {/*                    slug={item.slug}*/}
            {/*                    key={key2}*/}
            {/*                    clicked={handleClick}*/}
            {/*                />*/}
            {/*            })}*/}
            {/*            {items.length - 1 === key1 && (*/}
            {/*                <li className={"MobileCatalogPageFilters_filter marginImg"} tabIndex={0} onClick={handleClick}>*/}
            {/*                    <a href={'#MORE'} className={'item-more'}>*/}
            {/*                        <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">*/}
            {/*                            <path d="M29.915 23.184H52.525V29.568H29.915V52.178H23.398V29.568H0.655V23.184H23.398V0.441H29.915V23.184Z" fill="#EFAF84"/>*/}
            {/*                        </svg>*/}
            {/*                    </a>*/}
            {/*                    Смотреть еще*/}
            {/*                </li>*/}
            {/*            )}*/}
            {/*        </div>*/}
            {/*    )*/}
            {/*})}*/}
            {/*<ul className="carousel-item row active">*/}
            {/*    <li className={"MobileCatalogPageFilters_filter m-lr-0 wh-col-2 marginImg"} tabIndex={id} onClick={clicked}>*/}
            {/*        <a href={`#${slug}`} data-category-id={`${id}`}>*/}
            {/*            <img className="lazyload CatalogImg" src={`${img}`} alt=""/>*/}
            {/*        </a>*/}
            {/*        {name}*/}
            {/*    </li>*/}
            {/*</ul>*/}
        </ul>
        );


};

export default Mobile;
