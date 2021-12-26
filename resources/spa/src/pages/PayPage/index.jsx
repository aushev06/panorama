import React from 'react';
import CreditCardSvg from 'static/imgs/pay-icons/credit-card.svg';
import DeliveryCash from 'static/imgs/pay-icons/delivery-cash.svg';
import PointIssue from 'static/imgs/pay-icons/point-issue.svg';
import './index.scss';
import scrollToTop from "../../helpers/scroll";

const PayPage = () => {
    React.useEffect(() => {
        scrollToTop()
    }, []);

    return (
        <div className={'page-wrapper'}>
            <div className={'magia-container'}>
                <div className={'pay-page magia-col-xs-15 magia-col-md-12 m-lr'}>
                    <h2>Мы принимаем оплату:</h2>

                    <div className={'pay__wrapper'}>
                        <div className={'block-cards'}>

                            <div className={'block-cards__background'}>
                                <div className={'block-cards__wrapper magia-col-xs-14'}>
                                    <div className={'wrapper__text magia-col-xs-14'}>Наличными курьеру</div>
                                    <div className={'wrapper__img'}>
                                        <img src={DeliveryCash} alt={'Наличными курьеру'}/>
                                    </div>
                                </div>
                            </div>
                            <div className={'block-cards__background'}>
                                <div className={'block-cards__wrapper magia-col-xs-14'}>
                                    <div className={'wrapper__text magia-col-xs-14'}>При получении заказа в пункте выдачи</div>
                                    <div className={'wrapper__img'}>
                                        <img src={PointIssue} alt={'При получении заказа в пункте выдачи'}/>
                                    </div>
                                </div>
                            </div>
                            <div className={'block-cards__background'}>
                                <div className={'block-cards__wrapper magia-col-xs-14'}>
                                    <div className={'wrapper__text magia-col-xs-14'}>Безналичный расчет курьеру</div>
                                    <div className={'wrapper__img'}>
                                        <img src={CreditCardSvg} alt={'Безналичный расчет курьеру'}/>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div className={'block-info'}>
                            <div className={'block-info__text'}>
                                <div>
                                    <h2>Оплата наличными</h2>
                                    <p>Наличные — это самый привычный способ оплаты заказа по факту его получения.
                                        Если вам потребуется сдача, просто предупредите об этом оператора или
                                        оставьте соответствующий комментарий при оформлении заказа онлайн.
                                        Курьер привезет сдачу вместе с вашим заказом.</p>
                                </div>
                                <div>
                                    <h2>Безналичный расчет курьеру</h2>
                                    <p>Нет наличных, а ближайший банкомат находится в трех кварталах?
                                        Вы можете оплатить свой заказ банковской картой при получении.
                                        После оформления заказа, в течение 10 минут, с Вами обязательно свяжется
                                        оператор для подтверждения способа оплаты</p>
                                </div>
                            </div>
                            <div className={'block-info__cards'}>
                                <div>
                                    <div className="plastic-card">
                                        <img src="/images/pay-icons/mir.png" alt="МИР"/>
                                    </div>
                                    <div className="plastic-card">
                                        <img src="/images/pay-icons/mastercard.png" alt="MasterCard"/>
                                    </div>
                                    <div className="plastic-card">
                                        <img src="/images/pay-icons/visa.png" alt="Visa"/>
                                    </div>
                                    <div className="plastic-card">
                                        <img src="/images/pay-icons/tinkoff.png" alt="Tinkoff"/>
                                    </div>
                                    <div className="plastic-card">
                                        <img src="/images/pay-icons/sberbank.png" alt="Sberbank"/>
                                    </div>
                                    <div className="plastic-card">
                                        <img src="/images/pay-icons/rncb.png" alt="РНКБ"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default PayPage;
