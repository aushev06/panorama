import React, {useEffect, useState} from "react";

const ExpandButton = ({setHideButton, hideButton}) => {
    return hideButton ? (
        <span
            className={"expand__Button"}
            onClick={(e) => {
                setHideButton(!hideButton);
        }}>
            еще
        </span>
    ) : (
        <span
            className={"expand__Button"}
            style={{position: 'relative'}}
            onClick={(e) => {
                setHideButton(!hideButton);
        }}>
            Скрыть
        </span>
    );
};

const FoodItem = ({id, name, description, img, properties, selectFood, weight, food}) => {
    const [idxFood, setIdxFood] = useState(0);
    const [countOptions, setCountOptions] = useState(0);
    const [hideButton, setHideButton] = useState(true);
    const [isTextOverflowing, setIsTextOverflowing] = useState(false);

    React.useEffect(() => {
        const elems = document.querySelectorAll('.materialboxed');
        const instances = M.Materialbox.init(elems, {});

        const count = properties.reduce((counter, item) => {
            counter += item.is_visible;
            return counter;
        }, 0);

        const foodContainerInfo = document.querySelector(`.content__info[data-foodid='${food.id}']`);
        const foodParagraph = foodContainerInfo.firstElementChild;
        const maxHeight = foodContainerInfo.scrollHeight + 1;
        const paragraphHeight = foodParagraph.scrollHeight;
        setIsTextOverflowing(paragraphHeight > maxHeight);

        setCountOptions(count);

    }, []);

    return (
        <div className={'foodItem__wrapper'}>
            <div className="foodItem__container">
                <div className="foodItem__header">
                    <img
                        className={"lazyload materialboxed UIMagicalImage_image RestaurantPageMenuItem_pictureImage"}
                        data-src={food.properties[idxFood].img}
                        src={food.properties[idxFood].img}
                        alt={food.name}
                        title={food.name}
                    />
                </div>
                <div className="foodItem__content">
                    <div className={"title-price__container"}>
                        <div className="content__title">
                            <h3 className={"RestaurantPageMenuItem_title"}>{food.name}</h3>
                        </div>
                        <div className="content__weight-price">
                            <span>
                                {food.foodInfo && food.foodInfo.weight
                                ? `${food.foodInfo.weight} / ${food.properties[idxFood].price} ₽`
                                : `${food.properties[idxFood].price} ₽`}
                            </span>
                        </div>
                    </div>
                    <div className="content__info" data-foodid={food.id}>
                        <p
                            className={`${hideButton ? 'collapse-off' : 'collapse-on'} ${isTextOverflowing ? 'overflowing' : ''}`}
                        >
                            {food.description}
                        </p>
                        {isTextOverflowing ? <ExpandButton hideButton={hideButton} setHideButton={setHideButton} /> : null}
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
                </div>
            </div>
            <div className="foodItem__footer">
                <a
                    onClick={() => selectFood(food, properties[idxFood].id)}
                    className={"magia-btn-add-to-cart magia-order-btn"}
                >
                    Добавить в корзину
                </a>
            </div>
        </div>
    )
};

export default FoodItem;
