import {
  useState,
  useEffect
} from 'react';

import { Helmet } from 'react-helmet';
import { useSelector } from 'react-redux';
import { useLocation } from 'react-router-dom';
import { Routes, Route } from 'react-router-dom';
import Layout from '@/Components/Layouts/Layout';
import { frontendRouteName } from '@/Utils/util';
import { frontendRoutes } from '@/Router/Web/routes';
import { useLaravelReactI18n } from 'laravel-react-i18n';

export default function Web(props) {
  const location = useLocation();
  const { t } = useLaravelReactI18n();
  const [route, setRoute] = useState(null);

  const settings = useSelector(
    (state) => state.settings.value
  );

  useEffect(() => {
    setRoute(frontendRouteName(location?.pathname
      ?? frontendRouteName("/"), frontendRouteName("*")
    ));
  }, [location])

  return (
    <>
      <Helmet>
        {/* Here we handle any changes to the document head. */}
        <title>{t(`frontend.${settings.app.name}`) + " | " + t(`frontend.${route}`)}</title>
      </Helmet>

      {/* Children */}
      {props.children}

      {/* Here we show our current page body */}
      {/* that is associated with current active route */}
      <Routes>
        {Object.entries(frontendRoutes.web).map(([route, props], index) => {
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
            element={(
              // Element associated with current route.
              <Layout layout={props?.layout ?? null}>
                {props?.element}
              </Layout>
            ) ?? (
                // Fall back element incase our route does not
                // have any valid element specified in web routes.
                <Layout layout={props?.layout ?? null}>
                  {t(`frontend.${route}`)}
                </Layout>
              )}
          />);
        })}
      </Routes>
    </>
  );
}
