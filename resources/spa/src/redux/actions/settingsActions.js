const SettingsActions = {
    setSettings: (items) => ({
        type: "SETTINGS:SET_ITEMS",
        payload: items
    }),
    setSiteSettings: (items) => ({
        type: "SITE_SETTINGS:SET_ITEMS",
        payload: items
    }),
};

export default SettingsActions;
