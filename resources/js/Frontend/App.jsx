import React from 'react';
import Web from '@/Router/Web';
import ThemeProvider from '@/Providers/ThemeProvider.jsx';

function App() {
  return (
    <ThemeProvider>
      <Web />
    </ThemeProvider>
  )
}

export default App;