import React, {useEffect} from 'react';
import CouponItem from "./couponItem";
import {PromotionCardsApi} from "../../../core/api";
import {connect} from "react-redux";
import promotionCardsActions from '../../../redux/actions/promotionCardsActions';

const CouponSlider = ({items = [], setPromotionCards}) => {
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));
    const [discountItems, setDiscountItems] = React.useState([items]);
    const [newItems, setNewItems] = React.useState([]);
    const [itemWidth, setItemWidth] = React.useState(0);
    const [isLoaded, setIsLoaded] = React.useState(false);

    useEffect(() => {
        PromotionCardsApi.get().then(response => {
            const promotionCards = response.data.data;
            setDiscountItems(promotionCards);
        })
        // if (items && items.length > 0) {
        //     setDiscountItems(items);
        // } else {
        //     PromotionCardsApi.get().then(response => {
        //         const promotionCards = response.data.data;
        //         setDiscountItems(promotionCards);
        //     })
        // }
        setTimeout(() => {
            setIsLoaded(true);
        }, 10);
    }, []);

    useEffect(() => {
        if (discountItems.length > 0) {
            const nItems = discountItems.slice();
            setNewItems([...nItems, ...nItems, nItems[0]]);
            setImgWidth();
        }

    },[discountItems]);

    window.addEventListener("orientationchange", function(event) {
        setImgWidth();
    });

    const setImgWidth = () => {
        if (discountItems[0].id === undefined) {
            return null;
        }
        const img = new Image();
        img.onload = () => {
            const element = document.querySelector('.ItemPicture');
            const style = getComputedStyle(element);
            const imgStyleHeight = Number.parseInt(style.height);
            const imgWidth = (img.width * imgStyleHeight / img.height).toFixed();
            setItemWidth(imgWidth * discountItems.length);
        };
        const src = `/images/coupons/coupon-${discountItems[0].id}.png`;
        img.src = src;
    };

    const carouselClassName = ['carousel coupon-slider__items'];

    if(isLoaded) {
        carouselClassName.push('animate-carousel');
    }

    return (
        <ul
            // className={'carousel carousel-discount carousel-slider'}
            className={carouselClassName.join(' ')}
            style={{width: itemWidth + "px"}}
        >
            {newItems && newItems.map( (item, key) => {
                return <CouponItem
                    key={key}
                    id={item.id}
                    setItemWidth={setItemWidth}
                    img={item.img}
                />
            })}
        </ul>
    )
};

const mapStateToProps = state => {
    return {
        promotionCards: state.promotionCardsReducer.items,
    }
};

export default connect(mapStateToProps, {...promotionCardsActions})(CouponSlider);
// export default CouponSlider;
