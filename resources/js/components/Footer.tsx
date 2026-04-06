import { Link } from 'react-router-dom';
import { useSettings } from '@/context/SettingsContext';

export default function Footer() {
  const { settings, loading } = useSettings();

  return (
    <footer id="footer" className="footer light-background">
      <div className="container footer-top">
        <div className="row gy-4">
          <div className="col-lg-3 col-md-6 footer-info">
            <Link to="/" className="logo d-flex align-items-center mb-4">
              {loading ? (
                <span className="sitename">...</span>
              ) : settings?.logo_type === 'image' && settings?.logo_image ? (
                <img 
                  src={settings.logo_image} 
                  alt={settings?.company_name || 'Logo'} 
                  style={{ height: '50px', maxHeight: '50px' }}
                />
              ) : (
                <span className="sitename">{settings?.company_name}</span>
              )}
            </Link>
            <p>{loading ? 'Loading...' : settings?.company_description}</p>
            <div className="social-links d-flex mt-4">
              <a href={settings?.facebook_url} aria-label="Facebook">
                <i className="bi bi-facebook"></i>
              </a>
              <a href={settings?.twitter_url} aria-label="Twitter">
                <i className="bi bi-twitter-x"></i>
              </a>
              <a href={settings?.instagram_url} aria-label="Instagram">
                <i className="bi bi-instagram"></i>
              </a>
              <a href={settings?.linkedin_url} aria-label="LinkedIn">
                <i className="bi bi-linkedin"></i>
              </a>
            </div>
          </div>

          <div className="col-lg-2 col-md-6 footer-links">
            <h4>Services</h4>
            <ul>
              <li><a href="/#services">Web Development</a></li>
              <li><a href="/#services">Mobile Apps</a></li>
              <li><a href="/#services">UI/UX Design</a></li>
              <li><a href="/#services">Custom Software</a></li>
              <li><a href="/#services">API Integration</a></li>
              <li><a href="/#services">Cloud Solutions</a></li>
            </ul>
          </div>

          <div className="col-lg-2 col-md-6 footer-links">
            <h4>Company</h4>
            <ul>
              <li><a href="/#about">About Us</a></li>
              <li><a href="/#portfolio">Portfolio</a></li>
              <li><a href="/#team">Our Team</a></li>
              <li><a href="/privacy">Privacy Policy</a></li>
              <li><a href="/terms">Terms of Service</a></li>
              <li><a href="/#contact">Contact</a></li>
            </ul>
          </div>

          <div className="col-lg-3 col-md-6">
            <div className="footer-newsletter">
              <h4>Stay Updated</h4>
              <p>
                Subscribe to our newsletter for the latest tech insights, project updates, and industry news.
              </p>
              <form className="php-email-form">
                <div className="position-relative">
                  <input type="email" name="email" placeholder="Your Email" required />
                  <button type="submit" className="btn-subscribe">
                    <i className="bi bi-arrow-right"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div className="container footer-bottom">
        <div className="row gy-3">
          <div className="col-md-6 order-2 order-md-1">
            <div className="copyright">
              <p>
                © <span>Copyright</span>{' '}
                <strong className="sitename">{loading ? '...' : settings?.company_name}</strong>. All Rights Reserved.
              </p>
            </div>
          </div>
          <div className="col-md-6 order-1 order-md-2">
            <div className="legal-links">
              <a href="/terms">Terms of Service</a>
              <a href="/privacy">Privacy Policy</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}
