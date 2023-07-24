import { 
  useState, 
  useEffect 
} from "react";

import { Helmet } from 'react-helmet';
import { useSelector } from 'react-redux';
import { routeName } from '@/Utils/util';
import { routes } from '@/Router/Web/routes';
import { useTranslation } from 'react-i18next';
import { useLocation } from 'react-router-dom';
import { Routes, Route } from 'react-router-dom';

export default function Web(props) {
  const { t } = useTranslation();
  const location = useLocation();
  const [route,setRoute] = useState(null);
  
  const settings = useSelector(
    (state) => state.settings.value
  );

  useEffect(() => {
    setRoute(routeName(
        location?.pathname ?? routeName("/"), routeName("*")
    ));
  }, [location])

  return (
    <>
      <Helmet>
        {/* Here we handle any changes to the document head. */}
        <title>{t(settings.app.name)+" | "+t(route)}</title>
      </Helmet>

      {/* Children */}
      {props.children}

      {/* Here we show our current page body */}
      {/* that is associated with current active route */}
      <Routes>
        {Object.entries(routes).map(([route,props],index) => {
          return (<Route
            // We can also destructure 
            // props here like this {...props}
            // But for better controll over route we 
            // handle it manually for providing fallbacks.
            key={index}
            exact={true}
            // Assign route
            path={props?.path ?? null} 
            // Assign element 
            element={props?.element ?? (
              // Fall back element incase our route does not 
              // have any valid element specified in web routes.
              <>{t(route)}</>
            )}
          />);
        })}
      </Routes>
    </>
  );
}
