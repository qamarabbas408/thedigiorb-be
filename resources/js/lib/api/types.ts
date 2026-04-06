export interface Project {
  id: string;
  title: string;
  subtitle: string;
  description: string;
  image: string;
  gallery: string[];
  technologies: string[];
  url: string;
  client: string;
  year: string;
  category_id: string;
  featured: boolean;
  status: 'published' | 'draft';
  display_order: number;
  created_at: string;
  updated_at: string;
}

export interface Category {
  id: string;
  name: string;
  filter_class: string;
  display_order: number;
  created_at: string;
  updated_at: string;
}

export interface Service {
  id: string;
  title: string;
  description: string;
  icon: string;
  featured: boolean;
  status: 'published' | 'draft';
  display_order: number;
  created_at: string;
  updated_at: string;
}

export interface Stat {
  id: string;
  label: string;
  value: string;
  icon: string;
  section: string;
  display_order: number;
  created_at: string;
  updated_at: string;
}

export interface TeamMember {
  id: string;
  name: string;
  role: string;
  bio: string;
  image: string;
  facebook_url: string;
  twitter_url: string;
  linkedin_url: string;
  instagram_url: string;
  display_order: number;
  status: 'published' | 'draft';
  created_at: string;
  updated_at: string;
}

export interface Testimonial {
  id: string;
  name: string;
  role: string;
  company: string;
  content: string;
  image: string;
  rating: number;
  featured: boolean;
  status: 'published' | 'draft';
  display_order: number;
  created_at: string;
  updated_at: string;
}

export interface Contact {
  id: string;
  name: string;
  email: string;
  phone: string;
  subject: string;
  message: string;
  status: 'new' | 'read' | 'replied';
  created_at: string;
  updated_at: string;
}

export interface Settings {
  company_name: string;
  company_email: string;
  company_phone: string;
  company_address: string;
  company_description: string;
  logo_type: 'image' | 'text';
  logo_image: string;
  logo_text: string;
  favicon: string;
  facebook_url: string;
  twitter_url: string;
  linkedin_url: string;
  instagram_url: string;
}
