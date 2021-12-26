import React, {useState} from 'react';

const MobileFoodItem = ({name, description, img, properties, selectFood, weight, food}) => {
    const [hideButton, setHideButton] = useState(true);
    const [idxFood, setIdxFood] = useState(0);

    React.useEffect(() => {
        const elems = document.querySelectorAll('.materialboxed');
        const instances = M.Materialbox.init(elems, {});
    }, []);

    return (
        <li className={"MobileRestaurantPageMenuItem_root"}>
            <div
                className={"UIMagicalImage_root MobileRestaurantPageMenuItem_coverRoot UIMagicalImage_loaded"}>
                <img
                    className={"lazyload materialboxed UIMagicalImage_image MobileRestaurantPageMenuItem_coverImage"}
                    data-src={img}
                    src={img}
                    alt={food.name}
                    title={food.name}
                />
            </div>
            <div className={"MobileRestaurantPageMenuItem_details"}>
                <h3 className={"MobileRestaurantPageMenuItem_name MobileRestaurantPageMenuItem_common"}>{name}
                    <span
                        className={"MobileRestaurantPageMenuItem_weight MobileRestaurantPageMenuItem_common"}>{weight || ''}</span>
                </h3>

                <div className={"MobileRestaurantPageMenuItem_statusbox"}>
                    <div className={"MobileRestaurantPageMenuItem_priceBox"}>
                        <div
                            className={"MobileRestaurantPageMenuItem_price MobileRestaurantPageMenuItem_common"}>
                            {properties[idxFood].price} Р
                        </div>
                    </div>
                </div>
            </div>

            <div className={"MobileRestaurantPageMenuItem_descbox"}>
                <div
                    className={`MobileRestaurantPageMenuItem_description MobileRestaurantPageMenuItem_overflowed ${!hideButton ? ' max-h-100' : ''}`}>
                    {description}
                </div>
                {description.length > 84 ? hideButton
                    ?
                    <span
                        className={"MobileRestaurantPageMenuItem_expandButton MobileRestaurantPageMenuItem_commonDesc"}
                        onClick={(e) => {
                            setHideButton(!hideButton)
                            e.stopPropagation()
                        }}>
                        ещё
                    </span>
                    :
                    <span
                        className={"MobileRestaurantPageMenuItem_expandButton MobileRestaurantPageMenuItem_commonDesc"}
                        onClick={(e) => {
                            setHideButton(!hideButton)
                            e.stopPropagation()
                        }} style={{position: 'relative'}}>
                        скрыть
                    </span>
                    : null
                }
            </div>

            {properties.length > 1 &&
            <div className={"MobileRestaurantPageMenuItem_descbox"} style={{marginLeft: 0, marginRight: 0}}>
                <div className="product__weight">
                    <ul className="weight__list">
                        {
                            properties.map((item, idx) => {
                                return (
                                    <li onClick={(e) => {
                                        setIdxFood(idx)
                                        e.stopPropagation();
                                    }} key={"foodProp-" + idx}
                                        className={`${idx === idxFood ? 'active' : ''} weight__item`}>{item.name}</li>
                                )
                            })
                        }

                    </ul>
                </div>
            </div>

            }
            <a
                onClick={() => selectFood(food, properties[idxFood].id)}
                className={"magia-btn-add-to-cart magia-order-btn"}
                style={{width: '100%', marginTop: '10px'}}
            >Добавить в корзину
            </a>


        </li>
    )
}

export default MobileFoodItem;
