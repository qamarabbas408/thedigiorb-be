import { useSettings } from '@/context/SettingsContext';
import { useStatsBySection } from '@/hooks';

export default function About() {
  const { settings, loading } = useSettings();
  const { data: stats, isLoading: statsLoading } = useStatsBySection('about');

  const experienceStat = stats?.find(s => s.label.toLowerCase().includes('excellence') || s.label.toLowerCase().includes('years'));
  const projectStats = stats?.filter(s => !s.label.toLowerCase().includes('excellence') && !s.label.toLowerCase().includes('years')) || [];

  return (
    <section id="about" className="about section">
      <div className="container" data-aos="fade-up" data-aos-delay="100">
        <div className="row gy-5 align-items-center">
          <div className="col-xl-6" data-aos="fade-right" data-aos-delay="200">
            <div className="about-images-wrapper">
              <div className="image-main">
                <img src="/assets/img/about/about-5.webp" alt="Business meeting" className="img-fluid" />
              </div>
              <div className="image-offset">
                <img src="/assets/img/about/about-square-3.webp" alt="Detail shot" className="img-fluid" />
              </div>
              <div className="experience-badge">
                <span className="years">
                  {experienceStat ? experienceStat.value : '12'}
                </span>
                <span className="text">Years of<br />Excellence</span>
              </div>
              <div className="shape-pattern"></div>
            </div>
          </div>
          <div className="col-xl-6" data-aos="fade-left" data-aos-delay="300">
            <div className="about-content">
              <div className="section-subtitle">Who We Are</div>
              <h2>Innovating for Your Success Through Technology</h2>
              <p className="lead-text">
                We are a forward-thinking digital agency dedicated to transforming businesses through innovative technology solutions. Our team combines creativity with technical expertise to deliver exceptional results.
              </p>
              <p className="mb-4 description">
                With years of experience in web development, mobile apps, and digital strategy, we help clients navigate the digital landscape with confidence. Every project we undertake is driven by a commitment to quality, innovation, and measurable outcomes.
              </p>
              <div className="features-grid">
                <div className="feature-card">
                  <i className="bi bi-check-circle-fill"></i>
                  <span>Fast Delivery</span>
                </div>
                <div className="feature-card">
                  <i className="bi bi-check-circle-fill"></i>
                  <span>Quality Assured</span>
                </div>
                <div className="feature-card">
                  <i className="bi bi-check-circle-fill"></i>
                  <span>Expert Team</span>
                </div>
                <div className="feature-card">
                  <i className="bi bi-check-circle-fill"></i>
                  <span>24/7 Support</span>
                </div>
              </div>
              {!statsLoading && projectStats.length > 0 && (
                <div className="stats-row">
                  {projectStats.sort((a, b) => a.display_order - b.display_order).map((stat) => (
                    <div key={stat.id} className="stat-box">
                      <span className="number">{stat.value}</span>
                      <span className="label">{stat.label}</span>
                    </div>
                  ))}
                </div>
              )}
              <div className="action-buttons">
                <a href="#portfolio" className="btn btn-primary-custom">
                  View Our Work <i className="bi bi-arrow-right"></i>
                </a>
                <div className="contact-info">
                  <div className="icon-box">
                    <i className="bi bi-telephone-fill"></i>
                  </div>
                  <div className="text">
                    <span>Call Us Today</span>
                    <a href={`tel:${loading ? '' : settings?.company_phone?.replace(/\s/g, '')}`}>
                      {loading ? 'Loading...' : settings?.company_phone}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
