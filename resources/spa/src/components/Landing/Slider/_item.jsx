import React from 'react';

const SliderItems = ({item}) => {
    // const isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent));
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));
    return (
        <li className={'carousel-item'} style={{maxHeight: isMobile ? '50vw' : 'auto', minHeight: 'auto'}}>
            <a href={`#${item.slug}`}>
                {/*<img src={item.img} alt={item.name} className={'ItemPicture'}/>*/}
                <img src={'/images/coupon-new.png'} alt={item.name} className={'ItemPicture'} />
            </a>
        </li>
    )
};

export default SliderItems;
