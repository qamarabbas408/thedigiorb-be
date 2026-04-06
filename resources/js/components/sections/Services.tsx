import { usePublishedServices } from '@/hooks';
import { useStatsBySection } from '@/hooks';

export default function Services() {
  const { data: services, isLoading } = usePublishedServices();
  const { data: stats } = useStatsBySection('services');

  if (isLoading) {
    return null;
  }

  const featuredServices = services?.filter(s => s.featured) || [];
  const regularServices = services?.filter(s => !s.featured) || [];

  return (
    <section id="services" className="services section">
      <div className="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Expert solutions tailored to transform your digital presence and drive business growth</p>
      </div>

      <div className="container" data-aos="fade-up" data-aos-delay="100">
        <div className="row g-4">
          {featuredServices.map((service, index) => (
            <div key={service.id} className="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay={(index + 1) * 100}>
              <div className="service-card featured">
                <div className="featured-badge">
                  <i className="bi bi-star-fill"></i>
                  <span>Popular</span>
                </div>
                <div className="icon-wrapper">
                  <i className={`bi ${service.icon}`}></i>
                </div>
                <h3>{service.title}</h3>
                <p>{service.description}</p>
                <a href="/service-details" className="service-link">
                  <span>Discover More</span>
                  <i className="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          ))}

          {regularServices.map((service, index) => (
            <div key={service.id} className="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay={(featuredServices.length + index + 1) * 100}>
              <div className="service-card">
                <div className="icon-wrapper">
                  <i className={`bi ${service.icon}`}></i>
                </div>
                <h3>{service.title}</h3>
                <p>{service.description}</p>
                <a href="/service-details" className="service-link">
                  <span>Discover More</span>
                  <i className="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          ))}
        </div>

        <div className="stats-row" data-aos="fade-up" data-aos-delay="400">
          <div className="row g-4 justify-content-center">
            {stats && stats.length > 0 ? (
              stats.sort((a, b) => a.display_order - b.display_order).map((stat) => (
                <div key={stat.id} className="col-6 col-md-3">
                  <div className="stat-item">
                    <span className="stat-number">{stat.value}</span>
                    <span className="stat-label">{stat.label}</span>
                  </div>
                </div>
              ))
            ) : (
              <>
                <div className="col-6 col-md-3">
                  <div className="stat-item">
                    <span className="stat-number">250+</span>
                    <span className="stat-label">Projects Delivered</span>
                  </div>
                </div>
                <div className="col-6 col-md-3">
                  <div className="stat-item">
                    <span className="stat-number">98%</span>
                    <span className="stat-label">Client Satisfaction</span>
                  </div>
                </div>
                <div className="col-6 col-md-3">
                  <div className="stat-item">
                    <span className="stat-number">15+</span>
                    <span className="stat-label">Years Experience</span>
                  </div>
                </div>
                <div className="col-6 col-md-3">
                  <div className="stat-item">
                    <span className="stat-number">40+</span>
                    <span className="stat-label">Team Experts</span>
                  </div>
                </div>
              </>
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
