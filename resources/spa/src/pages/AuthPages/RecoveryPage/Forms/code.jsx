import React from 'react';

const CodeForm = ({handleSubmit, handleChange, formErrors, isReady}) => {
    return (
        <form className={'magia-form'} onSubmit={handleSubmit}>
            <div className="recovery__input auth-input">
                <label htmlFor="code">Код восстановления</label>
                <input type="text"
                       max={6}
                       className={'magia-linear-input'}
                       id={'code'}
                       name={'code'}
                       placeholder={'Введите код'}
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

export default CodeForm;
