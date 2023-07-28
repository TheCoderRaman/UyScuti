import { themes as uiStyles } from "@/Data/themes";
import { createSlice } from "@reduxjs/toolkit";

export const themesSlice = createSlice({
    name: "themes",
    initialState: { value: uiStyles },
    reducers: {
        /**
         * Set current active theme.
         * 
         * @param any state
         * @param any action
         * @return void
         */
        setTheme: (state, action) => {
            state.value.theme = action.payload;
            state.value.mode = (
                uiStyles.themes[state.value.theme].mode
            );
        }
    }
});

export const { 
    setTheme 
} = themesSlice.actions;

export default themesSlice.reducer;
