import apiClient from '../client';
import { Project } from '../types';
import { processImageUrls } from '../utils';

export const projectsApi = {
  getAll: async (): Promise<Project[]> => {
    const response = await apiClient.get('/portfolio/projects');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Project) => processImageUrls(item, ['image', 'gallery'])) : data;
  },

  getPublished: async (): Promise<Project[]> => {
    const response = await apiClient.get('/portfolio/projects?status=published');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Project) => processImageUrls(item, ['image', 'gallery'])) : data;
  },

  getByCategory: async (categoryId: string): Promise<Project[]> => {
    const response = await apiClient.get(`/portfolio/projects?category_id=${categoryId}`);
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Project) => processImageUrls(item, ['image', 'gallery'])) : data;
  },

  getFeatured: async (): Promise<Project[]> => {
    const response = await apiClient.get('/portfolio/projects?featured=true');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Project) => processImageUrls(item, ['image', 'gallery'])) : data;
  },

  getById: async (id: string | number): Promise<Project> => {
    const response = await apiClient.get(`/portfolio/projects/${id}`);
    const data = response.data.data || response.data;
    return processImageUrls(data, ['image', 'gallery']);
  },
};
