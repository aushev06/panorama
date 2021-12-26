import React from 'react';
import './index.css';

const LinearInput = ({icon, id, name, type, placeholder, pattern, required = false}) => {

    return (
        <div className={'magia-linear-input__wrapper'}>
            <i className={'icon'}>
                <img src={icon} alt={'name'} />
            </i>
            <input id={id} name={name} type={type}
                   required={required}
                   placeholder={placeholder}
                   pattern={pattern}
                   className='magia-linear-input'
            />
        </div>
    );
};

export default LinearInput;
