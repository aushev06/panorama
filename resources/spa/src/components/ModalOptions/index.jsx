import React, {useCallback, useEffect, useState} from "react";

export default ({food, setCartItem, onSend}) => {
    const [modal, setModal] = useState(null);
    const [options, setOptions] = useState([]);
    const [price, setPrice] = useState(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        modalCallback();
        checkPrice();

        if (null !== modal) {
            modal.open()
        }

    }, [options, food, modal])


    const modalCallback = useCallback(() => {
        var modals = document.querySelectorAll('.modal');

        if (modal === null) {
            setModal(window.M.Modal.init(modals, {
                onOpenStart: function (modal) {
                    modal.style.zIndex = 10001;
                    modal.style.maxHeight = '100%';
                }
            })[0])
        }


    })

    const indexById = (tempItems) => {
        let items = [];

        tempItems.map(item => {
            items[item.id] = item
        });

        return items;
    }

    const selectOption = (option) => {
        if (Object.values(options).find(item => parseInt(option.id) === parseInt(item.id))) {
            const tempItems = Object.values(options).filter(item => parseInt(item.id) !== parseInt(option.id));


            setOptions(indexById(tempItems));
            checkPrice()
        } else {
            setOptions({
                ...options,
                [option.id]: {
                    quantity: 1,
                    id: option.id,
                    optionCategoryId: option.option_category_id,
                    price: option.price
                }
            })

        }
        checkPrice();
    }


    const incrementOption = event => {
        event.preventDefault();

        setOptions({
            ...options,
            [event.target.dataset.id]: {
                quantity: options[event.target.dataset.id].quantity + 1,
                id: event.target.dataset.id,
                price: options[event.target.dataset.id].price,
                optionCategoryId: options[event.target.dataset.id].optionCategoryId,
            }
        });

        checkPrice()

    }


    const decrementOption = event => {
        event.preventDefault();

        setOptions({
            ...options,
            [event.target.dataset.id]: {
                quantity: options[event.target.dataset.id].quantity - 1,
                id: event.target.dataset.id,
                price: options[event.target.dataset.id].price,
                optionCategoryId: options[event.target.dataset.id].optionCategoryId,
            }
        })

        checkPrice()

        if (options[event.target.dataset.id].quantity === 0) {
            setOptions(Object.values(options).filter(item => item.id !== event.target.dataset.id))
        }

    }

    const checkPrice = () => {
        let tempPrice = 0;
        Object.values(options).map(option => {
            tempPrice += option.price * option.quantity;
        });

        setPrice(tempPrice + food.selectProperty.price);

    }


    const selectRadioItem = (option) => {
        if (options[option.id]) {
            return;
        }

        const tempItems = Object.values(options).filter(item => {
            return parseInt(item.optionCategoryId) !== parseInt(option.option_category_id);
        })

        const items = indexById(tempItems);


        setOptions({
            ...items,
            [option.id]: {
                quantity: 1,
                id: option.id,
                price: option.price,
                optionCategoryId: option.option_category_id
            }
        })


    }

    const send = () => {
        const requiredOption = food.options.find(item => item.required === true);

        if (requiredOption) {
            const requiredOptionsCategoryId = requiredOption.items[0].option_category_id;

            const check = Object.values(options).some(item => requiredOptionsCategoryId === item.optionCategoryId);

            // console.log(check)

            if (false === check) {
                window.M.toast({html: 'Выберите обязательные опции!'})
                setError('Выберите обязательные опции!');
                return;
            }
        }


        setCartItem(food.selectProperty.id, options)
        modal.close();
        // setOptions([])
        onSend();

    }

    const isMobile = () => {
        return (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) ? true : false
    }


    return (
        <div id="modal1" className={`modal ${isMobile() ? 'bottom-sheet' : 'modal-fixed-footer'}`}
             style={{zIndex: '100000 !important'}}>

            <div className="modal-content" style={{maxHeight: `${isMobile() ? '500px' : 'unset'}`}}>
                <h3 className={"header"}>Выберите опции</h3>

                <span
                    style={{color: 'red'}}>{(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) && error}</span>

                {food && food.options.map((foodOption, key) => {
                    return (
                        <div className={"ModalOptionsGroup_root"} key={"foodOption-" + key}>
                            <div className={"ModalOptionsGroup_topLineWrapper"}>
                                <div className={"ModalOptionsGroup_topLine"}>
                                    <div className={"ModalOptionsGroup_name"}>
                                        <span>{`${foodOption.categoryName}`}</span>
                                        <span>{foodOption.required ? ' - Обязательно' : ''}</span>
                                    </div>
                                </div>
                            </div>

                            <div className={"options d-flex justify-content-between"}
                                 style={{flexDirection: `${isMobile() ? 'column' : 'unset'}`}}>
                                {foodOption.items.map(item => {
                                    return (
                                        <label className={"d-flex align-items-center"}
                                               key={"option-" + item.id}>
                                            <input name={'option_' + foodOption.id}
                                                   onClick={item.multiplier === 1 && foodOption.required === true ? selectRadioItem.bind(null, item) : selectOption.bind(null, item)}
                                                   type={item.multiplier === 1 && foodOption.required === true ? 'radio' : 'checkbox'}/>
                                            <span>{item.name} <small>+{item.price}Р</small></span>

                                            {options[item.id] ?
                                                <div
                                                    style={{marginLeft: 10}}
                                                    className={"d-flex align-items-center justify-content-between"}>

                                                    {item.multiplier > 1 &&
                                                    <div className="ModalOptionsItem_counter">
                                                                <span
                                                                    className="UICounter_root UICounter_small">
                                                                    <div
                                                                        className={`UICounter_decrement UICounter_button ${options[item.id].quantity === 1 ? 'UICounter_disabled' : ''}`}
                                                                        onClick={decrementOption}
                                                                        data-id={item.id}>–</div>
                                                                    <div
                                                                        className="UICounter_value">{options[item.id].quantity}</div>
                                                                    <div
                                                                        className={`UICounter_increment UICounter_button ${options[item.id].quantity === item.multiplier ? 'UICounter_disabled' : ''}`}
                                                                        onClick={incrementOption}
                                                                        data-id={item.id}>+</div>
                                                                </span>
                                                    </div>}
                                                </div>
                                                : ''}

                                        </label>
                                    )
                                })}
                            </div>

                        </div>
                    )
                })}

            </div>
            <div className="modal-footer">
                <a href="#!"
                   className="waves-effect waves-green btn-flat" onClick={send}>Добавить ({price?.toFixed(2) || ''}Р) </a>
            </div>
        </div>
    )
}
