/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import './bootstrap';

import App from './Frontent/App';
import React from 'react';
import ReactDom from 'react-dom';

ReactDom.render(
  <App />, document.getElementById('root'),
);

