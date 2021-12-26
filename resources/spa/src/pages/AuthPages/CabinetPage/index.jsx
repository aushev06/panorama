import React from 'react';
import './index.scss';
import axios from "../../../core/config/axios";
import DesktopAuth from "./Desktop";
import MobileAuth from "./Mobile";
import {useSelector} from "react-redux";
import scrollToTop from "../../../helpers/scroll";

const CabinetPage = ({token}) => {

    const [userOrders, setUserOrders] = React.useState([]);
    const [formData, setFormData] = React.useState({
        name: '',
        email: '',
        phone: '',
        birthday: '',
        address: '',
    });
    const [isReady, setIsReady] = React.useState(true);

    const user = window.user;
    const isMobile = (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));

    React.useEffect(() => {
        scrollToTop();

        axios.get('/user/orders')
            .then((response) => {
                setUserOrders(response.data.orders);
            }).catch((error) => {
            const errors = Object.entries(error.response.data.errors);
        });

        setFormData({
            name: user.name,
            email: user.email,
            phone: user.phone,
            birthday: user.birthday,
            address: user.address,
            _token: token.content
        });

    }, []);

    const handleChange = (e) => {
        setFormData({...formData, [e.target.name]: e.target.value});
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setIsReady(false);


        axios.post('/client', formData)
            .then((response) => {
                window.location.href = window.location.pathname;
            }).catch((error) => {
                const errors = Object.entries(error.response.data.errors);
                // item[1] = поле ввода (email, password, etc)
                // item[1][0] = сообщение об ошибке валидации
                const messageError = errors.map( item => item[1][0] );
                alert( messageError.join('\n') );
            }
        );

        setIsReady(true);
    };


    return (
        <div>
            <div className={'page-wrapper auth-page-wrapper'}>
                <div className={'auth-wrapper'}>
                    <div className={'cabinet-page magia-col-xs-16 magia-col-md-12 m-lr'}>
                        {isMobile
                            ? <MobileAuth handleChange={handleChange} handleSubmit={handleSubmit} setIsReady={setIsReady} formData={formData}
                                          userOrders={userOrders} isReady={isReady} />
                            : <DesktopAuth handleChange={handleChange} handleSubmit={handleSubmit} setIsReady={setIsReady} formData={formData}
                                           userOrders={userOrders} isReady={isReady} />
                        }
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CabinetPage;
