import React from "react";
import './index.css';

const MagiaInput = (children) => {
    const {img, input, withIcon=true} = children;

    return (
        <div className="cart__input col s12" style={{'gridTemplateColumns': !withIcon && 'auto'}}>
            { img ? <img src={img.src} alt={img.alt}/> : <div></div> }
            <input onChange={input.inputChange} id={input.id} name={input.name} type={input.type}
                   placeholder={input.placeholder}
                   className='magia-input'
                   defaultValue={input.defaultValue}
            />
        </div>
    )
};

export default MagiaInput;
