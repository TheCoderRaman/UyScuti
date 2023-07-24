import { settings } from "@/Data/settings";
import { createSlice } from "@reduxjs/toolkit";

export const settingsSlice = createSlice({
    name: "settings",
    initialState: { value: settings },
    reducers: {
        /**
         * Reset settings to its initial state.
         * 
         * @param any state
         * @param any action
         * @return void
         */
        reset: (state, action) => {
            state.value = settings;
        }
    }
});

export const { 
    reset 
} = settingsSlice.actions;

export default settingsSlice.reducer;
