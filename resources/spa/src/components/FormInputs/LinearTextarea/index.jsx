import React from 'react';
import './index.css';

const LinearTextarea = ({icon, id, name, placeholder, required = false}) => {

    return (
        <div className={'magia-linear-textarea__wrapper'}>
            <i className={'icon'}>
                <img src={icon} alt={'name'} />
            </i>
            <textarea id={id} name={name}
                    required={required}
                    placeholder={placeholder}
                    rows="4"
                    className='magia-linear-textarea'>
            </textarea>
        </div>
    );
};

export default LinearTextarea;
