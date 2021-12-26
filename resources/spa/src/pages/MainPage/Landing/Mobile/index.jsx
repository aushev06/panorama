import React, {useEffect} from 'react';
import CategoryItem from "../categoryItem";
import {Link} from "react-router-dom";

const Mobile = ({items}) => {

    useEffect(() => {
        const elem = document.querySelector('.MobileCategories__wrapper');
        const options = {
            indicators: true, noWrap: true, dist: 0, padding: 70, numVisible: 3};

        const instance = M.Carousel.init(elem, options);

        instance.set(2);
    },[]);


    return (
        <ul className={"MobileCategories__wrapper carousel"}>
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
            <li className={"categoryItem carousel-item"} tabIndex={0} >
                <Link to={'/menu'} className={'item-more'}>
                    <svg viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg" style={{width: '3em', height: '3em'}}>
                        <path d="M29.915 23.184H52.525V29.568H29.915V52.178H23.398V29.568H0.655V23.184H23.398V0.441H29.915V23.184Z" fill="#EFAF84"/>
                    </svg>
                    <span className={'CategoryName watch-more'}>Смотреть еще</span>
                </Link>
            </li>
        </ul>
    );


};

export default Mobile;
