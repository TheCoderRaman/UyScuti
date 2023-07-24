import Home from "@/Pages/Home";
import Error from "@/Pages/Error";
import Search from "@/Pages/Search";

/**
 * This module give us a single location for altering any
 * route in the entire application at any point of 
 * time in the future.
 * 
 * @var const Object routes
 */
export const routes = {
    Error: {
        name: "Error",
        path: "*",
        element: <Error />
    },
    Home: {
        name: "Home",
        path: '/',
        element: <Home />
    },
    SignIn: {
        name: "Sign In",
        path: '/sign-in',
        element: <>Sign In</>
    },
    SignUp: {
        name: "Sign Up",
        path: '/sign-up',
        element: <>Sign Up</>
    },
    Search: {
        name: "Search",
        path: '/search',
        element: <>Search</>
    }
};