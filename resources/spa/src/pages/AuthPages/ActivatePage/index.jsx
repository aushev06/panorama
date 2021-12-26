import React from 'react';
import './index.scss';
import {Link} from "react-router-dom";
import axios from "../../../core/config/axios";
import scrollToTop from "../../../helpers/scroll";

const ActivatePage = ({token}) => {
    React.useEffect(() => {
        scrollToTop()
    }, []);

    const [formData, setFormData] = React.useState({
        code: '',
        _token: token.content
    });

    const [formErrors, setFormErrors] = React.useState([]);

    const handleChange = (e) => {
        formData[e.target.name] = e.target.value;
        setFormData(formData);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setFormErrors([]);

        const codeValue = formData['code'];

        if( !isNaN(codeValue) && codeValue.length === 4 ) {
            axios.post('/auth/activate', formData)
                .then((response) => {
                    response.data === 'success'
                        ? window.location.href = '/cabinet'
                        : setFormErrors([[0, 'Неверный код активации']]);
                }).catch((error) => {
                    const errors = Object.entries(error.response.data.errors);
                    setFormErrors(errors);
                    window.scrollTo(0,0);
                }
            );
        } else {
            setFormErrors([[0, 'Неверный код активации']]);
        }

    };

    return (
        <div>
            <div className={'page-wrapper auth-page-wrapper'}>
                <div className={'auth-wrapper'}>
                    <div className={'activate-page magia-col-xs-16 magia-col-md-12 m-lr'}>
                        <div className="auth__form">
                            <div className="form__header">
                                <h2>Активировать аккаунт</h2>
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
                                    <div className="activate__input auth-input">
                                        <label htmlFor="code">Код активации</label>
                                        <input type="text"
                                               max={4}
                                               className={'magia-linear-input'}
                                               id={'code'}
                                               name={'code'}
                                               placeholder={'Введите код'}
                                               onChange={handleChange}
                                               style={{border: formErrors.length > 0 ? '1px solid red' : 'none'}}
                                        />
                                    </div>

                                    <div className={'auth__auth-buttons'}>
                                        <input type="submit" className={'magia-send-button'} value={'Активировать'}/>
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

export default ActivatePage;
