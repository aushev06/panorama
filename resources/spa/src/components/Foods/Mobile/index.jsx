import React from 'react';
import FoodItem from "./MobileFoodItem";


const Mobile = ({foods, selectFood}) => {
    // console.log(foods)
    return (
        <div className={"Mobile"}>
            {foods.map((category) => {
                return (
                    <ul className={"MobileRestaurantPageMenuList_listRoot scrollspy"} id={category.slug}
                        key={`category-${category.id}` }>
                        <li className={"MobileRestaurantPageMenuList_category magia-col-xs-15 magia-col-md-14 m-lr"}>
                            <div>
                                <div className={"MobileRestaurantPageMenuCategory_root"}>
                                    <div className={"MobileRestaurantPageMenuCategory_header"}>
                                        <div className={"MobileRestaurantPageMenuCategory_label"}>
                                            <div className={"MobileRestaurantPageMenuCategory_titleAndCount"}>
                                                <h2 className={"MobileRestaurantPageMenuCategory_name"}>{category.name}</h2>
                                                <div
                                                    className={"MobileRestaurantPageMenuCategory_count"}>{category.count}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul className={"MobileRestaurantPageMenuCategory_items"}>
                                        {category.foodProperties && category.foodProperties.map((food) => {
                                            return (
                                                <FoodItem {...food} food={food} key={"food-" + food.id} selectFood={selectFood}/>
                                            )
                                        })}

                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                )
            })}

        </div>
    )
}

export default Mobile;
