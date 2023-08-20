import React from 'react';
import Header from '@/Components/Header/Header.jsx';
import Footer from '@/Components/Footer/Footer.jsx';

function MaximalLayout(props) {
    return (
        <div 
            style={{
                width: '100vw',
                minWidth: '350px',
            }}
            className="flex flex-col min-h-screen h-[100%] justify-between bg-[#fff] dark:bg-[#202124] text-[#202124] dark:text[#bdc1c6]"
        >
            {/* Header Section */}
            <Header />

            <div className='h-[10vh] sm:h-10'></div>

            {/* Main Section */}
            <main className="main-layout flex flex-col">
                {props.children}
            </main>

            {/* Footer Section */}
            <Footer />
        </div>
    )
}

export default MaximalLayout;