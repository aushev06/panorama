import React, {useEffect} from "react";
import FoodItem from './_item';

const Desktop = ({foods, selectFood}) => {


    return (
        <div className={"Desktop"}>
            {foods && foods.map((item) => {
                return (<div id={item.slug} className={"section scrollspy"} key={"category - " + item.id}>
                    <div className={"RestaurantPageMenuCategory_root magia-col-xs-15 magia-col-md-14 m-lr"}>
                        <div className={"RestaurantPageMenuCategory_header"}>
                            <div className={"RestaurantPageMenuCategory_headerContent"}>
                                <div className={"RestaurantPageMenuCategory_titleWrapper"}>
                                    <h2 className="RestaurantPageMenuCategory_title">{item.name}</h2>
                                    <span className="RestaurantPageMenuCategory_count">{item.count}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="RestaurantPageMenuCategory_items page-menu-category-wrapper magia-col-xs-15 magia-col-md-14 m-lr">
                        {item.foodProperties && item.foodProperties.map((food) => {
                            return (
                                // <FoodItem key={"food-" + food.id} food={food} selectFood={selectFood.bind(null)} />
                                <FoodItem {...food} food={food} key={"food-" + food.id} selectFood={selectFood}/>
                            )
                        })}
                    </div>
                </div>)
            })}

        </div>
    )
}


export default Desktop;
