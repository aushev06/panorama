import React, {useEffect} from 'react';
import SliderItems from "./_item";
import './index.css';

const MagiaSlider = ({items}) => {
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));
    const rfInterval = React.useRef(null);

    useEffect(() => {
        const elems = document.querySelectorAll('.carousel-discount');
        const options = {fullWidth: false, duration: 500, padding: 3000, dist: 0};
        M.Carousel.init(elems, options);

        rfInterval.current = setInterval(() => {
            const elem = document.querySelector('.carousel-discount');
            const instance = M.Carousel.getInstance(elem);
            instance.next();
        }, 10000);

        return () => {
            rfInterval.current && clearInterval(rfInterval.current);
        }
    },[]);

    return (
        <ul className={'carousel carousel-discount carousel-slider'}
            style={{maxHeight: isMobile ? '50vw' : 'auto', minHeight: 'auto'}}
        >
            {items && items.map( (item, key) => {
                return <SliderItems
                    key={key}
                    item={item}
                />
            })}
        </ul>
    )
};

export default MagiaSlider;
