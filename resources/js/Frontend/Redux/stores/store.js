import { configureStore } from '@reduxjs/toolkit';
import themesReducer from '@/Redux/features/themes/themesSlice';
import searchesReducer from '../features/searches/searchesSlice';
import settingsReducer from '@/Redux/features/settings/settingsSlice';
import translationsReducer from '@/Redux/features/translations/translationsSlice';

export const store = configureStore({
  reducer: {
    themes: themesReducer,
    settings: settingsReducer,
    searches: searchesReducer,
    translations: translationsReducer,
  },
});