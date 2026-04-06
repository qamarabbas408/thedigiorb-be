import { useStatsBySection } from '@/hooks';

export default function Hero() {
  const { data: stats, isLoading } = useStatsBySection('hero');

  return (
    <section id="hero" className="hero section">
      <div className="container" data-aos="fade-up" data-aos-delay="100">
        <div className="row align-items-center gy-5">
          <div className="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div className="hero-content">
              <div className="hero-tag" data-aos="fade-up" data-aos-delay="250">
                <span className="tag-dot"></span>
                <span className="tag-text">Premium Digital Solutions</span>
              </div>
              <h1 className="hero-headline" data-aos="fade-up" data-aos-delay="300">
                Crafting Exceptional Digital Experiences
              </h1>
              <p className="hero-text" data-aos="fade-up" data-aos-delay="350">
                We build innovative digital solutions that help businesses grow. From web development to mobile apps, we bring your vision to life.
              </p>
              <div className="hero-cta" data-aos="fade-up" data-aos-delay="400">
                <a href="#services" className="cta-button">
                  <span>Explore Services</span>
                  <i className="bi bi-arrow-right"></i>
                </a>
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" className="glightbox cta-link" data-gallery="hero-video">
                  <i className="bi bi-play-circle"></i>
                  <span>Watch Video</span>
                </a>
              </div>
            </div>
          </div>
          <div className="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div className="stats-grid">
              {!isLoading && stats && stats.length > 0 ? (
                stats.sort((a, b) => a.display_order - b.display_order).map((stat, index) => (
                  <div 
                    key={stat.id} 
                    className={`stat-card ${index === 0 ? 'stat-card-primary' : index === 3 ? 'stat-card-accent' : ''}`}
                    data-aos="zoom-in" 
                    data-aos-delay={350 + (index * 50)}
                  >
                    <div className="stat-icon-wrap">
                      <i className={`bi ${stat.icon}`}></i>
                    </div>
                    <div className="stat-info">
                      <span className="stat-value">{stat.value}</span>
                      <span className="stat-title">{stat.label}</span>
                    </div>
                  </div>
                ))
              ) : (
                <>
                  <div className="stat-card stat-card-primary" data-aos="zoom-in" data-aos-delay="350">
                    <div className="stat-icon-wrap">
                      <i className="bi bi-rocket-takeoff"></i>
                    </div>
                    <div className="stat-info">
                      <span className="stat-value">150+</span>
                      <span className="stat-title">Projects Launched</span>
                    </div>
                  </div>
                  <div className="stat-card" data-aos="zoom-in" data-aos-delay="400">
                    <div className="stat-icon-wrap">
                      <i className="bi bi-heart"></i>
                    </div>
                    <div className="stat-info">
                      <span className="stat-value">98%</span>
                      <span className="stat-title">Client Satisfaction</span>
                    </div>
                  </div>
                  <div className="stat-card" data-aos="zoom-in" data-aos-delay="450">
                    <div className="stat-icon-wrap">
                      <i className="bi bi-lightbulb"></i>
                    </div>
                    <div className="stat-info">
                      <span className="stat-value">12+</span>
                      <span className="stat-title">Years Experience</span>
                    </div>
                  </div>
                  <div className="stat-card stat-card-accent" data-aos="zoom-in" data-aos-delay="500">
                    <div className="stat-icon-wrap">
                      <i className="bi bi-briefcase"></i>
                    </div>
                    <div className="stat-info">
                      <span className="stat-value">40+</span>
                      <span className="stat-title">Team Experts</span>
                    </div>
                  </div>
                </>
              )}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
