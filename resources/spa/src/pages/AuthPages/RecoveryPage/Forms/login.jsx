import React from 'react';

const LoginForm = ({handleSubmit, handleChange, formErrors, isReady}) => {
    return (
        <form className={'magia-form'} onSubmit={handleSubmit}>
            <div className="recovery__input auth-input">
                <label htmlFor="email">Номер телефона или email-адрес</label>
                <input type="text"
                       className={'magia-linear-input tooltipped'}
                       data-position="top"
                       data-tooltip='Формат ввода телефона: 79780123456'
                       id={'email'}
                       name={'email'}
                       placeholder={'Введите текст'}
                       onChange={handleChange}
                       style={{border: formErrors.length > 0 ? '1px solid red' : 'none'}}
                />
            </div>

            <div className={'auth__auth-buttons'}>
                <input type="submit" className={'magia-send-button'} disabled={!isReady} value={'Сбросить пароль'}/>
            </div>
        </form>
    );
};

export default LoginForm;
