import React from "react";
import PersonSvg from 'static/imgs/contact-icons/mdi_person.svg';
import CallIconSvg from 'static/imgs/contact-icons/call-icon.svg';
import EmailSvg from 'static/imgs/contact-icons/mdi_local_post_office.svg';
import LocationSvg from 'static/imgs/contact-icons/location.svg';
import DateSvg from 'static/imgs/contact-icons/mdi_date_range.svg';
import {Link} from "react-router-dom";
import {useSelector} from "react-redux";

const MobileAuth = ({handleChange, handleSubmit, formData, userOrders}) => {

    const [isAdmin, setIsAdmin] = React.useState(false);

    if (!userOrders) return false;

    const city = useSelector((state) => {
        return state.deliveryReducer.city;
    });

    React.useEffect(() => {
        const event = {target: {name: 'address', value: city}};
        handleChange(event);
    }, [city]);

    React.useEffect(() => {
        const el = document.querySelectorAll('.tabs');
        const instance = M.Tabs.init(el, {});

        if (window.hasOwnProperty('user') && window.user.hasOwnProperty('role')) {
            setIsAdmin(window.user.role);
        }
    }, []);

    return (
        <div className="cabinet__wrapper-mobile">
            <div className={'tabs__container'}>
                <ul className="tabs">
                    <li className="tab col s6"><a className="active"  href="#history">История заказов</a></li>
                    <li className="tab col s6"><a href="#cabinet">Личные данные</a></li>
                </ul>
            </div>

            <div className="cabinet__history" id={'history'}>
                <div className="history__content">
                    {isAdmin > 0 &&
                        <a href="/admin" className={'btn-to-admin-panel'} style={{'marginBottom': '1em'}} title={'Админ-панель'}>Перейти в Админ-панель</a>
                    }
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

            <div className="cabinet__form" id={'cabinet'}>
                <div className="form__content-mobile">
                    {isAdmin > 0 &&
                        <a href="/admin" className={'btn-to-admin-panel'} style={{'marginBottom': '1em'}} title={'Админ-панель'}>Перейти в Админ-панель</a>
                    }
                    <form className={'magia-form'} onSubmit={handleSubmit}>
                        <div className="login__input auth-input">
                            <label htmlFor="name">Имя</label>
                            <div className="magia-input-img">
                                <i className={'icon'}>
                                    <img src={PersonSvg} alt={'name'}/>
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
                                    <img src={CallIconSvg} alt={'name'}/>
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
                                    <img src={EmailSvg} alt={'name'}/>
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
                                    <img src={DateSvg} alt={'birthday'}/>
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
                                    <img src={LocationSvg} alt={'address'}/>
                                </i>
                                <input type="text"
                                       className={'magia-linear-input'}
                                       id={'address'}
                                       name={'address'}
                                       value={city || ''}
                                       placeholder={'Введите адрес'}
                                       onChange={handleChange}
                                />
                            </div>
                        </div>

                        <div className={'auth__auth-buttons'}>
                            <input type="submit" className={'magia-send-button'} value={'Сохранить'}/>
                            <a href="/logout" className={'transparent-button'}>Выйти</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default MobileAuth;
