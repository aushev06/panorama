import React, {useEffect, useState} from "react";

export default ({name, description, img, properties, selectFood, weight, food}) => {
    const [idxFood, setIdxFood] = useState(0);
    const [countOptions, setCountOptions] = useState(0);

    React.useEffect(() => {
        const elems = document.querySelectorAll('.materialboxed');
        const instances = M.Materialbox.init(elems, {});

        const count = properties.reduce((counter, item) => {
            counter += item.is_visible;
            return counter;
        }, 0);

        setCountOptions(count);

    }, []);

    return (
        <div className="RestaurantPageMenuCategory_item page-menu-category">
            <div className="RestaurantPageMenuCategory_itemWrapper">
                <div className={"RestaurantPageMenuItem_root"}>
                    <div></div>
                    <div className={"RestaurantPageMenuItem_topLine"}>
                        <div className={"RestaurantPageMenuItem_priceWrapper"}>
                            <div className={"UILoader_root"}>
                                <div className="UILoader_content">
                                    <div
                                        className="RestaurantPageMenuItem_priceAndCountWrapper"><span
                                        className="RestaurantPageMenuItem_price">{`${food.properties[idxFood].price}`} ₽</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 className={"RestaurantPageMenuItem_title"}>{food.name}</h3>
                        <span
                            className={"RestaurantPageMenuItem_weight"}>&nbsp;{food.weight || ''}</span>
                        <p className={'RestaurantPageMenuItem_description'}>
                            {food.description}
                        </p>
                    </div>
                    <div className={"RestaurantPageMenuItem_pictureContainer"}>

                        <div
                            className={"UIMagicalImage_root RestaurantPageMenuItem_picture UIMagicalImage_loaded"}>

                            <img
                                className={"lazyload materialboxed UIMagicalImage_image RestaurantPageMenuItem_pictureImage"}
                                data-src={food.img}
                                src={food.img}
                                alt={food.name}
                                title={food.name}
                            />

                        </div>

                        {food.properties.length > 1 && countOptions > 1 &&

                        <div className="product__weight">
                            <ul className="weight__list">
                                {
                                    food.properties.map((item, idx) => {
                                        return (
                                            <li onClick={(e) => {
                                                setIdxFood(idx);
                                                e.stopPropagation();
                                            }} key={"foodProp-" + idx}
                                                className={`${idx === idxFood ? 'active' : ''} weight__item`}>{item.name}</li>
                                        )
                                    })
                                }

                            </ul>
                        </div>
                        }
                        <a
                            onClick={() => selectFood(food, properties[idxFood].id)}
                            className={"magia-btn-add-to-cart magia-order-btn"}
                            style={{width: '100%', marginTop: '10px'}}
                        >Добавить в корзину
                        </a>
                    </div>
                </div>
            </div>

        </div>
    )
}
