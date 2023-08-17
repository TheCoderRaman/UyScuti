import { searches } from "@/Data/searches";
import { createSlice } from "@reduxjs/toolkit";

export const searchesSlice = createSlice({
    name: "searches",
    initialState: { value: searches },
    reducers: {
        /**
         * Set current status of typing.
         * 
         * @param any state 
         * @param any action 
         * @return void
         */
        setIsTyping: (state, action) => {
            state.value.isTyping = action.payload;
        },

        /**
         * Set current search term.
         * 
         * @param any state 
         * @param any action 
         * @return void
         */
        setSearchTerm: (state, action) => {
            state.value.searchTerm = action.payload;
        },

        /**
         * Set current search for term.
         * 
         * @param any state 
         * @param any action 
         * @return void
         */
        setSearchForTerm: (state, action) => {
            state.value.searchForTerm = action.payload;
        },

        /**
         * Reset searches to its initial state.
         * 
         * @param any state
         * @param any action
         * @return void
         */
        reset: (state, action) => {
            state.value = searches;
        }
    }
});

export const { 
    setIsTyping, setSearchTerm, setSearchForTerm, reset
} = searchesSlice.actions;

export default searchesSlice.reducer;
