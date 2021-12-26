import React from 'react';
import './index.scss';
import {Link} from "react-router-dom";
import axios from "../../../core/config/axios";
import LoginForm from "./Forms/login";
import CodeForm from "./Forms/code";
import {Preloader} from "../../../components";
import scrollToTop from "../../../helpers/scroll";

const RecoveryPage = ({token}) => {

    React.useEffect(() => {
        scrollToTop();

        const elems = document.querySelectorAll('.tooltipped');
        const instances = M.Tooltip.init(elems, {margin: 10});
    }, []);

    const [formData, setFormData] = React.useState({
        email: '',
        _token: token.content
    });

    const [formErrors, setFormErrors] = React.useState([]);
    const [isMessageSent, setIsMessageSent] = React.useState(false);
    const [isReady, setIsReady] = React.useState(true);

    const handleChange = (e) => {
        formData[e.target.name] = e.target.value;
        setFormData(formData);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setFormErrors([]);
        setIsReady(false);

        let url = '';
        const countryCode = '7';
        const emailValue = formData['email'];

        if( emailValue.indexOf('@') !== -1 ) {
            url = 'email';
        } else if ( !isNaN(emailValue) && emailValue.length === 11 && emailValue[0] === countryCode ) {
            url = 'phone';
        } else {
            setFormErrors([[0, 'Неверно указан номер телефона или email-адрес']]);
            setIsReady(true);
            return alert('Неверно указан номер телефона или email-адрес')
        }

        axios.post(`/password/${url}`, formData)
            .then((response) => {
                if(url === 'phone') {
                    switch (response.data.isCodeType) {
                        case 'new':
                            alert('На Ваш телефон был отправлен код восстановления');
                            break;
                        case 'old':
                            alert('Введите последний полученный код восстановления');
                            break;
                        default:
                            alert('Необходимо активировать телефон через авторизацию');
                            return window.location.href = '/cabinet';
                    }

                    setIsMessageSent(true);
                } else {
                    alert('На Вашу почту отправлено сообщение');
                    window.location.href = '/cabinet';
                }
            }).catch((error) => {
                const errors = Object.entries(error.response.data.errors);
                setFormErrors(errors);
                window.scrollTo(0,0);
            }).finally(() => {
                setIsReady(true);
            }
        );
    };

    const handleSendCode = (e) => {
        e.preventDefault();
        setFormErrors([]);
        setIsReady(false);

        const codeValue = formData['code'];

        if( !isNaN(codeValue) && codeValue.length === 6 ) {
            axios.post('/password/phone/checkCode', formData)
                .then((response) => {
                    const code = response.data.code;
                    code ? window.location.href = `/password/newPassword/${code}` : setFormErrors([[0, code]]);
                    // window.location.href = '/cabinet';
                }).catch((error) => {
                    const errors = Object.entries(error.response.data.errors);
                    setFormErrors(errors);
                    window.scrollTo(0,0);
                }
            );
        }
        setIsReady(true);
    };

    return (
        <div>
            <div className={'page-wrapper auth-page-wrapper'}>
                <div className={'auth-wrapper'}>
                    <div className={'recovery-page magia-col-xs-16 magia-col-md-12 m-lr'}>
                        <div className="auth__form">
                            <div className="form__header">
                                <h2>Восстановить пароль</h2>
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
                                { !isReady
                                    ? <Preloader fullScreen={true}/>
                                    : (isMessageSent
                                        ? <CodeForm handleChange={handleChange} isReady={isReady} formErrors={formErrors} handleSubmit={handleSendCode} />
                                        : <LoginForm handleChange={handleChange} isReady={isReady} formErrors={formErrors} handleSubmit={handleSubmit} /> )
                                }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default RecoveryPage;
