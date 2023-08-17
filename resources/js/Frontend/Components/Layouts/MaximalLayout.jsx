import React from 'react';
import Header from '@/Components/Header/Header.jsx';
import Footer from '@/Components/Footer/Footer.jsx';

function MaximalLayout(props) {
    return (
        <div className="flex flex-col min-h-screen h-[100%] justify-between  bg-[#fff] dark:bg-[#202124] text-[#202124] dark:text[#bdc1c6] min-w-[650px]">
            {/* Header Section */}
            <Header />

            {/* Main Section */}
            <main className="main-layout">
                {props.children}
            </main>
            
            {/* Footer Section */}
            <Footer />
        </div>
    )
}

export default MaximalLayout;