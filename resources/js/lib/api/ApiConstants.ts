export const API_BASE_URL = '/api/v1';
export const CONTENT_URL = '';

export const API_ENDPOINTS = {
  PROJECTS: `${API_BASE_URL}/portfolio/projects`,
  PROJECT: (id: string | number) => `${API_BASE_URL}/portfolio/projects/${id}`,
  CATEGORIES: `${API_BASE_URL}/portfolio/categories`,
  SERVICES: `${API_BASE_URL}/services`,
  SERVICE: (id: string | number) => `${API_BASE_URL}/services/${id}`,
  STATS: `${API_BASE_URL}/stats`,
  STAT: (id: string | number) => `${API_BASE_URL}/stats/${id}`,
  STATS_SECTION: (section: string) => `${API_BASE_URL}/stats?section=${section}`,
  TEAM: `${API_BASE_URL}/team`,
  TEAM_MEMBER: (id: string | number) => `${API_BASE_URL}/team/${id}`,
  TESTIMONIALS: `${API_BASE_URL}/testimonials`,
  TESTIMONIAL: (id: string | number) => `${API_BASE_URL}/testimonials/${id}`,
  CONTACTS: `${API_BASE_URL}/contacts`,
  CONTACT: (id: string | number) => `${API_BASE_URL}/contacts/${id}`,
  SETTINGS: `${API_BASE_URL}/settings`,
  UPLOAD: `${API_BASE_URL}/upload`,
} as const;
