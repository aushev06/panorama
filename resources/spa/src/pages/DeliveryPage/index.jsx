import React from 'react';
import './index.scss';
import {connect, useSelector} from "react-redux";
import scrollToTop from "../../helpers/scroll";
import {cities} from "../../cities";

const DeliveryPage = ({siteSettings}) => {
    React.useEffect(() => {
        scrollToTop()
    }, []);

    const weekdaysOpen  = siteSettings.schedule_weekdays_open || '{schedule_weekdays_open}';
    const weekdaysClose = siteSettings.schedule_weekdays_close || '{schedule_weekdays_close}';
    const weekendOpen   = siteSettings.schedule_weekend_open || '{schedule_weekend_open}';
    const weekendClose  = siteSettings.schedule_weekend_close || '{schedule_weekend_close}';
    const freeCities  = siteSettings?.free_cities?.split(',') || [];
    const phone = useSelector(state => {
        return state?.settingsReducer?.site?.items?.phone_number || '';
    })
    const instagram = useSelector(state => {
        return state?.settingsReducer?.site?.items?.instagram || '';
    })
    return (
        <div className={'page-wrapper'}>
            <div className={'delivery-page'}>
                <div className="delivery__wrapper">

                    <div className="delivery-background">
                        <div className="delivery-block m-lr">
                            <h2>Время работы</h2>
                            <div className="delivery-block__cards">
                                <div className="delivery-block__card">
                                    <div className={'first-row'}>
                                        <p>Будние дни</p>
                                        <time>{weekdaysOpen} - {weekdaysClose}</time>
                                    </div>
                                </div>
                                <div className="delivery-block__card">
                                    <div className={'first-row'}>
                                        <p>Выходные дни</p>
                                        <time>{weekendOpen} - {weekendClose}</time>
                                    </div>
                                </div>
                                <div className="delivery-block__card time-and-quality">
                                    <div className={'second-row'}>
                                        <div>
                                            <span className={'large-text'}>50</span>
                                            <span>минут</span>
                                        </div>
                                        <hr/>
                                        <span>Среднее время доставки</span>
                                    </div>
                                </div>
                                <div className="delivery-block__card time-and-quality">
                                    <div className={'second-row'}>
                                        <div>
                                            <span className={'large-text'}>4,84</span>
                                            <span>из 5</span>
                                        </div>
                                        <hr/>
                                        <span>Оценка качества клиентов</span>
                                    </div>
                                </div>
                                <div className="delivery-block__card">
                                    <div className={'third-row'}>
                                        <h3>Бесплатная доставка</h3>
                                        <span>от 500р. по</span>
                                        <ul>
                                            {freeCities?.map(ct => {
                                                return <><li>{ct}</li>
                                                    <li>
                                                        <svg width="1" height="18" viewBox="0 0 1 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <line x1="0.8" y1="18" x2="0.800001" y2="-8.74228e-09" stroke="white" strokeWidth="0.4"/>
                                                        </svg>
                                                    </li></>
                                            })}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className={'delivery-map-block'}>
                        <div className={'delivery-map-block__wrapper'}>
                            <h2>Мы доставляем в:</h2>
                            <div className={'location-cards m-lr'}>
                                {<ul className={'location-cities'}>
                                    {
                                        cities.map( (item, index) =>
                                            (<li
                                                className={'location-city'}
                                                key={index}
                                            >
                                                {item.name}
                                            </li>)
                                        )
                                    }
                                </ul>}
                            </div>
                            <div className={'delivery-map'} style={{display: 'none'}}>
                                <div className="bg-map">

                                </div>
                                <div className="delivery-block-info">
                                    <ul>
                                        <li>
                                            <span>
                                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="2" width="31" height="31" fill="#7790AB" stroke="#294053" strokeWidth="4"/>
                                                </svg>
                                            </span>
                                            Стоимость доставки составляет 200р (от 1500р бесплатно)
                                        </li>
                                        <li>
                                            <span>
                                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="2" width="31" height="31" fill="#FCE47C" stroke="#D0AD17" strokeWidth="4"/>
                                                </svg>
                                            </span>
                                            Стоимость доставки составляет 150р (от 1000р бесплатно)
                                        </li>
                                        <li>
                                            <span>
                                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="2" width="31" height="31" fill="#86CE76" stroke="#44B32E" strokeWidth="4"/>
                                                </svg>
                                            </span>
                                            Стоимость доставки составляет 250р (от 2000р бесплатно)
                                        </li>
                                        <li>
                                            <span>
                                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="2" width="31" height="31" fill="#EF8E88" stroke="#E6504B" strokeWidth="4"/>
                                                </svg>
                                            </span>
                                            Стоимость доставки составляет 100р (Саки, Новофедоровка, Михайловка от 500р бесплатно)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div className={'delivery__about-block magia-container'}>
                            <div className={'about-block__wrapper magia-col-md-12 magia-col-xxl-10 m-lr'}>
                                <div>
                                    <h2>Мы лучшие</h2>
                                    <div>
                                        <p className={'text-info'}>
                                            Мы используем самые лучшие ингредиенты и начинаем готовить
                                            только после получения вашего заказа. Умелые руки наших поваров
                                            приготовят ваш заказ быстро, качественно, а главное — с любовью.
                                        </p>
                                        <p className={'text-info'}>
                                            На нашем сайте вы всегда можете заказать доставку еды домой, в
                                            офис курьером или самовывозом. Для этого необходимо сформировать
                                            корзину из блюд, представленных на сайте и оформить заказ.
                                        </p>
                                    </div>
                                    <img src="/images/delivery-images/we_are_best.png" alt="Картинка1"/>
                                </div>
                                <div>
                                    <h2>Просто попробуй</h2>
                                    <div>
                                        <p className={'text-info'}>
                                            Также всегда есть возможность сделать заказ по телефону  <a href={`tel:${phone}`} style={{color: '#000', fontSize: '1em'}}>{phone}</a>.
                                        </p>
                                        <p className={'text-info'}>
                                            Доставим ваш заказ в любой день недели: и в выходные, и в праздники.
                                        </p>
                                        <p className={'text-info'}>
                                            Ваш горячий завтрак, обед или ужин не остынет по дороге — мы позаботимся
                                            об этом.  Наши термосумки поддерживают температуру, а значит, заказ приедет
                                            горячим вне зависимости от расстояния до вашего дома или офиса!
                                        </p>
                                    </div>
                                    <img src="/images/delivery-images/just_try.png" alt="Картинка2"/>
                                </div>
                            </div>

                            <div className="be-aware-block magia-col-xs-16 magia-col-md-12 magia-col-xxl-10 m-lr" style={{display: 'none'}}>
                                <div className={'magia-col-md-7'}>
                                    <h2>Хотите всегда быть в курсе новых акций и скидок?</h2>
                                    <p className={'magia-col-md-12'}>Подписывайтесь на наши каналы и профили в социальных сетях,
                                        для того, чтобы всегда первыми узнавать про новые акции</p>
                                    <div className="buttons-block magia-col-xs-15 magia-col-md-12">
                                        <img src={'/images/delivery-images/mobile_image.png'} alt={'mobile'} />
                                        <a href={instagram} className={'subscribe-btn'}>Подписаться</a>
                                        <a href={instagram} className={'contacts-btn'}>
                                            Контакты
                                            <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.86816 13.801C5.22525 13.801 4.70407 14.3222 4.70407 14.9651C4.70407 15.608 5.22525 16.1292 5.86816 16.1292V13.801ZM22.1655 16.1292C22.8084 16.1292 23.3296 15.608 23.3296 14.9651C23.3296 14.3222 22.8084 13.801 22.1655 13.801V16.1292ZM14.8397 5.99327C14.3851 5.53866 13.6481 5.53866 13.1935 5.99327C12.7389 6.44787 12.7389 7.18494 13.1935 7.63955L14.8397 5.99327ZM22.1653 14.9651L22.9884 15.7882C23.443 15.3336 23.443 14.5965 22.9884 14.1419L22.1653 14.9651ZM13.1935 22.2906C12.7389 22.7452 12.7389 23.4823 13.1935 23.9369C13.6481 24.3915 14.3851 24.3915 14.8397 23.9369L13.1935 22.2906ZM5.86816 16.1292H22.1655V13.801H5.86816V16.1292ZM13.1935 7.63955L21.3421 15.7882L22.9884 14.1419L14.8397 5.99327L13.1935 7.63955ZM21.3421 14.1419L13.1935 22.2906L14.8397 23.9369L22.9884 15.7882L21.3421 14.1419Z" fill="white"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    );
};

const mapStateToProps = state => {
    return {
        siteSettings: state.settingsReducer.site.items
    }
};

export default connect(mapStateToProps, {})(DeliveryPage);
// export default DeliveryPage;
