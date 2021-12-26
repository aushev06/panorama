import {PRELOADER_SET_PRELOADER} from "../types";

const initialState = true;

export default function (state = initialState, {type, payload}) {
    if (type === PRELOADER_SET_PRELOADER) {
        return payload;
    }

    return state;
}