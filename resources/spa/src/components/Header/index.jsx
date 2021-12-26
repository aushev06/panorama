import React, {useEffect} from 'react';
// import logo from 'static/imgs/logo.png';
import logo from 'static/imgs/logo.png';
import logoMobile from 'static/imgs/logo.png';
import {CartButton} from "components";
import Location from "./Location";
import LocationModal from "./Location/Modal";
import './index.css';
import {Cart} from "../index";
import {Link} from "react-router-dom";
import {useSelector} from "react-redux";

const Header = (children) => {
    const {scrolling} = children;
    const {links} = children;
    const user = window.user;
    const delivery = window.delivery;
    const [clickedHref, setClieckedHref] = React.useState('');
    const {cartVisible} = children;
    const {isHomePage} = children;

    const phone = useSelector(state => {
        return state?.settingsReducer?.site?.items?.phone_number || '';
    })


    const mail = useSelector(state => {
        return state?.settingsReducer?.site?.items?.mail || '';
    })

    const instagram = useSelector(state => {
        return state?.settingsReducer?.site?.items?.instagram || '';
    })

    const handleClick = (e) => {
        setClieckedHref(e.target.href);
    };

    const closeMenu = (e) => {
        setClieckedHref(e.target.href);

        const menu = document.getElementById('mobile-menu');
        const instance = M.Sidenav.getInstance(menu);
        instance && instance.close();
    };

    // const isHomePage = location.pathname === '/';

    useEffect(() => {
        const menu = document.getElementById('mobile-menu');
        const instance = M.Sidenav.init(menu);
    }, []);


    // Найти совпадение: 'Саки, Новофедоровка,'
    const regex = /(\W+?,){2}/;
    // Если есть совпадение, то 'Саки, Новофедоровка,'. Если совпадений нет - 'Другие районы'
    const cities = delivery.cities ? delivery.cities.match(regex) || delivery.cities : '' ;
    // Если совпадение было - берем первое: 'Саки, Новофедоровка ...'. Если нет - 'Другие районы'
    const currCities = Array.isArray(cities) ? cities[0].slice(0, -1) + ' ...' : cities;

    return (
        <div
            className={`${scrolling || !isHomePage ? 'navbar-fixed header' : 'header'} magia-container`}
            style={children.style}
        >
            {/*<nav>*/}
            {/*<div className="nav-wrapper header-container">*/}
            <nav className={'magia-col-xs-16 magia-col-md-16'}>
                <div className="nav-wrapper m-lr magia-col-md-14 magia-col-xxl-12">
                    <a href="/" className="magia-logo hide-on-med-and-down">
                        <img src={logo} height={'80'} style={{height: '80px'}} className={"responsive-img"} alt={"Магия-Доставка Еды"}/>
                    </a>
                    <a data-target="mobile-menu" className="sidenav-trigger">
                        <i className="material-icons">menu</i>
                        {/* icon burger */}
                    </a>

                    <a href={`tel:${phone}`} className={'callback-phone-button hide-on-med-and-down'}>
                        <div className="img-circleblock"></div>
                    </a>

                    <ul className={'hide-on-med-and-down mobile-menu'}>
                        {links.length > 0 && links.map((link, key) => {
                            return <li className={'hide-on-med-and-down'} key={key} onClick={closeMenu}>{link}</li>
                        })}
                    </ul>

                    <a href="/" className="magia-logo hide-on-large-only">
                        <img src={logo} className={"responsive-img"} alt={"Магия-Доставка Еды"}/>
                    </a>

                    <Location currCities={currCities} className={'hide-on-med-and-down'} />

                    <div style={{display: 'flex', flexDirection: 'row', alignItems: 'center'}}>
                        <a href={`tel:${phone}`} className={'callback-phone-button hide-on-large-only'}>
                            <div className="img-circleblock"></div>
                        </a>
                        <CartButton />
                    </div>

                    <Cart cartVisible={cartVisible}/>
                </div>
            </nav>

            <ul className="sidenav magiya-font-text" id="mobile-menu">
                <div className="mobile-nav__header">
                    <span className="header__info">
                        Меню
                    </span>
                    <span className="sidenav-close header__close-icon">
                        <svg version="1.1" viewBox="0 0 512 512" className="close-icon svg-icon svg-fill">
                            <path pid="0" d="M505.943 6.058c-8.077-8.077-21.172-8.077-29.249 0L6.058 476.693c-8.077 8.077-8.077 21.172 0 29.249A20.612 20.612 0 0 0 20.683 512a20.614 20.614 0 0 0 14.625-6.059L505.943 35.306c8.076-8.076 8.076-21.171 0-29.248z"></path>
                            <path pid="1" d="M505.942 476.694L35.306 6.059c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l470.636 470.636a20.616 20.616 0 0 0 14.625 6.058 20.615 20.615 0 0 0 14.624-6.057c8.075-8.078 8.075-21.173-.001-29.25z"></path>
                        </svg>
                    </span>
                </div>

                <a href="/" className="magia-logo">
                    <img src={logoMobile} className={"responsive-img"} alt={"Магия-Доставка Еды"}/>
                </a>
                <ul className={'mobil-menu-list'}>
                    {links.length > 0 && links.map((link, key) => {
                        return <li className={'mobil-menu-link'} key={key} onClick={closeMenu}>{link}</li>
                    })}
                    {/*<li className={'mobil-menu-link'} onClick={closeMenu}>*/}
                    {/*    <Link to={'/cabinet'}>Личный кабинет</Link>*/}
                    {/*</li>*/}
                </ul>

                <ul className={'mobile-nav__footer'}>
                    <li>Следи за нами</li>
                    <ul className={'d-flex'}>
                        <li className={'d-flex social-icons'}>
                            <a href={instagram} target="_blank" className={'d-flex align-items-center'}>
                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.3776 9.2683C23.3663 8.42308 23.2081 7.58626 22.91 6.79528C22.6515 6.1281 22.2566 5.52217 21.7507 5.01622C21.2447 4.51027 20.6388 4.11542 19.9716 3.8569C19.1908 3.5638 18.3659 3.40531 17.5321 3.38819C16.4585 3.3402 16.1181 3.32681 13.3929 3.32681C10.6677 3.32681 10.3184 3.32681 9.25259 3.38819C8.41913 3.40544 7.59463 3.56392 6.81417 3.8569C6.14688 4.11524 5.54086 4.51003 5.03489 5.016C4.52892 5.52197 4.13413 6.12799 3.87579 6.79528C3.5821 7.5755 3.42396 8.40019 3.4082 9.2337C3.36021 10.3084 3.3457 10.6488 3.3457 13.374C3.3457 16.0992 3.3457 16.4474 3.4082 17.5143C3.42494 18.349 3.58229 19.1726 3.87579 19.9549C4.13457 20.622 4.52964 21.2278 5.03579 21.7336C5.54193 22.2393 6.148 22.6339 6.81529 22.8922C7.59361 23.1971 8.41826 23.3669 9.25371 23.3944C10.3284 23.4424 10.6688 23.4569 13.394 23.4569C16.1192 23.4569 16.4685 23.4569 17.5343 23.3944C18.3681 23.378 19.193 23.2199 19.9738 22.9268C20.6408 22.668 21.2466 22.273 21.7525 21.7671C22.2584 21.2612 22.6534 20.6554 22.9122 19.9884C23.2057 19.2072 23.3631 18.3836 23.3798 17.5478C23.4278 16.4742 23.4423 16.1338 23.4423 13.4075C23.4401 10.6822 23.4401 10.3363 23.3776 9.2683ZM13.3862 18.5276C10.536 18.5276 8.22701 16.2186 8.22701 13.3684C8.22701 10.5182 10.536 8.20923 13.3862 8.20923C14.7545 8.20923 16.0667 8.75279 17.0343 9.72032C18.0018 10.6879 18.5454 12.0001 18.5454 13.3684C18.5454 14.7367 18.0018 16.049 17.0343 17.0165C16.0667 17.984 14.7545 18.5276 13.3862 18.5276ZM18.7507 9.22143C18.0845 9.22143 17.5477 8.68353 17.5477 8.0184C17.5477 7.86049 17.5788 7.70412 17.6392 7.55823C17.6996 7.41234 17.7882 7.27978 17.8999 7.16812C18.0115 7.05647 18.1441 6.96789 18.29 6.90746C18.4359 6.84703 18.5922 6.81593 18.7502 6.81593C18.9081 6.81593 19.0644 6.84703 19.2103 6.90746C19.3562 6.96789 19.4888 7.05647 19.6004 7.16812C19.7121 7.27978 19.8007 7.41234 19.8611 7.55823C19.9215 7.70412 19.9526 7.86049 19.9526 8.0184C19.9526 8.68353 19.4147 9.22143 18.7507 9.22143Z" fill="#D9D9D9"/>
                                    <path d="M13.384 16.7197C15.2349 16.7197 16.7353 15.2193 16.7353 13.3684C16.7353 11.5175 15.2349 10.0171 13.384 10.0171C11.5331 10.0171 10.0327 11.5175 10.0327 13.3684C10.0327 15.2193 11.5331 16.7197 13.384 16.7197Z" fill="#D9D9D9"/>
                                </svg>
                            </a>
                        </li>
                        {/*<li className={'d-flex social-icons'}>*/}
                        {/*    <a href="http://facebook.com/" target="_blank" className={'d-flex align-items-center'}>*/}
                        {/*        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">*/}
                        {/*            <path d="M14.9506 23.4323V14.2858H18.0362L18.4949 10.7046H14.9506V8.42351C14.9506 7.39011 15.2385 6.68258 16.7216 6.68258H18.6009V3.48976C17.6865 3.39176 16.7674 3.34445 15.8478 3.34803C13.1203 3.34803 11.2477 5.01307 11.2477 8.06975V10.6979H8.18213V14.2791H11.2544V23.4323H14.9506Z" fill="#D9D9D9"/>*/}
                        {/*        </svg>*/}
                        {/*    </a>*/}
                        {/*</li>*/}
                    </ul>
                </ul>
            </ul>

            <LocationModal
                id="modal1"
                className="modal magiya-font-text"
                delivery={delivery}
            />
        </div>
    )
};

export default Header;
