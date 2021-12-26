import React from "react";
import {connect} from "react-redux";
import {appActions, categoriesActions, foodActions} from "../../redux/actions";
import Mobile from "./Categories/Mobile";
import Desktop from "./Categories/Desktop";

const Landing = ({items}) => {
    const categories = items.slice(0, 5);
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));

    return (
        <>
            {/*<div className={'landing__wrapper landing-background'}>*/}
            {/*  <div className={`${isMobile ? 'magia-col-14 m-lr ' : ''}d-flex align-items-center h-inherit`}>*/}
            {/*    <div className={`${isMobile ? '' : 'magia-col-5 '}landing__main-content`}>*/}
            <div className={'landing__wrapper landing-background'}>
                <div className={'magia-col-xs-15 magia-col-sm-14 magia-col-md-14 m-lr d-flex align-items-center h-inherit'}>
                    <div className={'magia-col-xs-15 magia-col-sm-11 magia-col-md-7 landing__main-content'}>
                        <h2>Мы лучшие - просто попробуй!</h2>
                        <p>Доставка еды европейской и азиатской кухни</p>
                        <a href="/menu" className={`${isMobile ? 'w-100 ' : ''}magia-order-btn`}>Смотреть меню</a>
                    </div>
                    {isMobile && <Mobile items={categories} />}
                    {/*{(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent))*/}
                    {/*    ? ( <Mobile items={categories} handleClick={handleClick} /> )*/}
                    {/*    : ( <Desktop items={categories} handleClick={handleClick} /> )*/}
                    {/*}*/}
                </div>
                {!isMobile && <Desktop items={categories} />}
            </div>
        </>
    );
};
const mapStateToProps = (state) => {

    return {
        items: state.categoryReducer.items,
    }
};

export default connect(mapStateToProps, {...appActions})(Landing);
