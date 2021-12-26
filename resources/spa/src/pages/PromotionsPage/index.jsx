import React from 'react';
import './index.scss';
import promotionsData from "./data";
import axios from 'axios';
import {Preloader} from "../../components";

const PromotionsPage = () => {
    const [promotions, setPromotions] = React.useState([]);
    const [promotionInfo, setPromotionInfo] = React.useState({});
    const [isLoaded, setIsLoaded] = React.useState(false);
    const infoRef = React.useRef(null);

    const scrollToRef = (ref) => {
        if(ref.current) {
            const headerOffset = document.querySelector('.navbar-fixed.header.magia-container').offsetHeight;
            return window.scrollTo({top: ref.current.offsetTop - headerOffset - 10, behavior: 'smooth'});
        }
    };

    React.useEffect(() => {
        setIsLoaded(false);
        axios.get('/api/promotions')
            .then(response => {
                const promotionsData = response.data.data.map((item, index) => {
                    item.active = index === 0;
                    return item;
                });

                setPromotions(promotionsData);
                const promotion = promotionsData.filter(item => item.active === true);
                setPromotionInfo(...promotion);

                scrollToRef(infoRef);
            });

        setIsLoaded(true);
    }, []);

    const changeActivePromotion = (id) => {
        const promInfo = {...promotionInfo};
        promInfo.active = false;

        const _promotions = JSON.parse(JSON.stringify(promotions));
        _promotions.map((item) => {
            if(item.id === promInfo.id) item.active = false;
            if(item.id === id) item.active = true;
        });

        const promotion = _promotions.filter(item => item.id === id)[0];
        setPromotionInfo(promotion);
        setPromotions(_promotions);
    };

    const clickPromotion = (e, id) => {
        changeActivePromotion(id);
        scrollToRef(infoRef);
    };

    if(!isLoaded) return <Preloader />;

    return (
        <div className={'page-wrapper'}>
            <div className={'magia-container'}>
                <div className={'promotions-page magia-col-xs-15 magia-col-md-12 m-lr'}>
                    <h2>Акции</h2>

                    <div className={'promotions__wrapper'}>
                        <div className={'block-cards'}>

                            {promotions.length > 0 && promotions.map((item) => {
                                return (
                                    <div className={ (item.active ? 'promotion-active ' : '') + 'block-cards__background'}
                                         key={item.id}
                                         onClick={(e) => clickPromotion(e, item.id)}
                                    >
                                        <div className={'block-cards__wrapper magia-col-xs-14'}>
                                            <div className={'wrapper__text magia-col-xs-14'}>{item.name}</div>
                                            <div className={'wrapper__discount'}>
                                                <span>{item.discount}</span>
                                            </div>
                                        </div>
                                    </div>
                                )
                            })}

                        </div>

                        <div className={'block-info'} ref={infoRef}>
                            {promotionInfo.hasOwnProperty('name') && (
                                <div className={'block-info__text'}>
                                    <div>
                                        <h2>{promotionInfo.name}</h2>
                                        {promotionInfo.info.split('\n').map((text, key) => {
                                            return (
                                                <p key={key} >{text}</p>
                                            )
                                        })}

                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default PromotionsPage;
