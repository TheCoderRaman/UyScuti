import React from 'react';
import Web from '@/Router/Web';
import ThemeProvider from '@/Providers/ThemeProvider.jsx';
import AuthenticationProvider from '@/Providers/AuthenticationProvider';

function App() {
  return (
    <ThemeProvider>
      <AuthenticationProvider>
        <Web />
      </AuthenticationProvider>
    </ThemeProvider>
  )
}

export default App;