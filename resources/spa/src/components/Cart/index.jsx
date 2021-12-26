import React, {useEffect, useState} from 'react'
import './index.css'
import {connect, useSelector} from "react-redux";
import {appActions, cartActions} from "../../redux/actions";
import CartItem from "./_cartItem";
import {CartApi} from "../../core/api";
import SwitchButton from "./SwitchButton";
import MagiaInput from "./MagiaInput";
import {Link} from "react-router-dom";
import axios from "../../core/config/axios";
import {Preloader} from "../index";

const Cart = ({setCartVisible, total, cartItems, setCartItem, decrementCartItem, setCartItems, setCartTotal, getCart, cartVisible}) => {
    const DELIVERY_TYPE_PICKUP = 1;
    const DELIVERY_TYPE_COURIER = 2;
    const TYPE_CASH = 0;

    const closeCart = () => {
        setCartVisible(false);
    };
    const user = window.user ? window.user : {
        name:"",
        phone:"",
        address:"",
        user_id:null,
        city:"",
        street:"",
        house:"",
        entrance:"",
        apartment:"",
    };
    const [delivery_type, setDeliveryType] = useState(DELIVERY_TYPE_COURIER);
    const [pay_type, setPayType] = useState(TYPE_CASH);
    const [isCheckout, setIsCheckOut] = useState(false);
    const [client, setClient] = useState({
        name: user.name,
        phone: user.phone,
        user_id: user.id,
        address: user.address,
        delivery_type,
        pay_type,
        city:"",
        street:"",
        house:"",
        entrance:"",
        apartment:"",
    });
    const [isLoading, setLoading] = useState(false);
    const [errors, setErrors] = useState(null);

    const delivery = window.delivery;
    // let city = localStorage.getItem('city') || '';
    const city = useSelector((state) => {
        return state.deliveryReducer.city;
    });

    useEffect(() => {
        // const inputCity = document.querySelector('#city');
        // if(inputCity) inputCity.value = city;
    }, []);

    const handleChange = e => {
        setClient({
            ...client,
            [e.target.name]: e.target.value
        })
    };

    const checkError = field => {
        return errors && errors[field] && errors[field][0]
    };

    const checkClientEmptyFields = (client, delivery_type = DELIVERY_TYPE_COURIER) => {
        const clientErrors = [];

        if( delivery_type === DELIVERY_TYPE_PICKUP ) {

            if(!client.name) {
                clientErrors.push('Необходимо указать Имя');
            }
            if(!client.phone) {
                clientErrors.push('Необходимо указать номер телефона');
            }

        } else {

            if(!client.name) {
                clientErrors.push('Необходимо указать Имя');
            }
            if(!client.phone) {
                clientErrors.push('Необходимо указать номер телефона');
            }
            if(!city) {
                clientErrors.push('Необходимо выбрать район');
            }
            if(!client.street) {
                clientErrors.push('Необходимо указать улицу');
            }
            if(!client.house) {
                clientErrors.push('Необходимо указать дом');
            }

        }

        if(clientErrors.length > 0) {
            const messageErrors = clientErrors.map( item => item );
            alert( messageErrors.join('\n') );
            return false;
        }

        return true;
    };

    const send = () => {
        let requiredFieldsIsNotEmpty = true;

        if(delivery_type === DELIVERY_TYPE_PICKUP) {
            requiredFieldsIsNotEmpty = checkClientEmptyFields(client, DELIVERY_TYPE_PICKUP);
        } else {
            requiredFieldsIsNotEmpty = checkClientEmptyFields(client, DELIVERY_TYPE_COURIER);
        }

        if( !requiredFieldsIsNotEmpty ) {
            return false;
        }


        setLoading(true);
        setErrors(null);

        // Доставка курьером
        if( delivery_type === DELIVERY_TYPE_COURIER) {
            // Доставка курьером и сумма заказа для бесплатной доставки > 0
            // Сумма заказа >= минимальной суммы заказа для бесплатной доставки ? 0 : стоимость доставки
            if( delivery.delFreeCost > 0 ) { client.delivery_cost = total >= delivery.delFreeCost ? 0 : +delivery.delCost; }
            // Доставка курьером и сумма заказа для бесплатной доставки <= 0
            // Стоимость доставки
            else { client.delivery_cost = +delivery.delCost; }
        } else { client.delivery_cost = 0; }

        client.city = city;
        CartApi.save(client)
            .then(response => {

                // Если адрес клиента не задан, то записать ему выбранный район
                // if(!client.address) {
                //     client.address = city;
                //     axios.post('/client', client)
                //         .then((response) => {
                //             // console.log(response)
                //         }).catch((error) => {
                //             // console.log(error);
                //         }
                //     );
                // }

                localStorage.setItem('token', Math.random());
                setErrors(null);
                setCartItems([]);
                setCartTotal(0);
                setIsCheckOut(false);
                window.M.toast({html: 'Ваш заказ успешно добавлен. Ожидайте звонка'});
            })
            .catch(error => {
                setErrors(error.response.data.errors)
            })
            .finally(() => {
                setLoading(false);
                window.location.reload();
                // closeCart();
                // setIsCheckOut(false);
            })
    };

    const destroyProperty = id => {
        CartApi.destroyProperty(id)
            .then(response => {
                getCart()
            })
            .catch(error => {

            });
    };

    if(isLoading) return <Preloader/>

    return (
        <div className={`${cartVisible ? 'cart open' : 'cart'}`}>
            <div className="cart__wrapper magia-col-xs-15 m-lr">
                <div className="cart__header">
                    <span className={"cart__title"}>
                        {isCheckout &&
                        <span className="cart__icon" onClick={setIsCheckOut.bind(null, false)}
                                             style={{paddingRight: 10}}>
                            <svg width="12" height="14" viewBox="0 0 12 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 1L2 10.5L11 20" stroke="#294053" strokeWidth="1.56897"></path>
                            </svg>
                        </span>}
                        Корзина &nbsp;
                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.66106 16.3171C9.66106 17.2344 8.91743 17.978 8.0001 17.978C7.08278 17.978 6.33916 17.2344 6.33916 16.3171C6.33916 15.3998 7.08279 14.6561 8.00011 14.6561C8.91744 14.6561 9.66106 15.3998 9.66106 16.3171ZM14.7254 14.6561C13.8081 14.6561 13.0645 15.3998 13.0645 16.3171C13.0645 17.2344 13.8081 17.9781 14.7254 17.9781C15.6427 17.9781 16.3864 17.2344 16.3864 16.3171C16.3864 15.3998 15.6427 14.6561 14.7254 14.6561ZM19.8811 6.85894L17.8374 12.9334C17.8374 12.9334 17.6682 13.8349 16.8062 13.8349C15.9442 13.8349 7.51478 13.8349 6.48611 13.8349C5.45744 13.8349 5.41421 12.705 5.41421 12.705C5.41421 12.705 4.31762 4.56943 4.26328 4.07793C4.20894 3.58644 3.58038 3.22214 3.58038 3.22214L0.87593 1.95884C-0.604722 1.18455 0.0682993 -0.288694 0.87593 0.049673C4.30526 1.6674 5.89829 2.46392 6.00079 3.10112C6.10453 3.73957 6.28482 5.27703 6.28482 5.27703V5.28691C6.30582 5.28073 6.32063 5.27703 6.32063 5.27703C6.32063 5.27703 16.8371 5.27703 18.9611 5.27703C20.4875 5.27703 19.8811 6.86142 19.8811 6.85894ZM16.9248 10.2414L16.9038 10.2426H6.89857L7.1048 11.8776H16.4382L16.9248 10.2414ZM17.8991 6.94416H6.48487L6.70469 8.69155C8.89418 8.69155 15.3058 8.69155 17.3829 8.69155L17.8991 6.94416Z" fill="#DDDDDD"/>
                        </svg>
                    </span>
                    <div className="cart__icons">
                        <span onClick={closeCart} className="cart__icon">
                            <svg version="1.1" viewBox="0 0 512 512" className="close-icon svg-icon svg-fill" style={{width: "1em",height: "1em"}}>
                        <path pid="0" d="M505.943 6.058c-8.077-8.077-21.172-8.077-29.249 0L6.058 476.693c-8.077 8.077-8.077 21.172 0 29.249A20.612 20.612 0 0 0 20.683 512a20.614 20.614 0 0 0 14.625-6.059L505.943 35.306c8.076-8.076 8.076-21.171 0-29.248z"></path>
                        <path pid="1" d="M505.942 476.694L35.306 6.059c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l470.636 470.636a20.616 20.616 0 0 0 14.625 6.058 20.615 20.615 0 0 0 14.624-6.057c8.075-8.078 8.075-21.173-.001-29.25z"></path>
                    </svg>
                        </span>
                    </div>
                </div>

                <div className="cart__body">
                    {
                        0 === cartItems.length &&
                        <div className={"cart__empty"}>
                            <h4 style={{fontSize: "20px"}}>Ваша корзина всё еще пустая</h4>
                            <div className="empty-cart">
                                <img src="/images/cart-empty.png" alt="Пустая карзина"/>
                            </div>
                        </div>
                    }
                    {
                        (false === isCheckout) ?
                            (cartItems.length > 0 &&
                                <ul className="cart__list">
                                    {cartItems.map((cartItem, key) => {
                                        return (
                                            <CartItem
                                                key={key}
                                                count={cartItem.quantity}
                                                // img={'https://magia-dostavka.ru/storage/foods/fSDQ9a4l35xjx0U3XV1gxIytnL5GQHW4hBGtSX2f.jpeg'}
                                                img={cartItem.img}
                                                name={cartItem.name}
                                                price={cartItem.price}
                                                sum={cartItem.sum}
                                                increment={setCartItem.bind(this, cartItem.foodPropertyId, {})}
                                                decrement={decrementCartItem.bind(this, cartItem.id, cartItem.quantity - 1)}
                                                remove={destroyProperty.bind(null, cartItem.id)}
                                                options={cartItem.options}
                                            />
                                        )
                                    })}
                                </ul>
                            )
                        :
                        <div className="cart__delivery-form">
                            <form>
                                <MagiaInput
                                    img={{ src: "/images/icon-index/person.svg", alt:"Ваше имя" }}
                                    input={{
                                        inputChange: handleChange,
                                        id:"name",
                                        name:"name",
                                        type:"text",
                                        placeholder:"Ваше имя",
                                        defaultValue: user.name
                                    }}
                                />
                                <MagiaInput
                                    img={{ src: "/images/icon-index/call.svg", alt:"Ваш телефон" }}
                                    input={{
                                        inputChange: handleChange,
                                        id:"phone",
                                        name:"phone",
                                        type:"text",
                                        placeholder:"Ваш телефон",
                                        defaultValue: user.phone
                                    }}
                                />
                                <div className="cart__input col s12">
                                    <div></div>
                                    <div className="delivery-payment-block">
                                        <h4 style={{fontSize: "16px"}}>Выберите нужный способ доставки и оплаты</h4>
                                        <SwitchButton
                                            firstValue="2"
                                            secondValue="1"
                                            first="Доставка"
                                            second="Самовывоз"
                                            name="delivery_type"
                                            client={client}
                                            setClient={setClient}
                                            setType={setDeliveryType}
                                        />
                                        {delivery_type === DELIVERY_TYPE_COURIER && (
                                            <>
                                                <a href="#modal1" className={'modal-trigger magia-send-button'} style={{color: '#fff', padding: '0.5em'}}>
                                                    {city ? 'Сменить район' : 'Выбрать район'}
                                                </a>
                                                {/*<MagiaInput*/}
                                                {/*    input={{*/}
                                                {/*        inputChange: handleChange,*/}
                                                {/*        id:"city",*/}
                                                {/*        name:"city",*/}
                                                {/*        type:"text",*/}
                                                {/*        placeholder:"Город/село",*/}
                                                {/*    }}*/}
                                                {/*    withIcon={false}*/}
                                                {/*/>*/}
                                                <div className="cart__input col s12" style={{gridTemplateColumns: "auto"}}>
                                                    <div></div>
                                                    <input id="city" name="city" type="text" readOnly placeholder="Город/село"
                                                           className="magia-input" value={city || ''} required />
                                                </div>
                                                <div style={{fontSize: '16px'}}>
                                                    <p style={{lineHeight: '1.3em'}}>
                                                        Стоимость доставки в район "{city || '?'}" - {delivery.delCost || '?'} руб.<br/>
                                                        {delivery.delFreeCost > 0 && `Бесплатная доставка от ${delivery.delFreeCost || '?'} руб.`}
                                                    </p>
                                                </div>
                                                {/*<MagiaInput*/}
                                                {/*    input={{*/}
                                                {/*        inputChange: handleChange,*/}
                                                {/*        id:"address",*/}
                                                {/*        name:"address",*/}
                                                {/*        type:"text",*/}
                                                {/*        placeholder:"Введите адрес доставки",*/}
                                                {/*        defaultValue: user.address*/}
                                                {/*    }}*/}
                                                {/*    withIcon={false}*/}
                                                {/*/>*/}
                                                <MagiaInput
                                                    input={{
                                                        inputChange: handleChange,
                                                        id:"street",
                                                        name:"street",
                                                        type:"text",
                                                        placeholder:"Улица",
                                                    }}
                                                    withIcon={false}
                                                />
                                                <MagiaInput
                                                    input={{
                                                        inputChange: handleChange,
                                                        id:"house",
                                                        name:"house",
                                                        type:"text",
                                                        placeholder:"Дом",
                                                    }}
                                                    withIcon={false}
                                                />
                                                <MagiaInput
                                                    input={{
                                                        inputChange: handleChange,
                                                        id:"entrance",
                                                        name:"entrance",
                                                        type:"text",
                                                        placeholder:"Подъезд",
                                                    }}
                                                    withIcon={false}
                                                />
                                                <MagiaInput
                                                    input={{
                                                        inputChange: handleChange,
                                                        id:"apartment",
                                                        name:"apartment",
                                                        type:"text",
                                                        placeholder:"Квартира",
                                                    }}
                                                    withIcon={false}
                                                />
                                            </>
                                        )}
                                        <SwitchButton
                                            firstValue="0"
                                            secondValue="1"
                                            first="Наличными"
                                            second="По карте"
                                            name="pay_type"
                                            client={client}
                                            setClient={setClient}
                                            setType={setPayType}
                                        />
                                    </div>
                                </div>
                                <div className="cart__input col s12">
                                    <img src="/images/icon-index/mdi_insert_comment.svg" alt="Комментарий"/>
                                    <textarea onChange={handleChange}
                                              placeholder="Комментарий"
                                              className={`validate magia-input ${checkError('comment') ? 'invalid' : ''} materialize-textarea`}
                                              name={"comment"} id="comment">
                                    </textarea>
                                </div>

                            </form>
                        </div>
                    }
                </div>
                {
                    cartItems && cartItems.length > 0 ? (
                        <div className="cart__footer">
                            <button disabled={isLoading}
                                    onClick={(false === isCheckout) ? setIsCheckOut.bind(null, true) : send} type="button"
                                    className="button cart__button">
                                <div className={"d-flex align-items-center justify-content-between"} style={{height: '1em'}}>
                                    {isLoading && <i className="fas fa-spinner fa-spin"></i>}
                                    <span style={{marginLeft: 5, fontSize: '0.9em'}}>Оформить</span>
                                    <span>
                                        {isCheckout && delivery_type === DELIVERY_TYPE_COURIER
                                            ?
                                            (total >= delivery.delFreeCost && delivery.delFreeCost > 0
                                                ? total
                                                : (total + +delivery.delCost)
                                            )
                                            : total
                                        } рублей
                                    </span>
                                </div>
                            </button>
                        </div>
                    ) : (
                        <div className="cart__footer">
                            <button disabled={isLoading}
                                    type="button"
                                    className="button cart__button">
                                <div className={"d-flex align-items-center justify-content-center"}>
                                    {isLoading && <i className="fas fa-spinner fa-spin"></i>}
                                    <Link to={'/menu'} style={{marginLeft: 5, fontSize: '0.8em'}} onClick={closeCart}>Перейти в меню</Link>
                                    {/*<span style={{marginLeft: 5}}>Перейти в меню</span>*/}
                                </div>
                            </button>
                        </div>
                    )
                }

            </div>
        </div>
    )
};

const mapStateToProps = state => {
    return {
        cartItems: state.cartReducer.items,
        total: state.cartReducer.total,
    }
}

export default connect(mapStateToProps, {...appActions, ...cartActions})(Cart);
