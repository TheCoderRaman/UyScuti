import React from 'react';

function AuthLayout(props) {
    return (
        <div
            style={{
                width: '100vw',
                minWidth: '350px',
            }}
        >
            {/* Main Section */}
            <main className="auth-layout">
                {props.children}
            </main>
        </div>
    )
}

export default AuthLayout;