import React from "react";
import PersonSvg from 'static/imgs/contact-icons/mdi_person.svg';
import CallIconSvg from 'static/imgs/contact-icons/call-icon.svg';
import EmailSvg from 'static/imgs/contact-icons/mdi_local_post_office.svg';
import LocationSvg from 'static/imgs/contact-icons/location.svg';
import DateSvg from 'static/imgs/contact-icons/mdi_date_range.svg';
import axios from "../../../../core/config/axios";
import {useSelector} from "react-redux";

const DesktopAuth = ({handleChange, handleSubmit, formData, userOrders, isReady}) => {

    const [isAdmin, setIsAdmin] = React.useState(false);

    if(!userOrders) return false;

    const city = useSelector((state) => {
        return state.deliveryReducer.city;
    });

    React.useEffect(() => {
        if (window.hasOwnProperty('user') && window.user.hasOwnProperty('role')) {
            setIsAdmin(window.user.role);
        }
    }, []);

    React.useEffect(() => {
        const event = {target: {name: 'address', value: city}};
        handleChange(event);
    }, [city]);

    return (
        <div className="cabinet__wrapper">
            <div className="cabinet__history">
                <div className="history__header">
                    <h2>История заказов</h2>
                </div>
                <div className="history__content">
                    <table>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Сумма</td>
                                <td>Дата заказа</td>
                            </tr>
                        </thead>
                        <tbody>
                        {userOrders.length > 0 && userOrders.map((item, index) => {
                            return (
                                <tr key={item.id}>
                                    <td>{index + 1}</td>
                                    <td>{item.total} р.</td>
                                    <td>{new Date(item.date_delivery).toLocaleDateString()}</td>
                                </tr>
                            );
                        })}
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div></div>
                <div className={'line'}></div>
            </div>
            <div className="cabinet__form">
                <div className="form__header">
                    <h2>Личные данные</h2>
                    <div className="header__buttons">
                        {isAdmin > 0 &&
                            <a href="/admin" title={'Админ-панель'}>
                                <svg enableBackground="new 0 0 512 512" height="25" viewBox="0 0 512 512" width="26" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z"/><path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z"/>
                                </svg>
                            </a>
                        }

                        <a href="/logout">
                            <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.62909 12.3462H22.76M15.8338 8.49829V6.57434C15.8338 6.06408 15.6311 5.57471 15.2703 5.2139C14.9095 4.85309 14.4201 4.65039 13.9099 4.65039H4.67492C4.16466 4.65039 3.6753 4.85309 3.31449 5.2139C2.95368 5.57471 2.75098 6.06408 2.75098 6.57434V18.118C2.75098 18.6283 2.95368 19.1177 3.31449 19.4785C3.6753 19.8393 4.16466 20.042 4.67492 20.042H13.9099C14.4201 20.042 14.9095 19.8393 15.2703 19.4785C15.6311 19.1177 15.8338 18.6283 15.8338 18.118V16.1941V8.49829ZM18.9121 8.49829L22.76 12.3462L18.9121 16.1941V8.49829Z"
                                    stroke="#294053"
                                    strokeWidth="1.3"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div className="form__content">
                    <form className={'magia-form'} onSubmit={handleSubmit}>
                        <div className="login__input auth-input">
                            <label htmlFor="name">Имя</label>
                            <div className="magia-input-img">
                                <i className={'icon'}>
                                    <img src={PersonSvg} alt={'name'} />
                                </i>
                                <input type="text"
                                       className={'magia-linear-input'}
                                       id={'name'}
                                       name={'name'}
                                       placeholder={'Введите Имя'}
                                       defaultValue={formData.name}
                                       onChange={handleChange}
                                />
                            </div>
                        </div>
                        <div className="login__input auth-input">
                            <label htmlFor="login">Номер телефона</label>

                            <div className="magia-input-img">
                                <i className={'icon'}>
                                    <img src={CallIconSvg} alt={'name'} />
                                </i>
                                <input type="text"
                                       className={'magia-linear-input'}
                                       id={'phone'}
                                       name={'phone'}
                                       defaultValue={formData.phone}
                                       placeholder={'Введите номер телефона'}
                                       title={'Формат ввода телефона: 79780123456'}
                                       onChange={handleChange}
                                />
                            </div>
                        </div>
                        <div className="login__input auth-input">
                            <label htmlFor="email">E-mail адрес</label>

                            <div className="magia-input-img">
                                <i className={'icon'}>
                                    <img src={EmailSvg} alt={'name'} />
                                </i>
                                <input type="email"
                                       className={'magia-linear-input'}
                                       id={'email'}
                                       name={'email'}
                                       defaultValue={formData.email}
                                       placeholder={'Введите почту'}
                                       onChange={handleChange}
                                />
                            </div>
                        </div>
                        <div className="login__input auth-input">
                            <label htmlFor="password">Дата рождения</label>

                            <div className="magia-input-img">
                                <i className={'icon'}>
                                    <img src={DateSvg} alt={'birthday'} />
                                </i>
                                <input type="date"
                                       className={'magia-linear-input'}
                                       id={'birthday'}
                                       name={'birthday'}
                                       defaultValue={formData.birthday}
                                       onChange={handleChange}
                                />
                            </div>
                        </div>
                        <div className="login__input auth-input">
                            <label htmlFor="password_confirmation">Адрес</label>

                            <div className="magia-input-img">
                                <i className={'icon'}>
                                    <img src={LocationSvg} alt={'address'} />
                                </i>
                                <input type="text"
                                       className={'magia-linear-input modal-trigger'}
                                       href="#modal1"
                                       id={'address'}
                                       name={'address'}
                                       disabled={!isReady}
                                       defaultValue={formData.address}
                                       // value={city}
                                       placeholder={'Выберите город/село'}
                                       readOnly
                                       onChange={handleChange}
                                />
                            </div>
                        </div>

                        <div className={'auth__auth-buttons'}>
                            <input type="submit" className={'magia-send-button'} value={'Сохранить'} disabled={!isReady}/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default DesktopAuth;
