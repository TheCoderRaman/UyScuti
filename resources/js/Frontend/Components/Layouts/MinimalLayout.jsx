import React from 'react';

function MinimalLayout(props) {
    return (
        <div className="flex flex-col min-h-screen h-[100%] justify-between  bg-[#fff] dark:bg-[#202124] text-[#202124] dark:text[#bdc1c6] min-w-[650px]">
            {/* Main Section */}
            <main className="main-layout">
                {props.children}
            </main>
        </div>
    )
}

export default MinimalLayout;