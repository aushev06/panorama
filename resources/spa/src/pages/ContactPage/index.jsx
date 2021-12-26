import React from 'react';
import './index.scss';
import LinearInput from "../../components/FormInputs/LinearInput";
import LinearTextarea from "../../components/FormInputs/LinearTextarea";

import PersonSvg from 'static/imgs/contact-icons/mdi_person.svg';
// import EmailSvg from 'static/imgs/contact-icons/mdi_local_post_office.svg';
import CallIconSvg from 'static/imgs/contact-icons/call-icon.svg';
import MessageSvg from 'static/imgs/contact-icons/mdi_short_text.svg';
import CallSvg from 'static/imgs/contact-icons/call-outline.svg';
import LocationSvg from 'static/imgs/contact-icons/location.svg';
import HelpSvg from 'static/imgs/contact-icons/post.svg';
import InstagramSvg from 'static/imgs/contact-icons/logo-instagram.svg';
// import FacebookSvg from 'static/imgs/contact-icons/logo-facebook.svg';
import VKSvg from 'static/imgs/contact-icons/logo-vk.svg';
import scrollToTop from "../../helpers/scroll";
import {useSelector} from "react-redux";

// import axios from 'axios';
const token = document.head.querySelector('meta[name="csrf-token"]');

const ContactPage = () => {
    const phone = useSelector(state => {
        return state?.settingsReducer?.site?.items?.phone_number || '';
    })


    const mail = useSelector(state => {
        return state?.settingsReducer?.site?.items?.mail || '';
    })

    const instagram = useSelector(state => {
        return state?.settingsReducer?.site?.items?.instagram || '';
    })

    React.useEffect(() => {
        scrollToTop()
    }, []);

    return (
        <div className={'page-wrapper'}>
            <div className={'contact-page magia-col-xs-15 magia-col-md-12 m-lr'}>
                <div className="contact__wrapper">

                    <div className="feedback-block">
                        <h2>Обратная связь</h2>
                        <form action="/contact/feedback" method={'post'} >
                            <input type="hidden" name="_token" value={token.content} />

                            <label htmlFor="name">Имя</label>
                            <LinearInput type={'text'} name={'name'} id={'name'} required={true} placeholder={'Введите свое имя'} icon={PersonSvg}/>

                            <label htmlFor="phone">Номер телефона</label>
                            <LinearInput type={'tel'} name={'phone'} id={'phone'} required={true} placeholder={'Введите свой номер телефона'} icon={CallIconSvg}/>

                            <label htmlFor="message">Сообщение</label>
                            <LinearTextarea id={'message'} name={'feedback'} required={true} placeholder={'Введите текст'} icon={MessageSvg}/>

                            <input className={'magia-send-button'} type="submit" value={'Отправить сообщение'} />
                        </form>
                    </div>

                    <div className="information-block">

                        <div>
                            <div className="information__contacts">
                                <h2>Контакты</h2>
                                <div>
                                    <p><img src={CallSvg} alt={'Телефон'}/> <a href={`tel:${phone.replace(' ', '')}`}>{phone}</a></p>
                                    <p><img src={HelpSvg} alt={'Email'}/> <a href={`mailto:${mail}`}>{mail}</a></p>
                                </div>
                            </div>

                            {/*<div className="information__address">*/}
                            {/*    <h2>Адрес</h2>*/}
                            {/*    <div>*/}
                            {/*        <p><img src={LocationSvg} alt={'location'}/> пгт. Новофедоровка ул.Приморская 7</p>*/}
                            {/*    </div>*/}
                            {/*</div>*/}
                        </div>

                        <div className={'location-and-social'}>
                            {/*<div className={'location-map'}>*/}
                            {/*    <iframe*/}
                            {/*        src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac7a6be4ad34672209b1097e26347d164ad3960c2060c35696221af2fc609c496&amp;source=constructor"*/}
                            {/*        frameBorder="0"*/}
                            {/*    >*/}
                            {/*    </iframe>*/}
                            {/*    /!*<script type="text/javascript" charSet="utf-8" async*!/*/}
                            {/*    /!*        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ac7a6be4ad34672209b1097e26347d164ad3960c2060c35696221af2fc609c496&amp;width=700&amp;height=400&amp;lang=ru_RU&amp;scroll=true">*!/*/}
                            {/*    /!*</script>*!/*/}
                            {/*    /!*<img src="/images/magia-location.jpg" alt={'Магия вкуса'} />*!/*/}
                            {/*</div>*/}
                            <div className={'social-block'}>
                                <span>Мы в социальных сетях</span>
                                <span className={'dividing-line'}>
                                    {/*<svg width="158" height="1" viewBox="0 0 158 1" fill="none" xmlns="http://www.w3.org/2000/svg">*/}
                                    {/*    <line x1="4.37114e-08" y1="0.5" x2="158" y2="0.500014" stroke="black"/>*/}
                                    {/*</svg>*/}
                                </span>
                                <ul className={'social-list'}>
                                    <li className={'social-item'}>
                                        <a href={instagram}><img src={InstagramSvg} alt={'instagram'} style={{background: '#f7f7f9'}}/></a>
                                    </li>
                                    {/*<li className={'social-item'}>*/}
                                    {/*    <a href="#"><img src={FacebookSvg} alt={'facebook'}/></a>*/}
                                    {/*</li>*/}
                                    {/*<li className={'social-item'}>*/}
                                    {/*    <a href="#"><img src={VKSvg} alt={'vk'}/></a>*/}
                                    {/*</li>*/}
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
};

export default ContactPage;
