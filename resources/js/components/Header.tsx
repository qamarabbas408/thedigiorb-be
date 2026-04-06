import { Link } from 'react-router-dom';
import { useSettings } from '@/context/SettingsContext';

export default function Header() {
  const { settings, loading } = useSettings();

  return (
    <header id="header" className="header d-flex align-items-center sticky-top">
      <div className="container position-relative d-flex align-items-center justify-content-between">
        <Link to="/" className="logo d-flex align-items-center me-auto me-xl-0">
          {loading ? (
            <h1 className="sitename">...</h1>
          ) : settings?.logo_type === 'image' && settings?.logo_image ? (
            <img 
              src={settings.logo_image} 
              alt={settings?.company_name || 'Logo'} 
              style={{ height: '50px', maxHeight: '50px' }}
            />
          ) : (
            <h1 className="sitename">{settings?.company_name}</h1>
          )}
        </Link>

        <nav id="navmenu" className="navmenu">
          <ul>
            <li>
              <Link to="/" className="active">Home</Link>
            </li>
            <li>
              <Link to="/#about">About</Link>
            </li>
            <li>
              <Link to="/#services">Services</Link>
            </li>
            <li>
              <Link to="/#portfolio">Portfolio</Link>
            </li>
            <li>
              <Link to="/#team">Team</Link>
            </li>
            <li>
              <Link to="/#contact">Contact</Link>
            </li>
          </ul>
          <i className="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a className="btn-getstarted" href="/#about">
          Get Started
        </a>
      </div>
    </header>
  );
}
