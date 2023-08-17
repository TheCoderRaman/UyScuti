import React from "react";
import HeroSection from '@/Pages/About/Components/Sections/HeroSection.jsx';
import HelpSection from '@/Pages/About/Components/Sections/HelpSection.jsx';
import FeaturesSection from '@/Pages/About/Components/Sections/FeaturesSection.jsx';

function About() {
    return (
        <>
            {/* Hero Section */}
            <HeroSection />

            {/* Features Section */}
            <FeaturesSection />

            {/* Help Section */}
            <HelpSection />
        </>
    );
}

export default About;