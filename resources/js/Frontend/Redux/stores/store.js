import { configureStore } from '@reduxjs/toolkit';
import settingsReducer from '@/Redux/features/settings/settingsSlice';
import translationsReducer from '@/Redux/features/translations/translationsSlice';

export const store = configureStore({
  reducer: {
    settings: settingsReducer,
    translations: translationsReducer
  },
});
