import { useState } from 'react';
import { Link } from 'react-router-dom';
import { usePublishedProjects, useCategories } from '@/hooks';

export default function Portfolio() {
  const { data: projects, isLoading } = usePublishedProjects();
  const { data: categories } = useCategories();
  const [activeFilter, setActiveFilter] = useState('*');

  const getCategoryName = (categoryId: string) => {
    const category = categories?.find(c => c.id === categoryId);
    return category?.name || categoryId;
  };

  const getFilterClass = (categoryId: string) => {
    const category = categories?.find(c => c.id === categoryId);
    return category?.filter_class || `filter-${categoryId}`;
  };

  const handleFilterClick = (filterClass: string) => {
    setActiveFilter(filterClass);
  };

  const filteredProjects = projects?.filter(project => {
    if (activeFilter === '*') return true;
    return getFilterClass(project.category_id) === activeFilter;
  }) || [];

  if (isLoading) {
    return (
      <section id="portfolio" className="portfolio section">
        <div className="container section-title" data-aos="fade-up">
          <h2>Portfolio</h2>
          <p>Loading projects...</p>
        </div>
      </section>
    );
  }

  return (
    <section id="portfolio" className="portfolio section">
      <div className="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Our Work & Projects</p>
      </div>

      <div className="container" data-aos="fade-up" data-aos-delay="100">
        <div className="portfolio-container" data-default-filter="*" data-layout="fitRows" data-sort="original-order">
          <div className="filters-wrapper" data-aos="fade-up" data-aos-delay="100">
            <ul className="portfolio-filters">
              <li 
                data-filter="*" 
                className={activeFilter === '*' ? 'filter-active' : ''}
                onClick={() => handleFilterClick('*')}
              >
                All Projects
              </li>
              {categories?.map((category) => (
                <li 
                  key={category.id}
                  data-filter={category.filter_class}
                  className={activeFilter === category.filter_class ? 'filter-active' : ''}
                  onClick={() => handleFilterClick(category.filter_class)}
                >
                  {category.name}
                </li>
              ))}
            </ul>
          </div>

          <div className="row g-4 portfolio-grid" data-aos="fade-up" data-aos-delay="200">
            {projects?.length === 0 ? (
              <div className="col-12">
                <div className="empty-portfolio">
                  <i className="bi bi-briefcase"></i>
                  <h3>No projects yet</h3>
                  <p>We&apos;re working on exciting new projects. Check back soon!</p>
                  <a href="#contact" className="btn btn-primary">
                    <i className="bi bi-envelope"></i> Get in Touch
                  </a>
                </div>
              </div>
            ) : filteredProjects.length === 0 && activeFilter !== '*' ? (
              <div className="col-12">
                <div className="empty-portfolio">
                  <i className="bi bi-folder2-open"></i>
                  <h3>No projects in this category</h3>
                  <p>We don&apos;t have any projects in this category yet. Check back soon!</p>
                  <button 
                    onClick={() => handleFilterClick('*')} 
                    className="btn btn-primary mt-3 p-3"
                  >
                    View All Projects
                  </button>
                </div>
              </div>
            ) : (
              filteredProjects.map((project) => (
                <div 
                  key={project.id} 
                  className={`col-lg-4 col-md-6 portfolio-item ${getFilterClass(project.category_id)}`}
                >
                  <div className={`project-card ${project.featured ? 'featured' : ''}`}>
                    <Link to={`/portfolio/${project.id}`} className="image-wrapper">
                      <img 
                        src={project.image || 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop'} 
                        alt={project.title} 
                        className="img-fluid" 
                        loading="lazy"
                        onError={(e) => {
                          (e.target as HTMLImageElement).src = 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop';
                        }}
                      />
                      <div className="hover-overlay">
                        <div className="overlay-actions">
                          <span className="action-btn">
                            <i className="bi bi-eye"></i>
                          </span>
                          <span className="action-btn">
                            <i className="bi bi-arrow-right-short"></i>
                          </span>
                        </div>
                      </div>
                      <span className="category-badge">{getCategoryName(project.category_id)}</span>
                      {project.featured && (
                        <span className="featured-badge">
                          <i className="bi bi-star-fill"></i> Featured
                        </span>
                      )}
                    </Link>
                    <div className="project-info">
                      <Link to={`/portfolio/${project.id}`}>
                        <h3>{project.title}</h3>
                      </Link>
                      {project.subtitle && <p className="project-subtitle">{project.subtitle}</p>}
                      <p className="project-description">{project.description}</p>
                      <div className="project-meta">
                        <div className="tech-tags">
                          {project.technologies?.map((tech, index) => (
                            <span key={index}>{tech}</span>
                          ))}
                        </div>
                        <span className="year">{project.year}</span>
                      </div>
                      <Link to={`/portfolio/${project.id}`} className="view-details-btn">
                        View Details <i className="bi bi-arrow-right"></i>
                      </Link>
                    </div>
                  </div>
                </div>
              ))
            )}
          </div>

          {projects && projects.length > 0 && (
            <div className="cta-section" data-aos="zoom-in" data-aos-delay="300">
              <div className="cta-content">
                <span className="cta-label">
                  <i className="bi bi-lightning-charge-fill"></i> Ready to Start?
                </span>
                <h3>Let&apos;s Create Something Amazing Together</h3>
                <p>Have a project in mind? We&apos;d love to hear about it and bring your vision to life.</p>
                <div className="cta-buttons">
                  <a href="#contact" className="btn-cta-primary">
                    Start Your Project <i className="bi bi-arrow-right"></i>
                  </a>
                  <a href="#services" className="btn-cta-secondary">
                    <i className="bi bi-play-circle"></i> Explore Services
                  </a>
                </div>
              </div>
              <div className="cta-decoration">
                <div className="floating-shape shape-1"></div>
                <div className="floating-shape shape-2"></div>
                <div className="floating-shape shape-3"></div>
              </div>
            </div>
          )}
        </div>
      </div>
    </section>
  );
}
