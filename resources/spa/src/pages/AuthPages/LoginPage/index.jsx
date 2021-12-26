import React from 'react';
import './index.scss';
import {Link} from "react-router-dom";
import axios from "../../../core/config/axios";
import {useSelector} from "react-redux";
import scrollToTop from "../../../helpers/scroll";

const LoginPage = ({token}) => {
    React.useEffect(() => {
        scrollToTop()
    }, []);

    const appSettings = useSelector((state) => {
        // console.log(state)
        return state.settingsReducer.items;
    });


    const [formData, setFormData] = React.useState({
        login: '',
        password: '',
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
        axios.post('/auth/login', formData)
            .then((response) => {
                window.location.href = '/cabinet';
            }).catch((error) => {
                const errors = Object.entries(error.response.data.errors);
                setFormErrors(errors);
                window.scrollTo(0,0);

                const wrongPassword = errors.flat().includes('wrongPassword');
                if(wrongPassword) {
                    return false;
                }

                const hasActivatingPhoneError = errors.flat().includes('activatingPhone');
                if(hasActivatingPhoneError) {
                    const alertErrors = errors.map(error => error[1]);
                    alert(alertErrors.join('\n'));
                    return window.location.href = '/auth/activate';
                }
            }
        );
        setIsReady(true);
    };

    return (
        <div>
            <div className={'page-wrapper auth-page-wrapper'}>
                <div className={'auth-wrapper'}>
                    <div className={'login-page magia-col-xs-16 magia-col-md-12 m-lr'}>
                        <div className="auth__form">
                            <div className="form__header">
                                <h2>Вход</h2>
                                {formErrors.length > 0 && (
                                    <ul className={'form-errors'} style={{ display: 'block' }}>
                                        {formErrors.map((item, key) => {
                                            return (
                                                <li key={key} style={{color: "red"}}>
                                                    <pre style={{color: "red", fontFamily: 'inherit', margin: 0, whiteSpace: 'pre-wrap'}}>{item[1]}</pre>
                                                </li>
                                            );
                                        })}
                                    </ul>
                                )}
                            </div>
                            <div className="form__content">
                                <form className={'magia-form'} onSubmit={handleSubmit}>
                                    <div className="login__input auth-input">
                                        <label htmlFor="login">Номер телефона или mail-адрес</label>
                                        <input type="text"
                                               className={'magia-linear-input'}
                                               id={'login'}
                                               name={'login'}
                                               placeholder={'Введите текст'}
                                               title={'Формат ввода телефона: 79780123456'}
                                               style={{border: formErrors.length > 0 ? '1px solid red' : 'none'}}
                                               required
                                               onChange={handleChange}
                                        />
                                    </div>
                                    <div className="login__input auth-input">
                                        <label htmlFor="password">Ваш пароль</label>
                                        <input type="password"
                                               className={'magia-linear-input'}
                                               id={'password'}
                                               name={'password'}
                                               placeholder={'Введите пароль'}
                                               style={{border: formErrors.length > 0 ? '1px solid red' : 'none'}}
                                               required
                                               onChange={handleChange}
                                        />
                                    </div>

                                    <div className={'auth__auth-buttons'}>
                                        <input type="submit" className={'magia-send-button'} disabled={!isReady} value={'Войти'}/>
                                        <a href="/register" className={'transparent-button'}>Зарегистрироваться</a>
                                        {/*<Link to="/register" className={'transparent-button'}>Зарегестрироваться</Link>*/}
                                    </div>
                                </form>
                            </div>

                            <div className="form__footer">
                                <div className="form__info">
                                    <p>Забыли пароль?</p>
                                    <a href="/password/reset">Восстановить</a>
                                    {/*<Link to="/password/reset">Восстановить</Link>*/}
                                </div>
                                <div className="form__info">
                                    <p>Нет аккаунта?</p>
                                    <a href="/register">Зарегистрироваться</a>
                                    {/*<Link to="/register">Зарегестрироваться</Link>*/}
                                </div>
                                { appSettings.SEND_PHONE_MESSAGE_OPERATION === true
                                    ? (
                                    <div className="form__info" style={{display: 'flex'}}>
                                        <p>Не активирован аккаунт?</p>
                                        <a href="/auth/activate">Активировать</a>
                                    </div>
                                    )
                                    : '' }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default LoginPage;
