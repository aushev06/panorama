import React from 'react';
import './index.scss';
import {Link, Redirect} from "react-router-dom";
import PersonSvg from 'static/imgs/contact-icons/mdi_person.svg';
import CallIconSvg from 'static/imgs/contact-icons/call-icon.svg';
import EmailSvg from 'static/imgs/contact-icons/mdi_local_post_office.svg';
import LockSvg from 'static/imgs/contact-icons/lock.svg';
import axios from "../../../core/config/axios";
import scrollToTop from "../../../helpers/scroll";

const NewPasswordPage = ({token}) => {

    const [formData, setFormData] = React.useState({
        password: '',
        password_confirmation: '',
        token: '',
        _token: token.content
    });
    const [formErrors, setFormErrors] = React.useState([]);

    const [isLoaded, setIsLoaded] = React.useState(false);

    React.useEffect(() => {
        scrollToTop();
        axios.post(window.location.pathname)
            .then((response) => {
                formData['token'] = response.data.token;
                formData['email'] = response.data.email || '';
                setFormData(formData);
            }).catch((error) => {
                const errors = Object.entries(error.response.data.errors);
            }).finally(() => setIsLoaded(true));
    }, []);

    const handleChange = (e) => {
        formData[e.target.name] = e.target.value;
        setFormData(formData);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setFormErrors([]);

        const tokenValue = formData.token;
        const url = tokenValue.length === 6 ? '/password/newPasswordPhone' : '/password/newPassword';

        axios.post(url, formData)
            .then((response) => {
                if(response.data === 'success') {
                    window.location.href = '/cabinet';
                } else {
                    setFormErrors({'email': ['Неверный email-адрес']} )
                }
            }).catch((error) => {
                const errors = error.response.data.errors;
                setFormErrors(errors);
                window.scrollTo(0,0);
            }
        );
    };

    return (
        <div>
            <div className={'page-wrapper auth-page-wrapper'}>
                <div className={'auth-wrapper'}>
                    <div className={'newPassword-page magia-col-xs-16 magia-col-md-12 m-lr'}>
                        <div className="newPassword__form">
                            <div className="form__header">
                                <h2>Восстановление пароля</h2>
                                {Object.entries(formErrors).length > 0 && (
                                    <ul className={'form-errors'} style={{ display: 'block' }}>
                                        {Object.entries(formErrors).map((item, key) => {
                                            return (
                                                <li key={key}>
                                                    <pre style={{color: "red", fontFamily: 'inherit', whiteSpace: 'pre-wrap'}}>{item[1].join('\n')}</pre>
                                                </li>
                                            );
                                        })}
                                    </ul>
                                )}
                            </div>
                            <div className="form__content">
                                <form className={'magia-form'} onSubmit={handleSubmit}>
                                    {/*{isLoaded && formData.token.length > 6 && (*/}
                                    {/*    <div className="login__input auth-input">*/}
                                    {/*        <label htmlFor="email">E-mail адрес</label>*/}

                                    {/*        <div className="magia-input-img">*/}
                                    {/*            <i className={'icon'}>*/}
                                    {/*                <img src={EmailSvg} alt={'name'} />*/}
                                    {/*            </i>*/}
                                    {/*            <input type="email"*/}
                                    {/*                   className={'magia-linear-input'}*/}
                                    {/*                   id={'email'}*/}
                                    {/*                   name={'email'}*/}
                                    {/*                   placeholder={'Введите почту'}*/}
                                    {/*                   style={{border: formErrors['email'] ? '1px solid red' : 'none'}}*/}
                                    {/*                   onChange={handleChange}*/}
                                    {/*            />*/}
                                    {/*        </div>*/}
                                    {/*    </div>*/}
                                    {/*)}*/}

                                    <div className="newPassword__passwords-block">
                                        <div className="login__input auth-input">
                                            <label htmlFor="password">Новый пароль</label>

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
                                        <input type="submit" className={'magia-send-button'} value={'Сохранить новый пароль'}/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default NewPasswordPage;
