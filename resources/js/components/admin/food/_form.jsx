import React from 'react'

import config from '../../../config/food'

const Form = ({id, name, price, old_price, is_visible, idx, sort, addVariant, img}) => {
    const [file, setFile] = React.useState(null);
    const imgRef = React.useRef(null);
    const changeFile = (e) => {
        const fileImg = e.target.files[0];
        if(fileImg) imgRef.current.src = URL.createObjectURL(fileImg);
        else        imgRef.current.src = img || '';
    };

    return (
        <>
            <div className="col-md-4 mt-1">
                <img src={img} alt={name} style={{width: 'inherit', marginBottom: '1em'}} ref={imgRef} />
                <div className="form-group" key={idx}>
                    <label>Выбрать фото &nbsp;</label>
                    <input name={'fp_img['+idx+']'} type="file" onChange={changeFile} />
                </div>
            </div>
            <div className={"col-md-8 mt-1"}>
                <div className="box_general padding_bottom">
                    <div className="header_box version_2">
                        <h2><i className="fa fa-plus"></i>Вариация</h2>
                    </div>
                    <input type="hidden" name={`FoodProperty[${idx}][id]`} defaultValue={id}/>
                    <input type="hidden" name={`FoodProperty[${idx}][sort]`} defaultValue={sort || idx}/>
                    <div>
                        <div className="form-group">
                            <label>Название</label>
                            <input className="form-control" defaultValue={name} type="text"
                                   name={`FoodProperty[${idx}][name]`}/>
                        </div>
                        <div className="form-group">
                            <label>Цена</label>
                            <input className="form-control" defaultValue={price} type="text"
                                   name={`FoodProperty[${idx}][price]`}/>
                        </div>
                        <div className="form-group">
                            <label>Старая цена</label>
                            <input className="form-control" defaultValue={old_price} type="text"
                                   name={`FoodProperty[${idx}][old_price]`}/>
                        </div>

                        <div className="form-group">
                            <label>Статус</label>
                            <select defaultValue={is_visible && ( is_visible.toString() || "" ) } name={`FoodProperty[${idx}][is_visible]`}
                                    className="form-control">
                                <option value="">Выберите статус</option>
                                {
                                    config.foodPropertyStatus.map((status, key) => {
                                        return <option value={key.toString()} key={status} >{status}</option>
                                    })
                                }
                            </select>
                        </div>
                    </div>

                    <div className="form-group float-right">
                        <button className="btn btn-info" type={'button'} onClick={addVariant}>+</button>
                    </div>

                    <div className="clearfix"></div>


                </div>
            </div>
        </>
    )
}

export default Form;
