import React from 'react';
import './index.css';
import MobileCatalog from "./components/MobileCatalog";
import {connect} from "react-redux";
import {appActions} from "../../redux/actions";



const HeaderCategory = ({items, currentItem, foods, categories, setIsChild, isChild}) => {

    return (
        <div>
            <div className={"d-flex justify-index"}>
                <MobileCatalog items={items} currentItem={currentItem} foods={foods} categories={categories} setIsChild={setIsChild} isChild={isChild}/>
            </div>
        </div>
    )
};

const mapStateToProps = state => {
    return {
        items: state.categoryReducer.items,
        foods: state.foodReducer.items,
        currentItem: state.foodReducer.currentItem,
        categories: state.categoryReducer.items,
    }
};

export default connect(mapStateToProps, {...appActions})(HeaderCategory);
