import React from 'react';
import TopSection from '@/Pages/Home/Components/Sections/Top/TopSection.jsx';
import MiddleSection from '@/Pages/Home/Components/Sections/Middle/MiddleSection.jsx';
import BottomSection from '@/Pages/Home/Components/Sections/Bottom/BottomSection.jsx';

function Home() {
  return (
    <>
      <div className="pt-[6%]">
        <TopSection />
      </div>

      <div className="grid place-items-center grid-cols-1 grid-rows-2 pt-5">
        <MiddleSection />
      </div>

      <BottomSection />
    </>
  );
}

export default Home;