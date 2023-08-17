import React from 'react';

function AuthLayout(props) {
    return (
        <div>
            {/* Main Section */}
            <main className="auth-layout">
                {props.children}
            </main>
        </div>
    )
}

export default AuthLayout;