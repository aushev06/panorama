import React, {useState,useEffect} from "react";
import './index.css';
import {connect} from "react-redux";
import {appActions, foodActions} from "../../redux/actions";
import {ModalOptions} from "../index";
import FoodItems from "./items";

const Foods = ({foods, categories, currentItem, setCartItem}) => {
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));

    const [food, setFood] = useState(null);
    const currentFood = currentItem && foods.length > 0 && foods[0].child.length === 0 ? foods : [];
    const addToCart = (foodItem, foodPropertyId) => {

        if (foodItem.options.length > 0) {
            let item = {...foodItem};
            item.selectProperty = item.properties.find(food => food.id === foodPropertyId);

            setFood(item)
        } else {
            setCartItem(foodPropertyId);
        }
    };

    useEffect(() => {
        const elems = document.querySelectorAll('.materialboxed');
        const instances = M.Materialbox.init(elems, {});
    }, []);

    return (
        // <div className="content magia-col-md-12 m-lr">
        <div className="magia-col-md-14 m-lr">
            {/*{isMobile ? <Mobile foods={currentFood} selectFood={addToCart}/> : <Desktop foods={currentFood} selectFood={addToCart}/>}*/}
            <FoodItems foods={currentFood} selectFood={addToCart} />
            {food && <ModalOptions food={food} setCartItem={setCartItem} onSend={() => setFood(null)}/>}

        </div>
    )
};

const mapStateToProps = state => {
    return {
        foods: state.foodReducer.items,
        categories: state.categoryReducer.items,
        currentItem: state.foodReducer.currentItem
    }
};

export default connect(mapStateToProps, {...appActions})(Foods);
