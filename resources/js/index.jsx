/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import './index.css';
import './bootstrap';
import 'yet-another-react-lightbox/styles.css';
import 'yet-another-react-lightbox/styles.css';
import 'react-modal-video/scss/modal-video.scss';
import 'yet-another-react-lightbox/plugins/counter.css';
import 'yet-another-react-lightbox/plugins/captions.css';

import App from '@/App';
import React from 'react';
import { Provider } from 'react-redux';
import { store } from '@/Redux/stores/store';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import TranslationProvider from '@/Providers/TranslationProvider';

const root = createRoot(
  document.getElementById("root")
);

root.render(
  <Provider store={store}>
    <TranslationProvider>
      <BrowserRouter>
        <App />
      </BrowserRouter>
    </TranslationProvider>
  </Provider>
);

