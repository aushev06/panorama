import React from 'react';
import {Link} from "react-router-dom";

const CouponItem = ({id, img}) => {
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));

    if(id === undefined) {
        return null;
    }

    return (
        <li
            className={'coupon-item carousel-item'}
            style={{maxHeight: isMobile ? '50vw' : 'auto', minHeight: 'auto'}}
        >
            <Link to={'/promotions'} style={{cursor: 'pointer'}} >
                {/*<img src={`/images/coupons/coupon-${id}.png`} alt={`coupon-${id}`} className={'ItemPicture'}/>*/}
                <img src={`${img}`} alt={`coupon-${id}`} className={'ItemPicture'}/>
            </Link>
            {/*<a href={'/promotions'} style={{cursor: 'pointer'}} >*/}
            {/*    <img src={`/images/coupons/coupon-${id}.png`} alt={`coupon-${id}`} className={'ItemPicture'}/>*/}
            {/*</a>*/}
        </li>
    )
};

export default CouponItem;
