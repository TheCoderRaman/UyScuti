import { createSlice } from "@reduxjs/toolkit";
import { translations } from "@/Data/translations";

export const translationsSlice = createSlice({
    name: "translations",
    initialState: { value: translations },
    reducers: {
        /**
         * Set current locale.
         *
         * @param any state
         * @param any action
         * @return void
         */
        setLocale: (state, action) => {
            state.value.locale = action.payload;
        },

        /**
         * Set current available locales.
         *
         * @param any state
         * @param any action
         * @return void
         */
        setLocales: (state, action) => {
            state.value.locales = action.payload;
        },

        /**
         * Set current loading status.
         *
         * @param any state
         * @param any action
         * @return void
         */
        setLoading: (state, action) => {
            state.value.loading = action.payload;
        },

        /**
         * Set current fallback locale.
         *
         * @param any state
         * @param any action
         * @return void
         */
        setFallbackLocale: (state, action) => {
            state.value.fallbackLocale = action.payload;
        },

        /**
         * Reset translations setting to its initial state.
         * 
         * @param any state
         * @param any action
         * @return void
         */
        reset: (state, action) => {
            state.value = translations;
        }
    }
});

export const { 
    setLocale, 
    setLocales, 
    setLoading, 
    setFallbackLocale, 
    reset 
} = translationsSlice.actions;

export default translationsSlice.reducer;
