import {SettingsApi} from "../api";
import {settingsActions} from "../../redux/actions";

const SettingsService = {
    save: (store) => {
        SettingsApi.get()
            .then((response) => {
                let settings = [];
                response.data.settings.forEach((item) => {
                    settings.push(item);
                });
                store.dispatch(settingsActions.setSettings(settings));
            })
            .catch((error) => {
                console.log(error);
                store.dispatch(settingsActions.setSettings([]));
            });

        SettingsApi.getSiteSettings()
            .then((response) => {
                let siteSttings = [];
                response.data.siteSettings.forEach((item) => {
                    siteSttings.push(item);
                });
                store.dispatch(settingsActions.setSiteSettings(siteSttings));
            })
            .catch((error) => {
                console.log(error);
                store.dispatch(settingsActions.setSiteSettings([]));
            });

    },
};

export default SettingsService;
