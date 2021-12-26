import React, {useState} from "react";
import './index.scss';

const SwitchButton = (children) => {
    const { first, second, firstValue, secondValue, name, style, client, setClient, setType } = children;
    const [checkedValue, setCheckedValue] = useState(0);
    const [inputValue, setInputValue] = useState(firstValue);

    const handleClick = (e) => {
        const dataset = e.target.dataset;
        const checked = +dataset.checked;
        const value = +dataset.value;

        setCheckedValue(checked);
        setInputValue(value);

        setType(value);
        setClient({
            ...client,
            [name]: value
        });
    };

    return (
        <div className="switch__wrapper">
            <div className={`switch-btn ${checkedValue === 0 ? 'checked' : ''}`}
                 style={style}
                 data-checked={0}
                 data-value={firstValue}
                 onClick={handleClick}
            >
                {first}
            </div>

            <input type="checkbox"
                   name={name}
                   value={inputValue}
                   readOnly
                   checked={checkedValue}
            />

            <svg width="13" height="1" viewBox="0 0 13 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line y1="0.5" x2="13" y2="0.5" stroke="#294053"/>
            </svg>

            <div className={`switch-btn ${checkedValue === 1 ? 'checked' : ''}`}
                 style={style}
                 data-checked={1}
                 data-value={secondValue}
                 onClick={handleClick}
            >
                {second}
            </div>
        </div>
    );
}

export default SwitchButton;
