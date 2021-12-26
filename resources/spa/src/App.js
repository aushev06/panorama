import React, {useEffect, useState} from 'react';
import {Header, Preloader} from "./components";
import {connect, useDispatch, useSelector} from "react-redux";
import {appActions, deliveryActions} from "./redux/actions";
import Footer from "./components/Footer";
import {BrowserRouter as Router, Switch, Route, Redirect, Link} from "react-router-dom";
import MenuPage from "./pages/MenuPage";
import PayPage from "./pages/PayPage";
import ContactPage from "./pages/ContactPage";
import DeliveryPage from "./pages/DeliveryPage";
import MainPage from "./pages/MainPage";
import HomePage from "./pages/HomePage";
import CallButton from "./components/CallButton";
import LoginPage from "./pages/AuthPages/LoginPage";
import RegistrationPage from "./pages/AuthPages/RegistrationPage";
import RecoveryPage from "./pages/AuthPages/RecoveryPage";
import NewPasswordPage from "./pages/AuthPages/NewPasswordPage";
import CabinetPage from "./pages/AuthPages/CabinetPage";
import ActivatePage from "./pages/AuthPages/ActivatePage";
import PromotionsPage from "./pages/PromotionsPage";

function App({cartVisible, init, preloader, items}) {
    const [isHomePage, setIsHomePage] = React.useState(false);

    useEffect(() => {
        init();

        const isHome = location.pathname === '/';
        setIsHomePage(isHome);

        window.addEventListener('scroll', () => {
            const headerHeight = document.querySelector('.header').offsetHeight;
            const multiplier = 3;
            if (window.pageYOffset > headerHeight / multiplier) {
                setScrolling(true);
            } else {
                setScrolling(false);
            }
        });
    }, []);

    const [scrolling, setScrolling] = useState(false);

    const cities = useSelector((state) => {
        // console.log(state)
        return state.deliveryReducer.cities;
    });

    const delivery = {
        '': {
            cities: '',
            time: '',
            minCost: '',
            delCost: '',
            delFreeCost: '',
        },
        magas: {
            cities: 'Магас',
            time: '40 мин.',
            minCost: 0,
            delCost: 100,
            delFreeCost: 500,
            color: 'red'
        },
        nazran: {
            cities: 'Назрань, Экажево',
            time: '60 мин.',
            minCost: 0,
            delCost: 150,
            delFreeCost: 1000,
            color: 'yellow'
        },
        karabulak: {
            cities: 'Карабулак',
            time: '60 мин.',
            minCost: 0,
            delCost: 200,
            delFreeCost: 1500,
            color: 'blue'
        },
        malgobek: {
            cities: 'Малгобек',
            time: '60 мин.',
            minCost: 0,
            delCost: 250,
            delFreeCost: 2000,
            color: 'green',
        },

        ekazhevo: {
            cities: 'Экажево',
            time: '60 мин.',
            minCost: 0,
            delCost: 250,
            delFreeCost: 2000,
            color: 'green',
        }
    };

    if( delivery.hasOwnProperty(cities) ) {
        window.delivery = delivery[cities];
    } else {
        const dispatch = useDispatch();
        if( localStorage.getItem('cities') ) {
            localStorage.removeItem('cities');
            dispatch(deliveryActions.setCities(''));
        }
        if( localStorage.getItem('city') ) {
            localStorage.removeItem('city');
            dispatch(deliveryActions.setCity(''));
        }

        window.delivery = delivery[''];
    }

    if(preloader) {
        return  <Preloader />
    }

    const links = [
        <a href="/">Главная</a>,
        // <a href="/menu">Меню</a>,
        // <a href="/pay">Оплата</a>,
        // <a href="/promotions">Акции</a>,
        // <a href="/delivery">Доставка</a>,
        // <a href="/contact">Контакты</a>,
        // <a href="/cabinet">Личный кабинет</a>
        // <Link to="/">Главная</Link>,
        <Link to="/menu">Меню</Link>,
        <Link to="pay">Оплата</Link>,
        <Link to="promotions">Акции</Link>,
        <Link to="delivery">Доставка</Link>,
        <Link to="contact">Контакты</Link>,
        <Link to="cabinet">Личный кабинет</Link>
    ];

    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));
    const token = document.head.querySelector('meta[name="csrf-token"]');

    return (
        <Router>
            <div className={`${cartVisible && isMobile ? 'App cart-visible' : 'App'}`}>
            {/*<div className={'App'}>*/}
                <Header
                    scrolling={scrolling} style={{position: 'absolute'}}
                    links={links} cartVisible={cartVisible} isHomePage={isHomePage}
                />

                {/*<CallButton />*/}

                {/*<HomePage cartVisible={cartVisible} items={items}/>*/}
                <Switch>
                    <Route path="/menu" exact render={() => {
                        setIsHomePage(false);
                        return <MenuPage />
                    }}/>
                    <Route path="/promotions" exact render={() => {
                        setIsHomePage(false);
                        return <PromotionsPage />
                    }}/>
                    <Route path="/pay" render={() => {
                        setIsHomePage(false);
                        return <PayPage />
                    }}/>
                    <Route path="/contact" render={() => {
                        setIsHomePage(false);
                        return <ContactPage />
                    }}/>
                    <Route path="/delivery" render={() => {
                        setIsHomePage(false);
                        return <DeliveryPage />
                    }}/>
                    <Route path="/login" render={() => {
                        setIsHomePage(false);
                        return window.user ? <Redirect to={'/'} /> : <LoginPage token={token}/>
                    }}/>
                    <Route path="/register" render={() => {
                        setIsHomePage(false);
                        return window.user ? <Redirect to={'/'} /> : <RegistrationPage token={token}/>
                    }}/>
                    <Route path="/cabinet" render={() => {
                        setIsHomePage(false);
                        return window.user ? <CabinetPage token={token} /> : <Redirect to="/login"  />
                    }}/>
                    <Route path="/password/reset" render={() => {
                        setIsHomePage(false);
                        return window.user ? <Redirect to={'/'} /> : <RecoveryPage token={token}/>
                    }}/>
                    <Route path="/auth/activate" render={() => {
                        setIsHomePage(false);
                        return window.user ? <Redirect to={'/'} /> : <ActivatePage token={token}/>
                    }}/>
                    <Route path="/password/newPassword/:token" render={() => {
                        setIsHomePage(false);
                        return window.user ? <Redirect to={'/'} /> : <NewPasswordPage token={token}/>
                    }}/>

                    <Route path="/" exact render={() => {
                        setIsHomePage(true);
                        return <MainPage cartVisible={cartVisible} items={items} />
                    }}/>
                </Switch>

                <Footer />


            </div>
        </Router>
    );
}

const mapStateToProps = (state) => {

    return {
        cartVisible: state.cartReducer.visible,
        preloader: state.preloaderReducer,
        items: state.categoryReducer.items,
        settings: state.settingsReducer.items,
        siteSettings: state.settingsReducer.site.items
    }
};

export default connect(mapStateToProps, {...appActions})(App);
