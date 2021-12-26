import React from 'react';
import './index.scss';
import {Link, Redirect} from "react-router-dom";
import PersonSvg from 'static/imgs/contact-icons/mdi_person.svg';
import CallIconSvg from 'static/imgs/contact-icons/call-icon.svg';
import EmailSvg from 'static/imgs/contact-icons/mdi_local_post_office.svg';
import LockSvg from 'static/imgs/contact-icons/lock.svg';
import DateSvg from 'static/imgs/contact-icons/mdi_date_range.svg';
import axios from "../../../core/config/axios";
import {useSelector} from "react-redux";
import scrollToTop from "../../../helpers/scroll";

const RegistrationPage = ({token}) => {
    React.useEffect(() => {
        scrollToTop()
    }, []);

    const appSettings = useSelector((state) => {
        // console.log(state)
        return state.settingsReducer.items;
    });

    const [formData, setFormData] = React.useState({
        name: '',
        password: '',
        password_confirmation: '',
        birthday: '',
        email: '',
        phone: '',
        _token: token.content
    });
    const [formErrors, setFormErrors] = React.useState([]);
    const [isReady, setIsReady] = React.useState(true);

    const handleChange = (e) => {
        formData[e.target.name] = e.target.value;
        setFormData(formData);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setFormErrors([]);
        setIsReady(false);

        const countryCode = '7';
        if(formData.phone.length > 0 && formData.phone[0] !== countryCode) {
            setFormErrors( {'phone': ['Номер телефона должен начинаться с 7']} );
            setIsReady(true);
            return false;
        }

        axios.post('/auth/registration', formData)
            .then((response) => {

                if(response.data.hasOwnProperty('errors') && response.data.errors.sms) {
                    alert(response.data.errors.sms[0]);
                    return window.location.href = '/login';
                }

                if( appSettings.SEND_PHONE_MESSAGE_OPERATION === true ) {
                    alert('На Ваш телефон отправлен код активации');
                    return window.location.href = '/auth/activate';
                }
                window.location.href = '/cabinet';
            }).catch((error) => {
                const errors = error.response.data.errors;
                setFormErrors(errors);
                window.scrollTo(0,0);
            }
        );
        setIsReady(true);
    };

    return (
        <div>
            <div className={'page-wrapper auth-page-wrapper'}>
                <div className={'auth-wrapper'}>
                    <div className={'registr-page magia-col-xs-16 magia-col-md-12 m-lr'}>
                        <div className="registr__form">
                            <div className="form__header">
                                <h2>Регистрация</h2>
                                {Object.entries(formErrors).length > 0 && (
                                    <ul className={'form-errors'} style={{ display: 'block' }}>
                                        {Object.entries(formErrors).map((item, key) => {
                                            return (
                                                <li key={key}>
                                                    <pre style={{color: "red", fontFamily: 'inherit', margin: 0, whiteSpace: 'pre-wrap'}}>{item[1].join('\n')}</pre>
                                                </li>
                                            );
                                        })}
                                    </ul>
                                )}
                            </div>
                            <div className="form__content">
                                <form className={'magia-form'} onSubmit={handleSubmit}>
                                    {/*<input type="hidden" name="_token" value={token.content} />*/}
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
                                                   style={{border: formErrors['name'] ? '1px solid red' : 'none'}}
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
                                                   placeholder={'Введите номер телефона'}
                                                   title={'Формат ввода телефона: 79780123456'}
                                                   style={{border: formErrors['phone'] ? '1px solid red' : 'none'}}
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
                                                   placeholder={'Введите почту'}
                                                   style={{border: formErrors['email'] ? '1px solid red' : 'none'}}
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
                                                   placeholder={'дд.мм.гггг'}
                                                   onChange={handleChange}
                                            />
                                        </div>
                                    </div>
                                    <div className="registr__passwords-block">
                                        <div className="login__input auth-input">
                                            <label htmlFor="password">Пароль</label>

                                            <div className="magia-input-img">
                                                <i className={'icon'}>
                                                    <img src={LockSvg} alt={'name'} />
                                                </i>
                                                <input type="password"
                                                       className={'magia-linear-input'}
                                                       id={'password'}
                                                       name={'password'}
                                                       placeholder={'Введите пароль'}
                                                       style={{border: formErrors['password'] ? '1px solid red' : 'none'}}
                                                       onChange={handleChange}
                                                />
                                            </div>
                                        </div>
                                        <div className="login__input auth-input">
                                            <label htmlFor="password_confirmation">Подтвердите пароль</label>

                                            <div className="magia-input-img">
                                                <i className={'icon'}>
                                                    <img src={LockSvg} alt={'name'} />
                                                </i>
                                                <input type="password"
                                                       className={'magia-linear-input'}
                                                       id={'password_confirmation'}
                                                       name={'password_confirmation'}
                                                       placeholder={'Введите пароль'}
                                                       style={{border: formErrors['password'] ? '1px solid red' : 'none'}}
                                                       onChange={handleChange}
                                                />
                                            </div>
                                        </div>
                                    </div>


                                    <div className={'auth__auth-buttons'}>
                                        <input type="submit" className={'magia-send-button'} disabled={!isReady} value={'Зарегистрироваться'}/>
                                    </div>
                                </form>
                            </div>

                            <div className="form__footer">
                                <div className="form__info">
                                    <p>Есть аккаунт?</p>
                                    <a href="/login">Войти</a>
                                    {/*<Link to="/login">Войти</Link>*/}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default RegistrationPage;
