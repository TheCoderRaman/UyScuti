import { createSlice } from "@reduxjs/toolkit";
import { authentications } from "@/Data/authentications";

export const authenticationsSlice = createSlice({
    name: "authentications",
    initialState: { value: authentications },
    reducers: {
        /**
         * Set current status of logged.
         * 
         * @param any state 
         * @param any action 
         * @return void
         */
        setIsLoggged: (state, action) => {
            state.value.isLogged = action.payload;
        },

        /**
         * Set current user.
         * 
         * @param any state 
         * @param any action 
         * @return void
         */
        setUser: (state, action) => {
            state.value.user = action.payload;
        },

        /**
         * Set current access token.
         * 
         * @param any state 
         * @param any action 
         * @return void
         */
        setAccessToken: (state, action) => {
            state.value.accessToken = action.payload;
        },

        /**
         * Reset authentications to its initial state.
         * 
         * @param any state
         * @param any action
         * @return void
         */
        reset: (state, action) => {
            state.value = authentications;
        }
    }
});

export const { 
    setIsLoggged, setUser, setAccessToken, reset
} = authenticationsSlice.actions;

export default authenticationsSlice.reducer;
